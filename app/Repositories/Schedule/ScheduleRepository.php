<?php

namespace App\Repositories\Schedule;

use App\Models\Schedule;
use App\Dto\SchedulePostDto;

class ScheduleRepository implements ScheduleRepositoryInterface
{
    /**
     * 予約管理データの格納
     *
     * @param string $scheduleNo 予約管理番号
     * @param SchedulePostDto $dto 予約登録情報
     */
    public function register($scheduleNo, SchedulePostDto $dto)
    {
        $schedule = new Schedule();
        $schedule->schedule_no = $scheduleNo;
        $schedule->from = $dto->from;
        $schedule->to = $dto->to;
        $schedule->team = $dto->team;
        $schedule->save();
    }

    /**
     * 予約管理データの更新
     *
     * @param string $scheduleNo 予約管理番号
     * @param SchedulePostDto $dto 予約登録情報
     */
    public function update($scheduleNo, SchedulePostDto $dto)
    {
        $schedule = Schedule::where('schedule_no', '=', $scheduleNo)
                ->where('delete_flag', '=', 0)
                ->first();
        $schedule->from = $dto->from;
        $schedule->to = $dto->to;
        $schedule->team = $dto->team;
        $schedule->save();
    }

    /**
     * 予約管理データの取得（ページネイト作成）
     *
     * @return Paginator ページネイトオブジェクト
     */
    public function getRegisterList()
    {
        return Schedule::select(['schedule_no', 'from', 'to', 'team'])
                ->where('delete_flag', '=', 0)
                ->orderBy('schedule_no', 'desc')
                ->paginate();
    }

    /**
     * 予約管理番号に対するデータを取得
     *
     * @param string $scheduleNo
     * @return array 取得データ
     */
    public function fetchByScheduleNo($scheduleNo)
    {
        return Schedule::select(['schedule_no', 'from', 'to', 'team'])
                ->where('schedule_no', '=', $scheduleNo)
                ->where('delete_flag', '=', 0)
                ->orderBy('id')
                ->first()
                ->toArray();
    }
}
