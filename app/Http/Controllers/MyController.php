<?php

namespace App\Http\Controllers;

use App\Stores;
use Illuminate\Http\Request;
use App\Exports\StoresExport;
use App\Imports\StoresImport;
use Maatwebsite\Excel\Facades\Excel;

class MyController extends Controller
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function importExportView()
    {
        return view('import');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function export()
    {
        return Excel::download(new StoresExport, 'stores.xlsx');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function import()
    {
        Excel::import(new StoresImport,request()->file('file'));

        return back();
    }


}
