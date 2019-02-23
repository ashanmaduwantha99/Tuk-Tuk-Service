<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Workers extends Model
{
    public $timestamps = false;
    protected $table="workers";
    protected $fillable = [
        'name','username','email','mobile_number','nic','address','role',
    ];

}