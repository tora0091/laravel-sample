<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduleWorkTitle extends Model
{
    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = 'schedule_work_list';

    /**
     * 複数代入OKカラム
     * 
     * @var array
     */
    protected $fillable = ['schedule_no', 'work_list', 'create_at', 'update_at'];
}
