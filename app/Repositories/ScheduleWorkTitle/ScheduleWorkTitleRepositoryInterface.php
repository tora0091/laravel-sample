<?php

namespace App\Repositories\ScheduleWorkTitle;

use App\Dto\SchedulePostDto;

interface ScheduleWorkTitleRepositoryInterface
{
    /**
     * 予約管理データの格納
     *
     * @param string $scheduleNo 予約管理番号
     * @param SchedulePostDto $dto 予約登録情報
     */
    public function register($scheduleNo, SchedulePostDto $dto);

    /**
     * 予約管理データの更新
     *
     * @param string $scheduleNo 予約管理番号
     * @param SchedulePostDto $dto 予約登録情報
     */
    public function update($scheduleNo, SchedulePostDto $dto);

    /**
     * 予約管理データの取得
     *
     * @param string $scheduleNo 予約管理番号
     * @return array データ配列
     */
    public function getRegisterList($scheduleNo);

    /**
     * 予約管理番号に対するデータを取得
     *
     * @param string $scheduleNo
     * @return array 取得データ
     */
    public function fetchByScheduleNo($scheduleNo);
}