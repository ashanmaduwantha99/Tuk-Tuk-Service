<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class JobBookDesc extends Model
{
    public $timestamps = false;
    protected $table="job_book_desc";
    protected $fillable = [
        'owner_name','tw_number','job_desc',
    ];

}
