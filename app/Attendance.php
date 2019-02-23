<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    public $timestamps = false;
    protected $table="attendance";
//    protected $fillable = [
//        'name','username','attendance',
//    ];
    protected $fillable = [
        'name','date','attendance','username',
    ];

}
