<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    public $timestamps = false;
    protected $table="salary";
    protected $fillable = [
        'role','basic_salary',
    ];

}