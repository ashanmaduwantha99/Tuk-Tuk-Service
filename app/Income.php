<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    public $timestamps = false;
    protected $table="income";
    protected $fillable = [
        'description','amount',
    ];

}