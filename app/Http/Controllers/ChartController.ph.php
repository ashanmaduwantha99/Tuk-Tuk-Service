<?php

namespace App\Http\Controllers;

use App\Income;
use Illuminate\Http\Request;
use App\Stock;
use App\Charts\SampleChart;
use Illuminate\Session\Store;
use PhpParser\Comment;
use App\User;

class ChartController extends Controller
{
    public function index()
    {
        return view('Admin/DashBoard/index');
    }
//    public function testChart(){
//        $users = User::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
//            ->get();
//        $chart = Charts::database($users, 'bar', 'highcharts')
//            ->title("Monthly new Register Users")
//            ->elementLabel("Total Users")
//            ->dimensions(1000, 500)
//            ->responsive(false)
//            ->groupByMonth(date('Y'), true);
//        return view('chart',compact('chart'));
//    }
    public function chart()
    {
        $result = \DB::table('income')
            ->where('description','=','customer')
            ->orWhere('description','=','damaged items returned')
            ->orderBy('income_id', 'ASC')
            ->get();
        return response()->json($result);
    }

    public function testChart(){
//        $data = Comment::orderBy('name')
//        $data = Stores::groupBy('item_count')
//            ->get()
//            ->map(function ($item) {
//                // Return the number of persons with that age
//                return count($item);
//            });
        //----checking----------------------------
//        $today_users = User::whereDate('created_at', today())->count();
//        $yesterday_users = User::whereDate('created_at', today()->subDays(1))->count();
//        $users_2_days_ago = User::whereDate('created_at', today()->subDays(2))->count();
        $total_income_customer = Income::where('description','=','customer')->count();
        $total_income_service = Income::where('description','=','service charged fromQE7715')->count();

        $chart1 = new SampleChart;
        $chart1->labels(['2 days ago', 'Yesterday']);
        $chart1->dataset('My dataset', 'line', [$total_income_customer, $total_income_service]);

        //------------------working---------------------------//
        $chart = new SampleChart;

        $chart->labels(['One', 'Two', 'Three', 'Four']);
        $chart->dataset('My dataset', 'line', [1, 2, 3, 4]);
        $chart->dataset('My dataset 2', 'line', [4, 3, 2, 1]);

//        return view('sample_view', compact('chart1'));
        return view('sample_view')
            ->with(compact('chart1',$chart1))
            ->with(compact('chart',$chart));
    }
}
