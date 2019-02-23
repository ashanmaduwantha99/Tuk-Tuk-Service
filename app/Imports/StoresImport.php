<?php

namespace App\Imports;

use App\Expense;
use App\Stores;
use App\Store_List;
use App\Attendance;
use Maatwebsite\Excel\Concerns\ToModel;
use \DB;

class StoresImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Store_List([
            'item_name'     => $row[0],
            'item_code'    => $row[1],
            'item_category' => $row[2],
            'item_count'=>$row[3],
            'item_store_price'=>$row[4],
            'item_store_full_price'=>$row[5],
            'item_sale_price'=>$row[6],
        ]);

    }

}
