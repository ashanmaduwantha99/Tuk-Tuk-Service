<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class IncomeMonthly extends Model
{
    public $timestamps = false;
    protected $table="income_monthly";
    protected $fillable = [
        'description','amount',
    ];

}
