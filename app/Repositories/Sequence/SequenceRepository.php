<?php

namespace App\Repositories\Sequence;

use App\Models\Sequence;

class SequenceRepository implements SequenceRepositoryInterface
{
    /**
     * 登録するスケジュール番号を作成
     *
     * @return String スケジュール番号
     */
    public function makeScheduleNo()
    {
        // 現在登録されている値を取得
        $scheduleNo = $this->getScheduleNo();

        // 現在登録されている値に +1 して、その値をテーブルに登録
        $registerScheduleNo = intval($scheduleNo->number) + 1;

        // +1 した値にプレフィックスを付与し、その値を登録スケジュール番号とする
        $this->updateScheduleNo($registerScheduleNo);

        // スケジュール番号作成
        return Sequence::PREFIX_SCHEDULE
                . str_pad($registerScheduleNo, Sequence::LENGTH_SCHEDLUE, 0, STR_PAD_LEFT);
    }

    /**
     * 現在登録されている予約管理番号を取得
     *
     * @return Object 予約管理番号配列
     */
    private function getScheduleNo()
    {
        return Sequence::where('prefix', '=', Sequence::PREFIX_SCHEDULE)
                ->where('delete_flag', '=', 0)->first();
    }

    /**
     * 予約管理番号の更新
     *
     * @param Integer $newNumber
     */
    private function updateScheduleNo($newNumber)
    {
        $schedule = Sequence::where('prefix', '=', Sequence::PREFIX_SCHEDULE)
                ->where('delete_flag', '=', 0)->first();
        $schedule->number = $newNumber;
        $schedule->save();
    }
}
