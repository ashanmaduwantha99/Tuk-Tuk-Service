<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    public $timestamps = false;
    protected $table="news";
    protected $fillable = [
        'news',
    ];

}
