<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class CustomerRegister extends Model
{
    public $timestamps = false;
    protected $table="customer_register";
    protected $fillable = [
        'name','nic','email','mobile_number','tw_number','tw_ch_number','tw_eng_number','tw_type','username'
    ];

}
