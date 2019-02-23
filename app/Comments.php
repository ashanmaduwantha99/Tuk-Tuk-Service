<?php

namespace App;
//use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    public $timestamps = false;
    protected $table="comments";
    protected $fillable = [
        'name','comment',
    ];

}