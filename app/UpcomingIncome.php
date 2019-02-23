<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class UpcomingIncome extends Model
{
    public $timestamps = false;
    protected $table="upcoming_income_services";
    protected $fillable = [
        'tw_number','tw_ch_number','tw_eng_number','stork','owner_nic','owner_name','job_desc','cost',
    ];

}
