<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sequence extends Model
{
    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = 'sequence';

    /**
     * 予定管理テーブルの管理番号プレフィックス（通常登録）
     */
    const PREFIX_SCHEDULE = 'S';

    /**
     * 予定管理テーブルの管理番号プレフィックス（突発的な登録）
     */
    const PREFIX_SCHEDULE_NEW = 'N';

    /*
     * 予約管理テーブルの管理番号桁数
     */
    const LENGTH_SCHEDLUE = 10;
}
