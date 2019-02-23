<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Return_Store extends Model
{
    public $timestamps = false;
    protected $table="return_store";
    protected $fillable = [
        'item_code','item_count','value',
    ];

}