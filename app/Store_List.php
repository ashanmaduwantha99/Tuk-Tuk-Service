<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Store_List extends Model
{
    public $timestamps = false;
    protected $table="store_list";
    protected $fillable = [
        'item_name','item_code','item_category','item_count','item_store_price','item_store_full_price','item_sale_price',
    ];

}