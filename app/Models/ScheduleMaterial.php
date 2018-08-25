<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduleMaterial extends Model
{
    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = 'schedule_material';

    /**
     * 複数代入OKカラム
     * 
     * @var array
     */
    protected $fillable = ['schedule_no', 'material_code', 'number', 'create_at', 'update_at'];
}
