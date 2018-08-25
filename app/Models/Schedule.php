<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = 'schedule';

    /**
     * 複数代入OKカラム
     * 
     * @var array
     */
    protected $fillable = ['schedule_no', 'from', 'to', 'create_at', 'update_at'];
}
