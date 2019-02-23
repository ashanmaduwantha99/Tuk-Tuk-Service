<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Store_Book extends Model
{
    public $timestamps = false;
    protected $table="store_book";
    protected $fillable = [
        'description','amount',
    ];

}