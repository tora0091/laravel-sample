<?php

namespace App\Repositories\Sequence;

interface SequenceRepositoryInterface
{
    /**
     * 登録するスケジュール番号を作成
     *
     * @return String スケジュール番号
     */
    public function makeScheduleNo();
}