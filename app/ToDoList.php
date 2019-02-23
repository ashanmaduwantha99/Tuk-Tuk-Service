<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class ToDoList extends Model
{
    public $timestamps = false;
    protected $table="to_do_list";
    protected $fillable = [
        'note','date','time',
    ];

}
