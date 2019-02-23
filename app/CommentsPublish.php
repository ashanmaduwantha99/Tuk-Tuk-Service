<?php

namespace App;
//use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class CommentsPublish extends Model
{
    public $timestamps = false;
    protected $table="comments_publish";
    protected $fillable = [
        'name','comment',
    ];

}
