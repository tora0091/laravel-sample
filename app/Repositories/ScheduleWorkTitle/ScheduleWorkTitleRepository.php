<?php

namespace App\Repositories\ScheduleWorkTitle;

use App\Models\ScheduleWorkTitle;
use App\Dto\SchedulePostDto;

class ScheduleWorkTitleRepository implements ScheduleWorkTitleRepositoryInterface
{
    /**
     * 予約管理データの格納
     *
     * @param string $scheduleNo 予約管理番号
     * @param SchedulePostDto $dto 予約登録情報
     */
    public function register($scheduleNo, SchedulePostDto $dto)
    {
        foreach ($dto->work_title as $workTitle) {
            if (strlen($workTitle) > 0) {
                $scheduleWorkTitle = new ScheduleWorkTitle();
                $scheduleWorkTitle->schedule_no = $scheduleNo;
                $scheduleWorkTitle->work_title = $workTitle;
                $scheduleWorkTitle->save();
            }
        }
    }

    /**
     * 予約管理データの更新
     *
     * @param string $scheduleNo 予約管理番号
     * @param SchedulePostDto $dto 予約登録情報
     */
    public function update($scheduleNo, SchedulePostDto $dto)
    {
        ScheduleWorkTitle::where('schedule_no', '=', $scheduleNo)
                ->where('delete_flag', '=', 0)
                ->update(['delete_flag' => 1]);
        $this->register($scheduleNo, $dto);
    }

    /**
     * 予約管理データの取得
     *
     * @param string $scheduleNo 予約管理番号
     * @return array データ配列
     */
    public function getRegisterList($scheduleNo)
    {
        return ScheduleWorkTitle::select(['work_title'])
                ->where('schedule_no', '=', $scheduleNo)
                ->where('delete_flag', '=', 0)
                ->orderBy('id')
                ->get()
                ->toArray();
    }

    /**
     * 予約管理番号に対するデータを取得
     *
     * @param string $scheduleNo
     * @return array 取得データ
     */
    public function fetchByScheduleNo($scheduleNo)
    {
        return $this->getRegisterList($scheduleNo);
    }
}
