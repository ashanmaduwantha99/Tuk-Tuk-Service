<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class IncomeBook extends Model
{
    public $timestamps = false;
    protected $table="income_book";
    protected $fillable = [
        'description','amount',
    ];

}
