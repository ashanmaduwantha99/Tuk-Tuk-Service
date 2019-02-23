<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    public $timestamps = false;
    protected $table="payment_history";
    protected $fillable = [
        'name','username','role','month_year','percentage','basic_payment','etf','epf','bonus','full_payment','statement',
    ];

}
