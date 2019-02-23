<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class ExpenseMonthly extends Model
{
    public $timestamps = false;
    protected $table="expense_monthly";
    protected $fillable = [
        'description','amount',
    ];

}
