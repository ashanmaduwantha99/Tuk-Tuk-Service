<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Basic_ETF_EPF extends Model
{
    public $timestamps = false;
    protected $table="etf_epf";
    protected $fillable = [
        'username','etf','epf',
    ];

}
