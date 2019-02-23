<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class AttendanceCount_History extends Model
{
    public $timestamps = false;
    protected $table="attendance_count_history";
    protected $fillable = [
        'username','count','absance_count',
    ];

}
