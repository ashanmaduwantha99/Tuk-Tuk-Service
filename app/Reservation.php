<?php

namespace App;
//use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public $timestamps = false;
    protected $table="reservation";
    protected $fillable = [
        'name','mobile_number','nic','tw_number','date','type','number',
    ];

}