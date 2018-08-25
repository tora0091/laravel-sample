<?php

namespace App\Dto;

use Illuminate\Http\Request;

class SchedulePostDto
{
    /**
     * @var 日付フォーマット
     */
    const DATE_FORMAT = 'Y/m/d';

    /**
     * @var string 予定No
     */
    public $schedule_no = null;

    /**
     * @var string 予定開始日
     */
    public $from = null;

    /**
     * @var string 予定終了日
     */
    public $to = null;

    /**
     * @var string チーム
     */
    public $team = null;

    /**
     * @var array 件名
     */
    public $work_title = null;

    /**
     * @var array 機材種類
     */
    public $material = null;

    /**
     * @var array 機材数量
     */
    public $number = null;

    /**
     * リクエストデータ格納
     *
     * @param Request $request リクエストパラメータ
     */
    public function store(Request $request)
    {
        $this->schedule_no = $request->schedule_no;
        $this->from = $request->from;
        $this->to = $request->to;
        $this->team = $request->team;
        $this->work_title = $request->work_title;
        $this->material = $request->material;
        $this->number = $request->number;
    }

    /**
     * Databaseより取得した各種データをDTOに格納
     * (※schedule schedule_material schedule_work_title)
     *
     * @param string $scheduleNo 予定管理番号
     * @param array $schedule 予定データ
     * @param array $works 予定データ - 件名
     * @param array $materials 予定データ - 機材
     */
    public function storeFromDatabase(string $scheduleNo, array $schedule, array $works, array $materials)
    {
        // 予定管理番号
        $this->schedule_no = $scheduleNo;

        // 予定
        $this->from = $this->dateFormat($schedule['from']);
        $this->to = $this->dateFormat($schedule['to']);
        $this->team = $schedule['team'];

        // 件名
        $workTitle = [];
        foreach ($works as $work) {
            $workTitle[] = $work['work_title'];
        }
        $this->work_title = $workTitle;

        // 機材
        $materialList = [];
        $materialNumber = [];
        foreach ($materials as $items) {
            $materialList[] = $items['material_code'];
            $materialNumber[] = $items['number'];
        }
        $this->material = $materialList;
        $this->number = $materialNumber;
    }

    /**
     * オブジェクトデータを配列に変換
     *
     * @return array 配列
     */
    public function toArray()
    {
        return [
            $this->from,
            $this->to,
            $this->team,
            $this->work_title,
            $this->material,
            $this->number,
        ];
    }

    /**
     * オブジェクトデータをハッシュに変換
     *
     * @return hash ハッシュ
     */
    public function toHash()
    {
        return [
            "from" => $this->from,
            "to" => $this->to,
            "team" => $this->team,
            "work_title" => $this->work_title,
            "material" => $this->material,
            "number" => $this->number,
        ];
    }

    /**
     * 日付フォーマットを変更
     *
     * @param string $dateString
     * @return string
     */
    private function dateFormat($dateString)
    {
        return date($this::DATE_FORMAT, strtotime($dateString));
    }
}
