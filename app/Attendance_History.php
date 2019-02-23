<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Attendance_History extends Model
{
    public $timestamps = false;
    protected $table="attendance_history";
    protected $fillable = [
        'name','username','attendance',
    ];

}