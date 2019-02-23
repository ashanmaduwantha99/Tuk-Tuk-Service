<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class JobBook extends Model
{
    public $timestamps = false;
    protected $table="job_book";
    protected $fillable = [
        'tw_number','tw_ch_number','tw_eng_number','stork','owner_name','owner_nic',
    ];

}
