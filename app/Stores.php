<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Stores extends Model
{
    public $timestamps = false;
    protected $table="stores";
//    protected $fillable = [
//        'item_name','item_code','item_category','item_count','item_store_price','item_store_full_price','item_sales_price',
//    ];
    protected $fillable = [
        'item_name','item_code','item_category','item_count','item_store_price','item_store_full_price','item_sale_price',
    ];

}
