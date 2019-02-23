<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class AttendanceCount extends Model
{
    public $timestamps = false;
    protected $table="attendance_count";
    protected $fillable = [
        'username','count','absance_count','fully_work_day_count',
    ];

}