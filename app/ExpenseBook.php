<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class ExpenseBook extends Model
{
    public $timestamps = false;
    protected $table="expense_book";
    protected $fillable = [
        'description','amount',
    ];

}
