<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Monthly_Salary extends Model
{
    public $timestamps = false;
    protected $table="monthly_salary";
    protected $fillable = [
        'name','username','role','start_date','end_date','month_year','work_days','present_days','percentage','basic_payments','etf','epf','bonus','full_payment',
    ];

}
