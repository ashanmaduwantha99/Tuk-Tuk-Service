<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    public $timestamps = false;
    protected $table="service";
    protected $fillable = [
        'service_name','service_price',
    ];

}
