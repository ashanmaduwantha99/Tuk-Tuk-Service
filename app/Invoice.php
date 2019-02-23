<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public $timestamps = false;
    protected $table="invoice";
    protected $fillable = [
        'item_name','item_code','item_count','item_sale_price','invoice_desc','cost',
    ];

}
