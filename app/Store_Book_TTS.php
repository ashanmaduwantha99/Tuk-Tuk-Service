<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Store_Book_TTS extends Model
{
    public $timestamps = false;
    protected $table="store_book_tts";
    protected $fillable = [
        'description','amount',
    ];

}