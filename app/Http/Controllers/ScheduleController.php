<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ScheduleValidatePostRequest;
use App\Dto\SchedulePostDto;
use App\Exceptions\DatabaseException;
use App\Exceptions\ParameterException;
use App\Exceptions\SessionException;
use App\Exceptions\ValidationReCheckException;
use App\Http\Controllers\ApplicationController;

class ScheduleController extends ApplicationController
{
    /**
     * 予定一覧画面
     *
     * @return View
     */
    public function listed(Request $request)
    {
        $request->session()->remove($this->scheduleDtoName);

        $paginations = $this->scheduleRepository->getRegisterList();
        $registerItems = $paginations->items();
        $registerList = [];

        // 一覧画面に表示するデータ構造作成
        foreach ($registerItems as $items) {
            $dto = new SchedulePostDto();
            $dto->storeFromDatabase(
                    $items->schedule_no,
                    $items->toArray(),
                    $this->scheduleWorkTitleRepository->getRegisterList($items->schedule_no),
                    $this->scheduleMaterialRepository->getRegisterList($items->schedule_no));
            $registerList[$items->schedule_no] = $dto;
        }
        return view('schedule.listed', ['registerList' => $registerList, 'paginations' => $paginations]);
    }

    /**
     * 予定入力画面
     *
     * @param Request $request リクエストパラメータ
     * @return View
     */
    public function input(Request $request)
    {
        return view('schedule.input', [
            'dto' => $request->session()->get($this->scheduleDtoName, new SchedulePostDto()),
            'materialTypeList' => $this->makeMaterialTypeList($request)]);
    }

    /**
     * 予定編集画面
     *
     * @param Request $request
     * @return View
     */
    public function edit(Request $request)
    {
        $scheduleNo = $request->get('schedule_no');
        if ($scheduleNo === null) {
            throw new ParameterException();
        }
        return view('schedule.input', [
            'dto' => $this->getScheduleForScheduleNo($scheduleNo),
            'materialTypeList' => $this->makeMaterialTypeList($request)]);
    }

    /**
     * 予定確認画面
     *
     * @param Request $request リクエストパラメータ
     * @return View
     */
    public function confirm(Request $request)
    {
        // データオブジェクト作成
        $dto = new SchedulePostDto();
        $dto->store($request);
        $request->session()->put($this->scheduleDtoName, $dto);

        // バリデーション実行
        $post = new ScheduleValidatePostRequest();
        $validator = Validator::make($dto->toHash(), $post->rules(), $post->messages());
        if ($validator->fails()) {
            return redirect('/schedule/input')
                    ->withErrors($validator)->withInput();
        }
        return view('schedule.confirm', [
            'dto' => $dto,
            'materialTypeList' => $this->makeMaterialTypeList($request)]);
    }

    /**
     * 予定完了画面
     *
     * @param Request $request リクエストパラメータ
     * @return View
     */
    public function complete(Request $request)
    {
        // セッションデータ取得したのち削除
        $dto = $request->session()->pull($this->scheduleDtoName);
        if ($dto === null) {
            throw new SessionException();
        }

        // 登録前に再度バリデーション実行
        $post = new ScheduleValidatePostRequest();
        $validator = Validator::make($dto->toHash(), $post->rules(), $post->messages());
        if ($validator->fails()) {
            throw new ValidationReCheckException();
        }

        try {
            DB::beginTransaction();

            // DTOにschedule_noが格納されている場合：編集処理
            // DTOにschedule_noが格納されていない場合（null）：新規登録
            if ($dto->schedule_no === null) {
                $this->register($dto);
            } else {
                $this->update($dto);
            }

            DB::commit();
        } catch (Exception $ex) {
            DB::rollback();
            throw new DatabaseException();
        }

        // ２重登録防止、_token値を更新
        $request->session()->regenerateToken();

        return view('schedule.complete');
    }

    /**
     * 新規登録処理
     *
     * @param SchedulePostDto $dto 予約データ格納オブジェクト
     */
    private function register($dto)
    {
        // シーケンステーブルから番号取得
        $scheduleNo = $this->sequenceRepository->makeScheduleNo();

        // 予約管理テーブルへ登録
        $this->scheduleRepository->register($scheduleNo, $dto);

        // 予約管理テーブル - 件名テーブルへ登録
        $this->scheduleWorkTitleRepository->register($scheduleNo, $dto);

        // 予約管理テーブル - 機材テーブルへ登録
        $this->scheduleMaterialRepository->register($scheduleNo, $dto);
    }

    /**
     * 更新処理
     *
     * @param SchedulePostDto $dto 予約データ格納オブジェクト
     */
    private function update($dto)
    {
        // 登録済みの予約管理番号取得
        $scheduleNo = $dto->schedule_no;

        // 予約管理テーブルへ更新
        $this->scheduleRepository->update($scheduleNo, $dto);

        // 予約管理テーブル - 件名テーブルへ更新
        $this->scheduleWorkTitleRepository->update($scheduleNo, $dto);

        // 予約管理テーブル - 機材テーブルへ更新
        $this->scheduleMaterialRepository->update($scheduleNo, $dto);
    }
}
