<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class JobBookTemp extends Model
{
    public $timestamps = false;
    protected $table="job_book_temp";
    protected $fillable = [
        'job_desc','cost',
    ];

}
