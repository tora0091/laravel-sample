<?php

namespace App\Repositories\ScheduleMaterial;

use App\Models\ScheduleMaterial;
use App\Dto\SchedulePostDto;

class ScheduleMaterialRepository implements ScheduleMaterialRepositoryInterface
{
    /**
     * 予約管理 - 機材テーブルのデータ登録
     *
     * @param string $scheduleNo 予約管理番号
     * @param SchedulePostDto $dto 予約登録情報
     */
    public function register($scheduleNo, SchedulePostDto $dto)
    {
        foreach ($dto->material as $key => $materialCode) {
            if (strlen($materialCode) > 0 && strlen($dto->number[$key]) > 0) {
                $scheduleMaterial = new ScheduleMaterial();
                $scheduleMaterial->schedule_no = $scheduleNo;
                $scheduleMaterial->material_code = $materialCode;
                $scheduleMaterial->number = $dto->number[$key];
                $scheduleMaterial->save();
            }
        }
    }

    /**
     * 予約管理 - 機材テーブルのデータ登録
     *
     * @param string $scheduleNo 予約管理番号
     * @param SchedulePostDto $dto 予約登録情報
     */
    public function update($scheduleNo, SchedulePostDto $dto)
    {
        ScheduleMaterial::where('schedule_no', '=', $scheduleNo)
                ->where('delete_flag', '=', 0)
                ->update(['delete_flag' => 1]);
        $this->register($scheduleNo, $dto);

    }

    /**
     * 予約管理 - 機材テーブルのデータ取得
     *
     * @param string $scheduleNo 予約管理番号
     * @return array データ配列
     */
    public function getRegisterList($scheduleNo)
    {
        return ScheduleMaterial::select(['material_code', 'number'])
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
