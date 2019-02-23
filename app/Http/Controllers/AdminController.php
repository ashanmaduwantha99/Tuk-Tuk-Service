<?php

namespace App\Http\Controllers;

use App\AttendanceCount_History;
use App\Basic_ETF_EPF;
use App\Comments;
use App\Expense;
use App\ExpenseBook;
use App\ExpenseMonthly;
use App\Income;
use App\IncomeBook;
use App\IncomeMonthly;
use App\Invoice;
use App\JobBook;
use App\JobBookDesc;
use App\JobBookTemp;
use App\Monthly_Salary;
use App\News;
use App\PaymentHistory;
use App\Reservation;
use App\ReservationHistory;
use App\Return_Store;
use App\Services;
use App\Store_Book;
use App\Store_Book_TTS;
use App\Store_List;
use App\Stores;
use App\ToDoList;
use App\UpcomingIncome;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use \DB;
use\App\Workers;
use\App\Attendance;
use\App\AttendanceCount;
use\App\Salary;
use\App\Bonus;
use\App\Attendance_History;
use Illuminate\Validation\Rules\In;
use Illuminate\Http\Response;
use\Illuminate\Support\Facades\Auth;
use\Illuminate\Support\Facades\Session;
use\Carbon;
use App\Charts\SampleChart;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use PDF;
use\Hash;
//use Maatwebsite\Excel\Facades\Excel;
use Excel;

class AdminController extends Controller
{
    public function Login(){
        return view ('Admin/login');
    }
    public function Register(){
        return view ('Admin/register');
    }
    public function signin(Request $request)
    {
        if(Auth::attempt(['username'=> $request['username'],'password'=>$request['password']]))
        {
            $select_role = DB::table('users')->select('role')->where('username','=',$request['username'])->get();
            $select_role_to_string = strval($select_role[0]->role);

            if ($select_role_to_string == 'user'){
                return redirect()->action('CustomerController@CustomerHome');
            }elseif ($select_role_to_string == 'admin'){
                return redirect()->action('AdminController@DashBoard');
            }else{
                return redirect()->back()->with('login_message_dgr','No such kind of user here');
            }

//            return redirect()->action('AdminController@DashBoard');
        }
        return redirect()->back()->with('message','login failed');
    }

    public function logout(Request $request) {
        Auth::logout();
        session::flush();
        return redirect()->action('AdminController@Login');
    }

    public function Admin_Home(){
        return view('Admin/Workers/worker_reWorkerRegisterg');
    }

    public function WorkerRegister(){
        $detail = Workers::all();
        return view('Admin/Workers/worker_reg')
            ->with(compact('detail',$detail));
    }
    public function WorkerAttendance(){
        $TodayDate  =  date('Y-m-d');
        $detail = Workers::all();
        $getCount = Attendance::count();
        $attdetail = Attendance::orderBy('date','asc')->take($getCount)->get();
        $count_data = AttendanceCount::all();
        return view('Admin/Workers/worker_attendance',['TodayDate'=>$TodayDate])
            ->with(compact('detail',$detail))
            ->with(compact('attdetail',$attdetail))
            ->with(compact('count_data',$count_data));
    }
    public function WorkerAttendanceHistory(){
        $detail1 = AttendanceCount_History::all();
        $detail2 = Attendance_History::all();
        return view('Admin/Workers/worker_attendance_history')
            ->with(compact('detail1',$detail1))
            ->with(compact('detail2',$detail2));
    }
    public function WorkerSalary(){
        $detail = Workers::all();
        $salary_data = Monthly_Salary::all();
        return view('Admin/Workers/workers_salary')
            ->with(compact('detail',$detail))
            ->with(compact('salary_data',$salary_data));
    }
    public function PaymentHistory(){
        $data = PaymentHistory::all();
        return view('Admin/Workers/workers_payment_history')
            ->with(compact('data',$data));
    }
    public function WorkersEpfEtf(){
        $data2 =Basic_ETF_EPF::all();
        return view('Admin/Workers/workers_epfetf')
            ->with(compact('data2',$data2));
    }
    public function WorkerSalaryUpdate(){
        $data = Salary::all();
        $data_bonus = Bonus::all();
        return view('Admin/Workers/workers_salary_update')
            ->with(compact('data_bonus',$data_bonus))
            ->with(compact('data',$data));
    }

    public function StoreReg(){
        $store_list_detail  = Store_List::all();
        $store_book_detail  = Store_Book::all();
        return view('Admin/Stores/store_register')
            ->with(compact('store_list_detail',$store_list_detail))
            ->with(compact('store_book_detail',$store_book_detail));
    }
    public function StoreView(){
        $store_detail       = Stores::all();
        return view('Admin/Stores/store_view')
            ->with(compact('store_detail',$store_detail));
    }
    public function StoreBookView(){
        $store_book_detail_tts = Store_Book_TTS::all();
        return view('Admin/Stores/store_bookview')
            ->with(compact('store_book_detail_tts',$store_book_detail_tts));
    }
    public function StoreReturn(){
        $store_item_code = Stores::all();
        $return_store_detail = Return_Store::all();
        return view('Admin/Stores/store_return')
            ->with(compact('return_store_detail',$return_store_detail))
            ->with(compact('store_item_code',$store_item_code));
    }

    public function SearchStore(){
        $invoice_details = Invoice::all();
        $search = Input::get ( 'search' );
        $item = Stores::where ( 'item_code', 'LIKE', '%' . $search. '%' )
            ->orWhere ( 'item_name', 'LIKE', '%' . $search. '%' )
            ->get ();
        if (count ($item) > 0)
            return view ( 'Admin/Stores.selling'  )
                ->withDetails ($item)->withQuery ($search)
                ->with(compact('invoice_details',$invoice_details));
        else
            return view ( 'Admin/Stores.selling' )
                ->withMessage ( 'No Details found. Try to search again !' )
                ->with(compact('invoice_details',$invoice_details));
    }

    public function ServiceAddition(){
        $service_list_detail = Services::all();
        return view('Admin/Service/service_add')
            ->with(compact('service_list_detail',$service_list_detail));
    }
    public function ServiceIncome(){
        $service_list_detail  = Income::where ( 'description', 'LIKE', '%service charged from%' )
                                ->orWhere('description', 'LIKE', '%got the check from David Pieris for%' )
                                ->get();
        $upcome_income_service_list_detail  = UpcomingIncome::all();
        return view('Admin/Service/services_income')
            ->with(compact('service_list_detail',$service_list_detail))
            ->with(compact('upcome_income_service_list_detail',$upcome_income_service_list_detail));
    }
    public function ReservationCheck(){
        $getReservationDetail   =   Reservation::all();
//        $getReservationDetail   =   Reservation::Orderby('date')->get();
        $pastReservation = ReservationHistory::all();
        return view('Admin/Service/reservation_check')
            ->with(compact('pastReservation',$pastReservation))
            ->with(compact('getReservationDetail',$getReservationDetail));
    }

    public function OtherExpenses(){
        return view('Admin/Others/other_expenses');
    }
    public function ViewComments(){
        $get_coments  = Comments::all();
        $get_list  = ToDoList::all();
        $news       = News::all();
        return view('Admin/Others/view_comments')
            ->with(compact('get_coments',$get_coments))
            ->with(compact('get_list',$get_list))
            ->with(compact('news',$news));
    }

    public function Income(){
        $get_income  = DB::table('income')->sum('amount');

        $row_count = IncomeMonthly::count();
        if ($row_count==0){
            $get_last_month_income_to_double = 0;
        }else{
            $get_last_month_income = DB::table('income_monthly')->select('amount')->orderBy('income_date', 'desc')->get();
            $get_last_month_income_to_double = doubleval($get_last_month_income[0]->amount);
        }
//        $get_last_month_income_to_double= $row_count ;
        $get_all_income_statement = DB::table('income_book')->sum('amount');

        $get_upcoming_income = DB::table('upcoming_income_services')->sum('cost');

        $income_detail =Income::all();
        $monthly_income_detail =IncomeMonthly::all();
        $all_income_detail =IncomeBook::all();
        return view('Admin/IncomeExpense/income',
            [
                'get_income'=>$get_income,
                'get_last_month_income_to_double'=>$get_last_month_income_to_double,
                'get_all_income_statement'=>$get_all_income_statement,
                'get_upcoming_income'=>$get_upcoming_income
            ])
            ->with(compact('income_detail',$income_detail))
            ->with(compact('monthly_income_detail',$monthly_income_detail))
            ->with(compact('all_income_detail',$all_income_detail));
    }
    public function Expense(){
        $get_expense = DB::table('expense')->sum('amount');

        $row_count = ExpenseMonthly::count();
        if ($row_count==0){
            $get_last_month_expense_to_double = 0;
        }else{
            $get_last_month_expense = DB::table('expense_monthly')->select('amount')->orderBy('expense_date', 'desc')->get();
            $get_last_month_expense_to_double = doubleval($get_last_month_expense[0]->amount);
        }

        $get_all_expense_statement = DB::table('expense_book')->sum('amount');

        $get_upcoming_income = DB::table('upcoming_income_services')->sum('cost');

        $expense_detail =Expense::all();
        $monthly_expense_detail =ExpenseMonthly::all();
        $all_expense_detail =ExpenseBook::all();
        return view('Admin/IncomeExpense/expense',
            [
                'get_last_month_expense_to_double'=>$get_last_month_expense_to_double,
                'get_expense'=>$get_expense,
                'get_all_expense_statement'=>$get_all_expense_statement
            ])
            ->with(compact('expense_detail',$expense_detail))
            ->with(compact('monthly_expense_detail',$monthly_expense_detail))
            ->with(compact('all_expense_detail',$all_expense_detail));
    }

    public function UpdateSettings(){
        $userData = User::Where('role','=','admin')->get();
        return view('Admin/AdminSettings/admin_settings')
            ->with(compact('userData',$userData));
    }

    //-------------------Register worker---------------------------------//
    public function RegisterWorker(Request $request){
        $this->validate($request,[
            'username'   =>  'unique:workers',
            'nic'        =>  'unique:workers',
            'email'     =>  'unique:workers'
        ]);

        $name               = $request->input('name');
        $username           = $request->input('username');
        $email              = $request->input('email');
        $mobile_number      = $request->input('mobile_number');
        $nic                = $request->input('nic');
        $address            = $request->input('address');
        $role               = $request->input('role');

        $save_data = array(
            'name'      => $name,
            'username'  => $username,
            'email'     => $email,
            'mobile_number'=> $mobile_number,
            'nic'       => $nic,
            'address'   => $address,
            'role'      => $role
        );

        if((DB::table('workers')->insert($save_data)) === true){
            return redirect()->back()->with('message_register','Registration Success');
        }else{
            return redirect()->back()->with('message_register_dgr','Registration failed');
        }

    }
    //-------------------Delete worker---------------------------------//
    public function delete_worker(Request $request){
        $id = $request->input('id');
        $del = Workers::where('id','=',$id)->delete();
        if($del){
            return redirect()->back()->with('messagedelete','Deleted');
        }else{
            return redirect()->back()->with('messagedelete','not deleted');
        }

        /*
        $get_user = DB::table('workers')->select('username')->where('id','=',$id)->get();
        $username = strval($get_user[0]->username);
        if ($del){
            //---- check if the user is empty in attendance table--//
            $check_data = Attendance::where('username','=',$username)->count();
            if ($check_data==0){
                return redirect()->back()->with('messagedelete','Deleted');
            }else{

            }
            //-- if user empty is done and else pay salary for hiim--
            return redirect()->back()->with('messagedelete','Deleted');
        }else{
            return redirect()->back()->with('messagedelete','you have to pay him first');
        }*/

    }
    //-------------------Update worker---------------------------------//
    public function editworker(){
        $id = Input::get('id');
        $name = Input::get('name');
        //$username = Input::get('username');
        $email = Input::get('email');
        $mobile_number = Input::get('mobile_number');
        $nic= Input::get('nic');
        $address= Input::get('address');
        $role= Input::get('role');

        Workers::where('id','=',$id)->update(['name'=>$name,'email'=>$email,'mobile_number'=>$mobile_number,'nic'=>$nic,'address'=>$address, 'role'=>$role]);
        return redirect()->back()->with('messageEdit','updated');
    }
    //-------------------Attendance---------------------------------//

    public function mark_attendance(Request $request){
        $this->validate($request,[
            'date'         =>  'required',
            'attendance'   =>  'required',
        ]);

        $name               = $request->input('name');
        //$username         = $request->input('username');
        $att_username       = $request->input('username');
        $date               = $request->input('date');
        $attendance         = $request->input('attendance');

        $count = DB::table('attendance')->select('username',$att_username)
            ->where([['username','=',$att_username],['date','=',$date]])
            ->count();
        if ($count ==0){
            $save_data = array(
                'name'      => $name,
                'date'      => $date,
                'attendance'=> $attendance,
                'username' => $att_username
            );
            DB::table('attendance')->insert($save_data);

            //------------------cal present attendance---------------------------
            //------------------select present count---------------------
            $countpresent = DB::table('attendance') ->select('username',$att_username)
                ->where([['username','=',$att_username],['attendance','=','present']])
                ->count();

            $att_count = $countpresent;
            //------------select absence count----------------------------
            $absance_count = DB::table('attendance')->select('username',$att_username)
                ->where([['username','=',$att_username],['attendance','=','absance']])
                ->count();
            $att_absance_count = $absance_count;

            $fully_work_day_count = $att_count+$att_absance_count;

            $work_day_percentage = ($att_count/$fully_work_day_count)*100;

            $getCount = DB::table('attendance_count')->select('username',$att_username)->where('username','=',$att_username)->count();
            if ($getCount==1){
                //save the data as update
                AttendanceCount::where('username','=',$att_username)
                    ->update(['count'=>$att_count,'absance_count'=>$att_absance_count,'fully_work_day_count'=>$fully_work_day_count,'work_day_percentage'=>$work_day_percentage]);
            }else{
                $newdata = array(
                    'username'  => $att_username,
                    'count'     => $att_count,
                    'absance_count' => $att_absance_count,
                    'fully_work_day_count'=>$fully_work_day_count,
                    'work_day_percentage'=>$work_day_percentage
                );

                DB::table('attendance_count')->insert($newdata);
            }

            //--------------- end of cal present attendance-----------------------
            return redirect()->back()->with('messageatt','Attendance Marked');
        }else{
            return redirect()->back()->with('messageatt_dgr','failed to added attendence. already marked '.$count.'times');
        }
    }

    //-------------- mark attendance upload using excel csv file
    public function importAttendanceByExcel(Request $request)
    {
        if($request->hasFile('import_file')){
            Excel::load($request->file('import_file')->getRealPath(), function ($reader) {
                foreach ($reader->toArray() as $key => $row) {
                    $data['name'] = $row['no.'];
                    $data['date'] = $row['date'];
                    $data['attendance'] = $row['status'];
                    $data['username'] = $row['no.'];

                    if(!empty($data)) {
                        if (($row['status']=="I")||($row['status']=="O")){
                            $uname = $row['no.'];

                            $get_name = DB::table('workers')->select('name')->where('username','=',$uname)->get();
                            $get_name_to_string = strval($get_name[0]->name);

                            $data['name'] = $get_name_to_string;
                            $data['date'] = $row['date'];
                            $data['attendance'] = 'present';
                            $data['username'] = $row['no.'];

                            $check_username = DB::table('attendance_count')->select('username')->where('username','=',$uname)->count();

                            $get_present_count = DB::table('attendance') ->select('username',$uname)
                                ->where([['username','=',$uname],['attendance','=','present']])
                                ->count();
                            $get_absence_count =DB::table('attendance') ->select('username',$uname)
                                ->where([['username','=',$uname],['attendance','=','absance']])
                                ->count();

                            $new_present_count = ($get_present_count+1);
                            $new_absence_count = $get_absence_count;
                            $new_fully_work_days_count = $new_present_count+$new_absence_count;

                            $work_day_percentage = ($new_present_count/$new_fully_work_days_count)*100;

                            if ($check_username==0){
                                $save_new_to_attendance = array([
                                    'username'  =>  $uname,
                                    'count'     =>  $new_present_count,
                                    'absance_count'=>   $new_absence_count,
                                    'fully_work_day_count'=>  $new_fully_work_days_count,
                                    'work_day_percentage'   =>  $work_day_percentage
                                ]);
                                DB::table('attendance')->insert($data);
                                DB::table('attendance_count')->insert($save_new_to_attendance);
                            }elseif ($check_username==1){
                                DB::table('attendance')->insert($data);
                                AttendanceCount::where('username','=',$uname)
                                    ->update(['count'=>$new_present_count,'absance_count'=>$new_absence_count,'fully_work_day_count'=>$new_fully_work_days_count,'work_day_percentage'=>$work_day_percentage]);
                            }else{
                                return redirect()->back()->with('messageatt_dgr','something went wrong');
                            }

                        }else{
                            return redirect()->back()->with('messageatt_dgr','something went wrong');
                        }

                    }
                }
            });

            return redirect()->back()->with('messageatt','uploaded');
        }

        Session::put('success', 'Youe file successfully import in database!!!');

        return back();
    }
    /*
    public function importAttendanceByExcel(Request $request)
    {
        if($request->hasFile('import_file')){
            Excel::load($request->file('import_file')->getRealPath(), function ($reader) {
                foreach ($reader->toArray() as $key => $row) {
                    $data['name'] = $row['name'];
                    $data['att_username'] = $row['att_username'];
                    $data['date'] = $row['date'];
                    $data['attendance'] = $row['attendance'];
                    $data['username'] = $row['username'];

                    if(!empty($data)) {
                        if (($row['attendance']=="I")||($row['attendance']=="O")){
                            $data['name'] = $row['name'];
                            $data['att_username'] = $row['att_username'];
                            $data['date'] = $row['date'];
                            $data['attendance'] = 'present';
                            $data['username'] = $row['username'];

                            $uname = $row['att_username'];


                            $check_username = DB::table('attendance_count')->select('username')->where('username','=',$uname)->count();

                            $get_present_count = DB::table('attendance') ->select('att_username',$uname)
                                ->where([['att_username','=',$uname],['attendance','=','present']])
                                ->count();
                            $get_absence_count =DB::table('attendance') ->select('att_username',$uname)
                                ->where([['att_username','=',$uname],['attendance','=','absance']])
                                ->count();

                            $new_present_count = ($get_present_count+1);
                            $new_absence_count = $get_absence_count;
                            $new_fully_work_days_count = $new_present_count+$new_absence_count;

                            $work_day_percentage = ($new_present_count/$new_fully_work_days_count)*100;

                            if ($check_username==0){
                                $save_new_to_attendance = array([
                                    'username'  =>  $uname,
                                    'count'     =>  $new_present_count,
                                    'absance_count'=>   $new_absence_count,
                                    'fully_work_day_count'=>  $new_fully_work_days_count,
                                    'work_day_percentage'   =>  $work_day_percentage
                                ]);
                                DB::table('attendance')->insert($data);
                                DB::table('attendance_count')->insert($save_new_to_attendance);
                            }elseif ($check_username==1){
                                DB::table('attendance')->insert($data);
                                AttendanceCount::where('username','=',$uname)
                                    ->update(['count'=>$new_present_count,'absance_count'=>$new_absence_count,'fully_work_day_count'=>$new_fully_work_days_count,'work_day_percentage'=>$work_day_percentage]);
                            }else{
                                return redirect()->back()->with('messageatt_dgr','something went wrong');
                            }

                        }else{
                            return redirect()->back()->with('messageatt_dgr','something went wrong');
                        }

                    }
                }
            });

            return redirect()->back()->with('messageatt','uploaded');
        }

        Session::put('success', 'Youe file successfully import in database!!!');

        return back();
    }
    */
    public function importStoreByExcel(Request $request)
    {
        if($request->hasFile('import_file')){
            Excel::load($request->file('import_file')->getRealPath(), function ($reader) {
                foreach ($reader->toArray() as $key => $row) {
                    $data['item_name'] = $row['item_name'];
                    $data['item_code'] = $row['item_code'];
                    $data['item_category'] = $row['item_category'];
                    $data['item_count'] = $row['item_count'];
                    $data['item_store_price'] = $row['item_store_price'];
                    $data['item_store_full_price'] = $row['item_store_full_price'];
                    $data['item_sale_price'] = $row['item_sale_price'];
                    if(!empty($data)) {
                        DB::table('store_list')->insert($data);
                    }
                }
            });
        }

        Session::put('success', 'Youe file successfully import in database!!!');

        return back();
    }

    //-------------------Salary Update---------------------------------//
    public function updateSalary(Request $request){
        $salary_id = Input::get('salary_id');
        $basic_salary = Input::get('basic_salary');
        Salary::where('salary_id','=',$salary_id)->update(['basic_salary'=>$basic_salary]);
        return redirect()->back()->with('messagesalaryEdit','updated');
    }
    //-------------------Bonus salary Update---------------------------------//
    public function BonusUpdate(Request $request){
        $bonus_id   =   Input::get('bonus_id');
        $bonus      =   Input::get('bonus');
        Bonus::where('bonus_id','=',$bonus_id)->update(['bonus'=>$bonus]);
        return redirect()->back()->with('message_bonus','Bonus Salary Updates');
    }


    //-------------------Calculate Salary---------------------------------//

    public function CalculateSalary(Request $request){
        $start_date         = $request->input('start_date');
        $end_date           = $request->input('end_date');
        $month              = $request->input('month');
        $work_days          = $request->input('work_days');

        $get_count = DB::table('workers')->count();
        $get_username = DB::table('workers')->pluck('username');

        foreach ($get_username as $get_username) {
            //echo $get_username;
            $count_username = DB::table('monthly_salary')->select('username',$get_username)
                ->where('username','=',$get_username)
                ->count();

            $select_role = DB::table('workers')->select('role')->where('username','=',$get_username)->get();
            $select_role_to_string = strval($select_role[0]->role);
            //echo $select_role_to_string;
            $select_name = DB::table('workers')->select('name')->where('username','=',$get_username)->get();
            $select_name_to_string = strval($select_name[0]->name);


            $countpresent = DB::table('attendance') ->select('username',$get_username)
                ->where([['username','=',$get_username],['attendance','=','present']])
                ->count();
            //echo $countpresent;
            $work_percentage = ($countpresent/$work_days)*100;

            $select_payment = DB::table('salary')->select('basic_salary')->where('role', $select_role_to_string)->get();
            $select_payment_double = doubleval($select_payment[0]->basic_salary);

            //echo $select_payment_double;

            $etf_amount = $select_payment_double * 0.03;

            $epf_amount_worker = $select_payment_double * 0.08;
            $epf_amount_company = $select_payment_double * 0.12;

            $epf_amount = $epf_amount_worker+$epf_amount_company;

            $new_select_payment_double = $select_payment_double - $epf_amount_worker;

            if ($count_username==0){

                if ($work_percentage==100){
                    $select_bonus = DB::table('bonus')->select('bonus')->where('role',$select_role_to_string)->get();
                    $select_bonus_double =doubleval($select_bonus[0]->bonus);

                    //$full_payment = $select_payment_double + $select_bonus_double;
                    $full_payment = $new_select_payment_double + $select_bonus_double;

                    $save_data = array(
                        'name'      => $select_name_to_string,
                        'username'  => $get_username,
                        'role'      => $select_role_to_string,
                        'start_date'=> $start_date,
                        'end_date'  => $end_date,
                        'month'     => $month,
                        'work_days' => $work_days,
                        'prasent_days'=>$countpresent,
                        'percentage' =>$work_percentage,
                        'basic_payments'=> $select_payment_double,
                        'etf'        => $etf_amount,
                        'epf'        => $epf_amount,
                        'bonus'      => $select_bonus_double,
                        'full_payment'=> $full_payment
                    );

                    DB::table('monthly_salary')->insert($save_data);

                }else{
                    $full_payment = ($new_select_payment_double*$work_percentage)/100;

                    $save_data = array(
                        'name'      => $select_name_to_string,
                        'username'  => $get_username,
                        'role'      => $select_role_to_string,
                        'start_date'=> $start_date,
                        'end_date'  => $end_date,
                        'month'     => $month,
                        'work_days' => $work_days,
                        'prasent_days'=>$countpresent,
                        'percentage' =>$work_percentage,
                        'basic_payments'   => $select_payment_double,
                        'etf'        => $etf_amount,
                        'epf'        => $epf_amount,
                        'bonus'      => 0,
                        'full_payment'=> $full_payment
                    );

                    DB::table('monthly_salary')->insert($save_data);

                }
                //return redirect()->back()->with('message_calSalary','Salary Calculation is done for'.$get_username);
            }elseif ($count_username==1){

                if ($work_percentage==100){
                    //cal salary for relevant role
                    $select_bonus = DB::table('bonus')->select('bonus')->where('role',$select_role_to_string)->get();
                    $select_bonus_double =doubleval($select_bonus[0]->bonus);

                    $full_payment = $new_select_payment_double + $select_bonus_double;

                    $save_data = array(
                        'name'      => $select_name_to_string,
                        'username'  => $get_username,
                        'role'      => $select_role_to_string,
                        'start_date'=> $start_date,
                        'end_date'  => $end_date,
                        'month'     => $month,
                        'work_days' => $work_days,
                        'prasent_days'=>$countpresent,
                        'percentage' =>$work_percentage,
                        'basic_payments'   => $select_payment_double,
                        'etf'        => $etf_amount,
                        'epf'        => $epf_amount,
                        'bonus'      => $select_bonus_double,
                        'full_payment'=> $full_payment
                    );
                    Monthly_Salary::where('username','=',$get_username)->update($save_data);
                    //DB::table('monthly_salary')->update($save_data);

                }else{

                    $full_payment = ($new_select_payment_double*$work_percentage)/100;

                    $save_data = array(
                        'name'      => $select_name_to_string,
                        'username'  => $get_username,
                        'role'      => $select_role_to_string,
                        'start_date'=> $start_date,
                        'end_date'  => $end_date,
                        'month'     => $month,
                        'work_days' => $work_days,
                        'prasent_days'=>$countpresent,
                        'percentage' =>$work_percentage,
                        'basic_payments'   => $select_payment_double,
                        'etf'        => $etf_amount,
                        'epf'        => $epf_amount,
                        'bonus'      => 0,
                        'full_payment'=> $full_payment
                    );
                    Monthly_Salary::where('username','=',$get_username)->update($save_data);
                    // DB::table('monthly_salary')->update($save_data);

                }
                //return redirect()->back()->with('message_calSalary','Salary Calculation is updated for'.$get_username);
            }else{
                return redirect()->back()->with('message_calSalary_dgr','Salary Calculation is failed for'.$get_username);
            }
        }
        return redirect()->back()->with('message_calSalary','Salary Calculation is done');
    }
    public function CalSalary(Request $request){

        $name               = $request->input('name');
        $username           = $request->input('username');
        $role               = $request->input('role');
        $start_date         = $request->input('start_date');
        $end_date           = $request->input('end_date');
        $month              = $request->input('month');
        $work_days          = $request->input('work_days');

        $count_username = DB::table('monthly_salary')->select('username',$username)
                        ->where('username','=',$username)
                        ->count();

        $countpresent = DB::table('attendance') ->select('username',$username)
            ->where([['username','=',$username],['attendance','=','present']])
            ->count();

        $work_percentage = ($countpresent/$work_days)*100;

        $select_payment = DB::table('salary')->select('basic_salary')->where('role', $role)->get();

        //var_dump($select_payment);
        $select_payment_double = doubleval($select_payment[0]->basic_salary);

        //--------------- needed to add.. etf epf calculation.. -------------------------//
        //---------------calculate etf and epf  for worker----------------//

        $etf_amount = $select_payment_double * 0.03;

        $epf_amount_worker = $select_payment_double * 0.08;
        $epf_amount_company = $select_payment_double * 0.12;

        $epf_amount = $epf_amount_worker+$epf_amount_company;

        $new_select_payment_double = $select_payment_double - $epf_amount_worker;

        if ($count_username==0){

            if ($work_percentage==100){
                $select_bonus = DB::table('bonus')->select('bonus')->where('role',$role)->get();
                $select_bonus_double =doubleval($select_bonus[0]->bonus);

                //$full_payment = $select_payment_double + $select_bonus_double;
                $full_payment = $new_select_payment_double + $select_bonus_double;

                $save_data = array(
                    'name'      => $name,
                    'username'  => $username,
                    'role'      => $role,
                    'start_date'=> $start_date,
                    'end_date'  => $end_date,
                    'month'     => $month,
                    'work_days' => $work_days,
                    'prasent_days'=>$countpresent,
                    'percentage' =>$work_percentage,
                    'basic_payments'=> $select_payment_double,
                    'etf'        => $etf_amount,
                    'epf'        => $epf_amount,
                    'bonus'      => $select_bonus_double,
                    'full_payment'=> $full_payment
                );

                DB::table('monthly_salary')->insert($save_data);

            }else{
                $full_payment = ($new_select_payment_double*$work_percentage)/100;

                $save_data = array(
                    'name'      => $name,
                    'username'  => $username,
                    'role'      => $role,
                    'start_date'=> $start_date,
                    'end_date'  => $end_date,
                    'month'     => $month,
                    'work_days' => $work_days,
                    'prasent_days'=>$countpresent,
                    'percentage' =>$work_percentage,
                    'basic_payments'   => $select_payment_double,
                    'etf'        => $etf_amount,
                    'epf'        => $epf_amount,
                    'bonus'      => 0,
                    'full_payment'=> $full_payment
                );

                DB::table('monthly_salary')->insert($save_data);

            }
            return redirect()->back()->with('message_calSalary','Salary Calculation is done for'.$name);
        }elseif ($count_username==1){

            if ($work_percentage==100){
                //cal salary for relevant role
                $select_bonus = DB::table('bonus')->select('bonus')->where('role',$role)->get();
                $select_bonus_double =doubleval($select_bonus[0]->bonus);

                $full_payment = $new_select_payment_double + $select_bonus_double;

                $save_data = array(
                    'name'      => $name,
                    'username'  => $username,
                    'role'      => $role,
                    'start_date'=> $start_date,
                    'end_date'  => $end_date,
                    'month'     => $month,
                    'work_days' => $work_days,
                    'prasent_days'=>$countpresent,
                    'percentage' =>$work_percentage,
                    'basic_payments'   => $select_payment_double,
                    'etf'        => $etf_amount,
                    'epf'        => $epf_amount,
                    'bonus'      => $select_bonus_double,
                    'full_payment'=> $full_payment
                );
                Monthly_Salary::where('username','=',$username)->update($save_data);
                //DB::table('monthly_salary')->update($save_data);

            }else{
                /*
                $select_payment = DB::table('salary')->select('basic_salary',$basic_salary)
                    ->where('role','=',$role);
                */
                $full_payment = ($new_select_payment_double*$work_percentage)/100;

                $save_data = array(
                    'name'      => $name,
                    'username'  => $username,
                    'role'      => $role,
                    'start_date'=> $start_date,
                    'end_date'  => $end_date,
                    'month'     => $month,
                    'work_days' => $work_days,
                    'prasent_days'=>$countpresent,
                    'percentage' =>$work_percentage,
                    'basic_payments'   => $select_payment_double,
                    'etf'        => $etf_amount,
                    'epf'        => $epf_amount,
                    'bonus'      => 0,
                    'full_payment'=> $full_payment
                );
                Monthly_Salary::where('username','=',$username)->update($save_data);
               // DB::table('monthly_salary')->update($save_data);

            }
            return redirect()->back()->with('message_calSalary','Salary Calculation is updated for'.$name);
        }else{
            //redirect with error massesge
            return redirect()->back()->with('message_calSalary_dgr','Salary Calculation is failed for'.$name);
        }

    }

    //------------------- PaySalary ----------------------------------------//

    public function PaySalary(){

        $worker_name          =   Input::get('worker_name');
        $worker_username      =   Input::get('worker_username');
        $worker_month         =   Input::get('worker_month');
        $worker_percentage    =   Input::get('worker_percentage');
        $worker_bonus         =   Input::get('worker_bonus');
        $worker_basic_payment =   Input::get('worker_basic_payment');
        $worker_fullpayment   =   Input::get('worker_fullpayment');
        $worker_etf           =   Input::get('worker_etf');
        $worker_epf           =   Input::get('worker_epf');

        $select_role = DB::table('workers')->select('role')
                                        ->where('username','=',$worker_username)
                                        ->get();
        $select_role_to_string  = strval($select_role[0]->role);

        $select_etf_amount =  DB::table('monthly_salary')->select('etf')->get();
        $select_etf_to_double   = doubleval($select_etf_amount[0]->etf);

        $select_epf_amount =  DB::table('monthly_salary')->select('epf')->get();
        $select_epf_to_double   = doubleval($select_epf_amount[0]->epf);
        //---------------------- select etf and epf uer row count-----------
        $select_user_row_count = DB::table('etf_epf')->select('username')->where('username','=',$worker_username)->count();
        //--------------------- get count of username and month in payment_history---------------//
        $select_month_row_count = DB::table('payment_history')->select('month')->where('month','=',$worker_month)->count();

        $old_attendance_data = Attendance::select('name','date','attendance','username')->where('username','=',$worker_username)->get();
        $old_attendance_count_data = AttendanceCount::select('username','count','absance_count')->where('username','=',$worker_username)->get();

        //-------relevant worker->cal etf and epf and update ------------
        $save_etfepf = array([
            'username'=>$worker_username,
            'etf'    =>$select_etf_to_double,
            'epf'    =>$select_epf_to_double
        ]);

        $save_payment = array([
            'name'      => $worker_name,
            'username'  => $worker_username,
            'role'      => $select_role_to_string,
            'month'     => $worker_month,
            'percentage'=> $worker_percentage,
            'basic_payment'=> $worker_basic_payment,
            'etf'       => $worker_etf,
            'epf'       => $worker_epf,
            'bonus'     => $worker_bonus,
            'full_payment'=> $worker_fullpayment,
            'statement'   => 'paid'
        ]);

        $save_to_expence =  array([
            'description'   => 'pay salary for '.$worker_username,
            'amount'        => $worker_fullpayment
        ]);

        if ($select_user_row_count==0){
            //new etf and epf worker arrives
            DB::table('etf_epf')->insert($save_etfepf);

            DB::table('payment_history')->insert($save_payment);

            foreach($old_attendance_data as $data){
                $new_data = new Attendance_History();
                $new_data->name = $data->name;
                $new_data->username = $data->username;
                $new_data->date = $data->date;
                $new_data->attendance = $data->attendance;

                $new_data->save();
            }
            foreach($old_attendance_count_data as $data){
                $new_data = new AttendanceCount_History();
                $new_data->username = $data->username;
                $new_data->count = $data->count;
                $new_data->absance_count = $data->absance_count;

                $new_data->save();
            }
            //------ code for delete attendance for the relavant username in attendance table
            DB::table('expense')->insert($save_to_expence);
            Attendance::where('username','=',$worker_username)->delete();
            AttendanceCount::where('username','=',$worker_username)->delete();
            Monthly_Salary::where('username','=',$worker_username)->delete();

            return redirect()->back()->with('message_calSalary','done');
        }else if ($select_user_row_count==1){
            $select_etf_amount_etfepf =  DB::table('etf_epf')->select('etf')->where('username','=',$worker_username)->get();
            $select_etf_to_double_etf   = doubleval($select_etf_amount_etfepf[0]->etf);

            $select_epf_amount_etfepf =  DB::table('etf_epf')->select('epf')->where('username','=',$worker_username)->get();
            $select_epf_to_double_epf   = doubleval($select_epf_amount_etfepf[0]->epf);
            Basic_ETF_EPF::where('username','=',$worker_username)
                ->update([
                    'etf'=>$select_etf_to_double+$select_etf_to_double_etf,
                    'epf'=>$select_epf_to_double+$select_epf_to_double_epf
                ]);
            DB::table('payment_history')->insert($save_payment);

            foreach($old_attendance_data as $data){
                $new_data = new Attendance_History();
                $new_data->name = $data->name;
                $new_data->username = $data->username;
                $new_data->date = $data->date;
                $new_data->attendance = $data->attendance;

                $new_data->save();
            }
            foreach($old_attendance_count_data as $data){
                $new_data = new AttendanceCount_History();
                $new_data->username = $data->username;
                $new_data->count = $data->count;
                $new_data->absance_count = $data->absance_count;

                $new_data->save();
            }
            //------ code for delete attendance for the relavant username in attendance table
            DB::table('expense')->insert($save_to_expence);
            Attendance::where('username','=',$worker_username)->delete();
            AttendanceCount::where('username','=',$worker_username)->delete();
            Monthly_Salary::where('username','=',$worker_username)->delete();
            return redirect()->back()->with('message_calSalary','done');
        }else{
            return redirect()->back()->with('message_calSalary_dgr','Error');
        }
    }

    //-------------------- Item Store Registration-------------------//
    public function RegisterStore(Request $request){
        $this->validate($request,[
            'item_code'  =>  'unique:store_list'
        ]);
        $item_name = $request->input('item_name');
        $item_code = $request->input('item_code');
        $item_category = $request->input('item_category');
        $item_count = $request->input('item_count');
        $item_store_price = $request->input('item_store_price');
        $item_sale_price = $request->input('item_sale_price');

        $item_store_full_price = $item_count*$item_store_price;

        $save_items = array([
            'item_name'     =>$item_name,
            'item_code'     => $item_code,
            'item_category' =>$item_category,
            'item_count'    =>$item_count,
            'item_store_price'=>$item_store_price,
            'item_store_full_price'=>$item_store_full_price,
            'item_sale_price' =>$item_sale_price
        ]);
        if(DB::table('store_list')->insert($save_items)){
            return redirect()->back()->with('store_message','Added to Store List Success');
        }else{
            return redirect()->back()->with('store_message_dgr','Failed to added store list');
        }
    }
    //------------------- Item Store List Edit -----------------------//
    public function EditStoreList(){
        $id = Input::get('item_id');
        $item_count = Input::get('item_count');
        $item_store_price = Input::get('item_store_price');
        $item_sale_price = Input::get('item_sale_price');

        Store_List::where('item_id','=',$id)
                    ->update(['item_count'=>$item_count,
                            'item_store_price'=>$item_store_price,
                            'item_store_full_price'=>($item_count*$item_store_price),
                            'item_sale_price'=>$item_sale_price

                    ]);
        return redirect()->back()->with('message_update_store_list','Update item id '.$id);
    }

    //------------------- Item store save in store table and tranfer the data into expenses table------------------//

    public function TransferData(Request $request){

        $item_name = $request->input('item_name');
        $item_code = $request->input('item_code');
        $item_category = $request->input('item_category');
        $item_count = $request->input('item_count');
        $item_store_price = $request->input('item_store_price');
        $item_sale_price = $request->input('item_sale_price');

        $item_store_full_price = $item_count*$item_store_price;

        //$amount = DB::table('store_list')->sum('item_store_full_price');
        $amount = DB::table('store_list')->select('item_store_full_price')->where('item_code','=',$item_code)->get();
        $get_amount_double = doubleval($amount[0]->item_store_full_price);
        $new_amount= $get_amount_double;

        $count_item_code = DB::table('stores')->select('item_code',$item_code)->where('item_code','=',$item_code)->count();
        /*
        $get_item_count = DB::table('stores')->select('item_count')->where('item_code','=',$item_code)->get();
        $get_item_int = intval($get_item_count[0]->item_count);
        $new_item_count = $item_count+$get_item_int;*/

        $count_rows_store_book = Store_Book::count();

        if ($count_item_code==0){
            $save_items = array([
                'item_name'     =>$item_name,
                'item_code'     => $item_code,
                'item_category' =>$item_category,
                'item_count'    =>$item_count,
                'item_store_price'=>$item_store_price,
                'item_store_full_price'=>$item_store_full_price,
                'item_sale_price' =>$item_sale_price
            ]);
                if ($count_rows_store_book==0){
                    $save_to_store_book = array([
                        'description' =>'Store Takes From David Pieris',
                        'amount'      =>$new_amount
                    ]);
                    DB::table('store_book')->insert($save_to_store_book);
                }else{
                    $select_amount = DB::table('store_list')->select('item_store_full_price')->where('item_code','=',$item_code)->get();
                    $get_amount_double = doubleval($select_amount[0]->item_store_full_price);

                    $select_amount_1 = DB::table('store_book')->select('amount')->where('description','=','Store Takes From David Pieris')->get();
                    $get_amount_double_1 = doubleval($select_amount_1[0]->amount);

                    $new_amount= $get_amount_double+$get_amount_double_1;

                    Store_Book::where('description','=','Store Takes From David Pieris')
                            ->update([
                                'description'=>'Store Takes From David Pieris',
                                'amount'=>$new_amount
                            ]);
                }

                if(DB::table('stores')->insert($save_items)){
                    //remove the relavent row
                    Store_List::where('item_code','=',$item_code)->delete();
                    return redirect()->back()->with('message_move_to_store','Added to Store Success');
                }else{
                    return redirect()->back()->with('message_move_to_store_dgr','Failed to added Store');
                }
        }else{

            $get_item_count = DB::table('stores')->select('item_count')->where('item_code','=',$item_code)->get();
            $get_item_int = intval($get_item_count[0]->item_count);
            $new_item_count = $item_count+$get_item_int;


            if ($count_rows_store_book==0){
                $save_to_store_book = array([
                    'description' =>'Store Takes From David Pieris',
                    'amount'      =>$new_amount
                ]);
                DB::table('store_book')->insert($save_to_store_book);
            }else{
                $select_amount = DB::table('store_list')->select('item_store_full_price')->where('item_code','=',$item_code)->get();
                $get_amount_double = doubleval($select_amount[0]->item_store_full_price);

                $select_amount_1 = DB::table('store_book')->select('amount')->where('description','=','Store Takes From David Pieris')->get();
                $get_amount_double_1 = doubleval($select_amount_1[0]->amount);

                $new_amount= $get_amount_double+$get_amount_double_1;

                Store_Book::where('description','=','Store Takes From David Pieris')
                    ->update([
                        'description'=>'Store Takes From David Pieris',
                        'amount'=>$new_amount
                    ]);
            }

            Stores::where('item_code','=',$item_code)
                ->update(['item_count'=>$new_item_count,
                    'item_store_price'=>$item_store_price,
                    'item_store_full_price'=>($new_item_count*$item_store_price),
                    'item_sale_price'=>$item_sale_price

                ]);

             //remove the relavent row
            Store_List::where('item_code','=',$item_code)->delete();
            return redirect()->back()->with('message_move_to_store','Updated Store Success '.$new_item_count);
        }


    }

    //-------------------- Data transfer to Expense Table---------------->
    public function ToExpense(){
        $old_date = Store_Book::select('description','amount')->get();

        foreach($old_date as $data){
            $new_data = new Expense();
            $new_data->description = $data->description;
            $new_data->amount = $data->amount;

            $new_data->save();
        }

        $old_store_book_data = Store_Book::select('description','amount')->get();

        foreach($old_store_book_data as $data){
            $new_data = new Store_Book_TTS();

            $new_data->description = $data->description;
            $new_data->amount = $data->amount;

            $new_data->save();

        }
        Store_List::truncate();
        Store_Book::truncate();
        //delete the data of store list table and store book table
        return redirect()->back()->with('message_to_expense','transfered the data');
    }

    public function ReturnItems(Request $request){
        $item_code  = $request->input('item_code');
        $item_count = $request->input('item_count');
        $type       = $request->input('type');

        $get_item_code_count = DB::table('stores')->select('item_code')
            ->where('item_code','=',$item_code)
            ->count();

        if ($type=='damaged'){
            if ($get_item_code_count==0){
                return redirect()->back()->with('store_return_messagedgr','There was no item code :'.$item_code);
            }else{
                $select_item_store_price = DB::table('stores')->select('item_store_price')
                    ->where('item_code','=',$item_code)
                    ->get();
                $item_store_price = doubleval($select_item_store_price[0]->item_store_price);

                $select_item_store_full_price = DB::table('stores')->select('item_store_full_price')
                    ->where('item_code','=',$item_code)
                    ->get();
                $item_store_full_price = doubleval($select_item_store_full_price[0]->item_store_full_price);

                $select_item_count = DB::table('stores')->select('item_count')
                    ->where('item_code','=',$item_code)
                    ->get();
                $item_store_count = doubleval($select_item_count[0]->item_count);

                $new_item_store_full_price = $item_store_full_price-($item_store_price*$item_count);
                $new_item_count = $item_store_count - $item_count;

                $check_item_code = DB::table('return_store')->select('item_code')->where('item_code','=',$item_code)->count();

                if ($check_item_code == 0){
                    $save_to_return = array([
                       'item_code' => $item_code,
                       'item_count'=> $item_count,
                        'value'     => $item_store_price
                    ]);
                    DB::table('return_store')->insert($save_to_return);
                }else{
                    $get_item_count_from_return_store = DB::table('return_store')->select('item_count')->where('item_code','=',$item_code)->get();
                    $get_item_count_from_return_store_to_int = intval($get_item_count_from_return_store[0]->item_count);

                    $get_value_from_return_store = DB::table('return_store')->select('value')->where('item_code','=',$item_code)->get();
                    $get_value_from_return_store_to_double = doubleval($get_value_from_return_store[0]->value);

                    Return_Store::where('item_code','=',$item_code)
                        ->update([
                            'item_count'=> ($item_count+$get_item_count_from_return_store_to_int),
                            'value'     => ($item_store_price+$get_value_from_return_store_to_double)
                        ]);
                }

                Stores::where('item_code','=',$item_code)
                    ->update([
                        'item_count'=>$new_item_count,
                        'item_store_full_price'=>$new_item_store_full_price
                    ]);
                return redirect()->back()->with('store_return_message','Add item to damaged-return book');
            }
        }elseif ($type=='returned'){
            $select_item_store_price = DB::table('stores')->select('item_store_price')
                ->where('item_code','=',$item_code)
                ->get();
            $item_store_price = doubleval($select_item_store_price[0]->item_store_price);

            $select_item_sale_price = DB::table('stores')->select('item_sale_price')
                ->where('item_code','=',$item_code)
                ->get();
            $get_item_sale_price = doubleval($select_item_sale_price[0]->item_sale_price);

            $select_item_store_full_price = DB::table('stores')->select('item_store_full_price')
                ->where('item_code','=',$item_code)
                ->get();
            $item_store_full_price = doubleval($select_item_store_full_price[0]->item_store_full_price);

            $select_item_count = DB::table('stores')->select('item_count')
                ->where('item_code','=',$item_code)
                ->get();
            $item_store_count = doubleval($select_item_count[0]->item_count);
            $new_item_count = $item_store_count+$item_count;

            $value_return = $item_store_price*$item_count;
            $value = $value_return+$item_store_full_price;
            $value_to_returned = $item_count*$get_item_sale_price;

            Stores::where('item_code','=',$item_code)
                ->update([
                    'item_count'=>$new_item_count,
                    'item_store_full_price'=>$value
                ]);
            //--------- update expense book as expense return money to customer-----------------------
            $save_to_expense = array([
                'description'    =>  'customer returned',
                'amount'         =>   $value_to_returned
            ]);
            DB::table('expense')->insert($save_to_expense);
            return redirect()->back()->with('store_return_message','Returned to store');
        }



    }

    public function RestoreReturn(){

       $item_code= Input::get('item_code');
       $item_count = Input::get('item_count');
       $amount = Input::get('restore_value');

       $select_item_count_in_store = DB::table('stores')->select('item_count')
                                                       ->where('item_code','=',$item_code)
                                                       ->get();
       $get_item_count = intval($select_item_count_in_store[0]->item_count);
       $new_item_count = $get_item_count+$item_count;

       $select_store_price = DB::table('stores')->select('item_store_price')
                                                ->where('item_code','=',$item_code)
                                                ->get();
       $get_store_price =doubleval($select_store_price[0]->item_store_price);

       $select_store_full_price = DB::table('stores')->select('item_store_full_price')
                                                    ->where('item_code','=',$item_code)
                                                    ->get();
       $get_store_full_price = doubleval($select_store_full_price[0]->item_store_full_price);
       $return_value = $get_store_price*$item_count;

        $get_new_store_full_price = $get_store_full_price+$return_value;

       $select_count_item_code = DB::table('stores')->select('item_code')
                                                   ->where('item_code','=',$item_code)
                                                   ->count();
       if($select_count_item_code==0){
           return redirect()->back()->with('message_return_dgr','Stock have no records of this Item');
       }else{
           Stores::where('item_code','=',$item_code)
                   ->update([
                      'item_count' => $new_item_count,
                       'item_store_full_price' => $get_new_store_full_price
                   ]);
           Return_Store::where('item_code','=',$item_code)->delete();
       }
        return redirect()->back()->with('message_return','Returned and Restored Item '.$item_code);
    }

    public function RestoreCash(){
        $item_code= Input::get('item_code');
        $item_count = Input::get('item_count');
        $amount = Input::get('restore_value');

        $select_store_price = DB::table('stores')->select('item_store_price')
            ->where('item_code','=',$item_code)
            ->get();
        $get_store_price =doubleval($select_store_price[0]->item_store_price);

        $value_of_store = $get_store_price*$item_count;

        $save_income_from_return_items = array([
            'description'=>'cash received from damaged item '.$item_code,
            'amount'=> $value_of_store
        ]);
        DB::table('income')->insert($save_income_from_return_items);
        Return_Store::where('item_code','=',$item_code)->delete();

        return redirect()->back()->with('message_return','Returned and Restored Item '.$item_code);
    }

    public function generatePDF()
    {
        $data = ['title' => 'Welcome to HDTuto.com'];
        $pdf = PDF::loadView('Admin.myPDF', $data);

        return $pdf->download('itsolutionstuff.pdf');
    }

    public function AddToBill(Request $request){
        $id = Input::get('item_id');
        $item_code = Input::get('item_code');
        $item_name = Input::get('item_name');
        $item_count = Input::get('item_count');
        $item_store_price = Input::get('item_store_price');
        $item_sale_price = Input::get('item_sale_price');

        $desc = $item_name.'*'.$item_count;
        $cost = $item_count*$item_sale_price;
        if ($item_count<1){
            return redirect()->back()->with('message_bill_info_dgr','item count is negative');
        }else{
            $get_item_count = DB::table('stores')->select('item_count')->where('item_id','=',$id)->get();
            $get_item_count_int = intval($get_item_count[0]->item_count);

            $new_item_count = $get_item_count_int - $item_count;
            $new_item_store_full_price = $new_item_count * $item_store_price;

            $save_to_invoice = array([
                'item_name' => $item_name,
                'item_code'=>$item_code,
                'item_count'=> $item_count,
                'item_sale_price'=>$item_sale_price,
                'invoice_desc' => $desc,
                'cost'      => $cost
            ]);

            Stores::where('item_id','=',$id)
                ->update([
                    'item_count'=>$new_item_count,
                    'item_store_full_price'=>$new_item_store_full_price
                ]);


            DB::table('invoice')->insert($save_to_invoice);
            return redirect()->back()->with('message_bill_info','Bill Ok');
        }

    }

    public function offerBill(){
        $invoice_detail = Invoice::all();
        $full_price = DB::table('invoice')->sum('cost');

        $save_bill_info =  array([
            'description' =>'customer',
            'amount'      =>$full_price
        ]);
        DB::table('income')->insert($save_bill_info);

        Invoice::truncate();

        $pdf = PDF::loadView('Admin.CustomerInvoice',['full_price'=>$full_price],['invoice_detail'=>$invoice_detail]);
        return $pdf->download('Customer.pdf');

    }

    public function BillInfo(){
        $id = Input::get('item_id');
        $item_count = Input::get('item_count');
        $item_store_price = Input::get('item_store_price');
        $item_sale_price = Input::get('item_sale_price');

        $price = $item_count*$item_sale_price;

        $get_item_count = DB::table('stores')->select('item_count')->where('item_id','=',$id)->get();
        $get_item_count_int = intval($get_item_count[0]->item_count);

        $new_item_count = $get_item_count_int - $item_count;
        $new_item_store_full_price = $new_item_count * $item_store_price;

        if ($new_item_count<1){
            return redirect()->back()->with('message_bill_info_dgr','item count is negative');
        }else{
        //-------------update store using -item count and item store full price (current)------------------
         $data = ['title' => '--Tuk Tuk Service--',
                    'item_name' => 'Item Name',
                    'item_sale_price'=>$item_sale_price,
                    'item_count'=>$item_count,
                    'price'=>$price];
         $pdf = PDF::loadView('Admin.myPDF', $data);

        Stores::where('item_id','=',$id)
            ->update([
                'item_count'=>$new_item_count,
                'item_store_full_price'=>$new_item_store_full_price
            ]);
        //------------- save detail in income table -------------------
        $save_bill_info =  array([
            'description' =>'customer',
            'amount'      =>$price
        ]);
            DB::table('income')->insert($save_bill_info);
            return $pdf->download('itsolutionstuff.pdf');
            //return redirect()->back()->with('message_bill_info','Bill Ok');
        }
    }

    public function Dashboard(){
        //----get full income-----------//

        $get_income  = DB::table('income')->sum('amount');
        $get_expense = DB::table('expense')->sum('amount');
        $get_comment_count  = DB::table('comments')->count();
        $get_notices    = ToDoList::all();

        $timestemp = date('Y-m-d');

        $get_today_workers_count   = DB::table('attendance')->where([['date','=',$timestemp],['attendance','=','present']])->count();
        $get_today_reservation  =   DB::table('reservation')->where('date','=',$timestemp)->count();

        $get_todoList   =   DB::table('to_do_list')->where('date','=',$timestemp)->count();

        if($get_income==0){
            $get_profit_percentage = 'Profit is Zero';
        }else{
            $get_profit_percentage  =   ($get_income-$get_expense);
        }

        //--------chart code----------------------
        $total_income_customer = DB::table('income')->where('description','=','customer')->sum('amount');
        $total_income_service  = DB::table('income')->where('description', 'LIKE', '%'.'service charged from'. '%' )->sum('amount');
        $total_income_other    = DB::table('income')->where('description', 'LIKE', '%'.'Other Income:'. '%' )->sum('amount');

        $chart1 = new SampleChart;

        $chart1->labels(['Amount']);
        $chart1->dataset('From Selling Items', 'bar', [$total_income_customer])->backgroundcolor('#3d6983');
        $chart1->dataset('From Service', 'bar', [$total_income_service])->backgroundcolor('#3d9983');
        $chart1->dataset('From Other', 'bar', [$total_income_other])->backgroundcolor('#3d6063');
        //$chart1->dataset('Income', 'bar', [$total_income_customer, $total_income_service])->options(['backgroundcolor' => 'black'])->backgroundcolor('lightgreen');;
        //------------------working---------------------------//
        //------ get last 4 month income and expense records
        $get_row_count = DB::table('income_monthly')->count();
        $get_expense_row_count = DB::table('expense_monthly')->count();
        if ($get_row_count==0){
            $get_1_to_String = 'no details found';
            $get_2_to_String = 'no details found';
        }else{
            $get_1 = DB::table('income_monthly')->select('description')->orderBy('income_date','desc')->get(3);
            $get_1_to_String =  strval($get_1[0]->description);
            $get_2_to_String =  strval($get_1[1]->description);
            $get_3_to_String =  strval($get_1[2]->description);

            $get_amount_1 = DB::table('income_monthly')->select('amount')->orderBy('income_date','desc')->get(3);
            $get_amount_1_to_String =  strval($get_amount_1[0]->amount);
            $get_amount_2_to_String =  strval($get_amount_1[1]->amount);
            $get_amount_3_to_String =  strval($get_amount_1[2]->amount);
        }

        if ($get_expense_row_count==0){
            $get_1_to_String = 'no details found';
            $get_2_to_String = 'no details found';
        }else{
            $get_amount_1 = DB::table('expense_monthly')->select('amount')->orderBy('expense_date','desc')->get(3);
            $get_expense_amount_1_to_String =  strval($get_amount_1[0]->amount);
            $get_expense_amount_2_to_String =  strval($get_amount_1[1]->amount);
            $get_expense_amount_3_to_String =  strval($get_amount_1[2]->amount);
        }


        $chart = new SampleChart;

        $chart->labels([$get_3_to_String,$get_2_to_String,$get_1_to_String]);
        $chart->dataset('Income', 'line', [$get_amount_3_to_String,$get_amount_2_to_String,$get_amount_1_to_String])->color('#1d6063');
        $chart->dataset('Expense', 'line', [$get_expense_amount_3_to_String,$get_expense_amount_2_to_String,$get_expense_amount_1_to_String])->color('black');
        //----------------------------------------------------------
        return view('Admin/DashBoard/dashborad',
            [
                'get_income'=>$get_income,
                'get_expense'=>$get_expense,
                'get_profit_percentage'=>$get_profit_percentage,
                'get_comment_count'=>$get_comment_count,
                //'get_today_income'=>$get_today_income,
                //'get_today_expense'=>$get_today_expense,
                'get_today_reservation'=>$get_today_reservation,
                'get_today_workers_count'=>$get_today_workers_count,
                'get_todoList'  =>  $get_todoList,
                'timestemp' =>  $timestemp
            ])
            ->with(compact('get_notices',$get_notices))
            ->with(compact('chart1',$chart1))
            ->with(compact('chart',$chart));

    }

    public function Chart(){
        $result = DB::table('stores')
            ->where('item_category','=','Break Washer')
            ->orWhere('item_category','=','Break Shoe')
            ->orWhere('item_category','=','Bore')
            ->orWhere('item_category','=','Lamp')
            ->orderBy('item_id', 'ASC')
            ->get();
        return response()->json($result);
    }
    public function Chart2(){
        $result1 = DB::table('attendance_count')
            ->where('username','=','TTS01')
            ->orWhere('username','=','TTS02')
            ->orderBy('count_id', 'ASC')
            ->get();
        return response()->json($result1);
    }


    //------------------------- function for service----------------------//
    public function AddNewService(Request $request){
        $service_name = $request->input('service_name');
        $service_price = $request->input('service_price');

        $count = DB::table('service')->where('service_name','=',$service_name)->count();

        if ($count==0){
            $save_service = array([
                'service_name'  => $service_name,
                'service_price' => $service_price
            ]);

            DB::table('service')->insert($save_service);
            return redirect()->back()->with('addservice_message','Service added Success');
        }else{
            return redirect()->back()->with('addservice_dgr','Service added Failed');
        }
    }

    public function EditSerrviceList(){
        $service_id = Input::get('service_id');
        $service_name= Input::get('service_name');
        $service_price= Input::get('service_price');

        Services::where('service_id','=',$service_id)
            ->update(['service_name'=>$service_name,
                'service_price'=>$service_price
            ]);
        return redirect()->back()->with('message_update_service_list','Update item id');

    }

    public function DeleteService(){
        $id= Input::get('service_id');
        Services::where('service_id','=',$id)->delete();
        return redirect()->back()->with('messagedelete_service','Deleted');
    }

    public function JobBookSearch(){
        $service_detaill  = Services::all();
        $job_book_details = JobBook::all();
        $job_book_temp_details = JobBookTemp::all();
        $get_amount = DB::table('job_book_temp')->sum('cost');

        $search = Input::get ( 'search' );
        $item = JobBookDesc::where ( 'owner_nic', 'LIKE', '%' . $search. '%' )
            ->orWhere('tw_number', 'LIKE', '%' . $search. '%' )
            ->get ();

        //$item = Stores::where ( 'item_code','=',$search)->get();
        if (count ($item) > 0)
            return view ( 'Admin/Service.job_book_search',['get_amount'=>$get_amount])
                ->withDetails ($item)->withQuery ($search)
                ->with(compact('service_detaill',$service_detaill))
                ->with(compact('job_book_details',$job_book_details))
                ->with(compact('job_book_temp_details',$job_book_temp_details));
        else
            return view ( 'Admin/Service.job_book_search',['get_amount'=>$get_amount])
                        ->withMessage ( 'No Details found. Try to search again !' )
                        ->with(compact('service_detaill',$service_detaill))
                        ->with(compact('job_book_details',$job_book_details))
                        ->with(compact('job_book_temp_details',$job_book_temp_details));
    }

    public function AddJobBook(Request $request){
        $this->validate($request,[
            'tw_number'         => 'unique:job_book',
            'owner_nic'         => 'unique:job_book',
            'tw_eng_num'        => 'unique:job_book',
            'tw_ch_number'      => 'unique:job_book'
        ]);

        $tw_number     = $request->input('tw_number');
        $tw_ch_number  = $request->input('tw_ch_number');
        $tw_eng_number = $request->input('tw_eng_number');
        $stork         = $request->input('stork');
        $owner_name    = $request->input('owner_name');
        $owner_nic     = $request->input('owner_nic');

        $count = DB::table('customer_register')->select('username')->where('username','=',$owner_nic)->count();

        $save_to_customer_reg = array([
            'name'   =>  $owner_name,
            'nic'    =>  $owner_nic,
            'mobile_number'  =>  '',
            'email'     =>  '',
            'tw_number' =>  $tw_number,
            'tw_ch_number'  =>  $tw_ch_number,
            'tw_eng_number' =>  $tw_eng_number,
            'tw_type'   =>  $stork,
            'username'  =>  $owner_nic
        ]);

        $save_to_user_table = array(
            'username'   =>  $owner_nic,
            'password'   =>  bcrypt($owner_nic),
            'role'       =>  'user'
        );

        $save_job_book =  array([
            'tw_number'      =>  $tw_number,
            'tw_ch_number'   =>  $tw_ch_number,
            'tw_eng_number'  =>  $tw_eng_number,
            'stork'          =>  $stork,
            'owner_name'     =>  $owner_name,
            'owner_nic'      =>  $owner_nic
        ]);

        $save_job_book_desc = array([
            'tw_number'      =>  $tw_number,
            'owner_nic'      =>  $owner_nic,
            'job_desc'       =>  'Job Book Created'
        ]);

        //-------- creating account ----------//


        $get_count = DB::table('job_book')->where('owner_nic','=',$owner_nic)->count();

        if ($count==0){
            if($get_count == 0){
                DB::table('job_book')->insert($save_job_book);
                DB::table('job_book_desc')->insert($save_job_book_desc);
                DB::table('customer_register')->insert($save_to_customer_reg);
                DB::table('users')->insert($save_to_user_table);

                return redirect()->back()->with('message_job_book_add','Account created and New Job Book Created');
            }else{
                return redirect()->back()->with('message_job_book_add_dgr','Not Created');
            }
        }


    }

    public function AddJobToOwner(Request $request){

        $tw_number     = $request->input('tw_number');
        $owner_nic     = $request->input('owner_nic');
        $job_desc      = $request->input('job_desc');

        $save_job_book_desc =  array([
            'tw_number'      =>  $tw_number,
            'owner_nic'      =>  $owner_nic,
            'job_desc'       =>  $job_desc
        ]);

        DB::table('job_book_desc')->insert($save_job_book_desc);
        return redirect()->back()->with('message_job_book_add','New Job Added to '.$tw_number);

    }

    public function AddTempJobList(Request $request){
        $job_desc = $request->Input('job_desc');
        $job_desc_count = $request->Input('job_desc_count');

        $get_value = DB::table('service')->select('service_price')->where('service_name','=',$job_desc)->get();
        $get_service_price_to_double = doubleval($get_value[0]->service_price);
        $get_service_job_desc_full_price = $get_service_price_to_double*$job_desc_count;

        $save_temp_jobList = array([
            'job_desc'  =>  $job_desc."* count ".$job_desc_count,
            'cost'      =>  $get_service_job_desc_full_price
        ]);
        DB::table('job_book_temp')->insert($save_temp_jobList);
        return redirect()->back()->with('temp_jobAdded','Added Success');
    }

    public function TransferJobDesc(Request $request){
        $tw_number  =   $request->Input('tw_number');
        $service    =   $request->Input('service');
//        $spare_parts=   $request->Input('spare_parts');

        $check_tw_number = DB::table('job_book')->where('tw_number','=',$tw_number)->count();


        $get_full_cost   = DB::table('job_book_temp')->sum('cost');

//        $get_nic         = DB::table('job_book')->select('owner_nic')->where('tw_number','=',$tw_number)->get();
//        $get_nic_to_string = strval($get_nic[0]->owner_nic);

//        $get_owner_name         = DB::table('job_book')->select('owner_name')->where('tw_number','=',$tw_number)->get();
//        $get_owner_name_to_string = strval($get_owner_name[0]->owner_name);
//
//        $get_ch_number         = DB::table('job_book')->select('tw_ch_number')->where('tw_number','=',$tw_number)->get();
//        $get_ch_number_to_string = strval($get_ch_number[0]->tw_ch_number);

//        $get_eng_number         = DB::table('job_book')->select('tw_eng_number')->where('tw_number','=',$tw_number)->get();
//        $get_eng_number_to_string = strval($get_eng_number[0]->tw_eng_number);

//        $get_stork         = DB::table('job_book')->select('stork')->where('tw_number','=',$tw_number)->get();
//        $get_stork_to_string = strval($get_stork[0]->stork);

        $count_rows_job_desc_temp = JobBookTemp::count();
        $get_job_desc_details = DB::table('job_book_temp')->pluck('job_desc');

        if($count_rows_job_desc_temp!=0){

            if ($check_tw_number==1){

                $get_nic         = DB::table('job_book')->select('owner_nic')->where('tw_number','=',$tw_number)->get();
                $get_nic_to_string = strval($get_nic[0]->owner_nic);

                $get_owner_name         = DB::table('job_book')->select('owner_name')->where('tw_number','=',$tw_number)->get();
                $get_owner_name_to_string = strval($get_owner_name[0]->owner_name);

                $get_ch_number         = DB::table('job_book')->select('tw_ch_number')->where('tw_number','=',$tw_number)->get();
                $get_ch_number_to_string = strval($get_ch_number[0]->tw_ch_number);

                $get_eng_number         = DB::table('job_book')->select('tw_eng_number')->where('tw_number','=',$tw_number)->get();
                $get_eng_number_to_string = strval($get_eng_number[0]->tw_eng_number);

                $get_stork         = DB::table('job_book')->select('stork')->where('tw_number','=',$tw_number)->get();
                $get_stork_to_string = strval($get_stork[0]->stork);

                if($service=='free'){
                    $save_to_upcoming_income = array([
                        'tw_number'     =>  $tw_number,
                        'tw_ch_number'  =>  $get_ch_number_to_string,
                        'tw_eng_number' =>  $get_eng_number_to_string,
                        'stork'         =>  $get_stork_to_string,
                        'owner_nic'     =>  $get_nic_to_string,
                        'owner_name'    =>  $get_owner_name_to_string,
                        'job_desc'      =>  $get_job_desc_details,
                        'cost'          =>  $get_full_cost
                    ]);

                    DB::table('upcoming_income_services')->insert($save_to_upcoming_income);
                    //----------- details goes to job_book_desc-----------------
                    //$get_job_desc_details = DB::table('job_book_temp')->pluck('job_desc');

                    $save_to_job_desc = array([
                        'tw_number' =>  $tw_number,
                        'owner_nic' =>  $get_nic_to_string,
                        'job_desc'  =>  $get_job_desc_details
                    ]);
                    DB::table('job_book_desc')->insert($save_to_job_desc);
                    JobBookTemp::truncate();
                    return redirect()->back()->with('transfer_job_detail','Transferred The Details');
                }else if ($service=='not_free'){
                    $save_to_income = array([
                        'description'    =>  'service charged from'.$tw_number,
                        'amount'         =>  $get_full_cost
                    ]);

                    DB::table('income')->insert($save_to_income);

                    //----------- details goes to job_book_desc-----------------
                    //$get_job_desc_details = DB::table('job_book_temp')->pluck('job_desc');

                    $save_to_job_desc = array([
                        'tw_number' =>  $tw_number,
                        'owner_nic' =>  $get_nic_to_string,
                        'job_desc'  =>  $get_job_desc_details
                    ]);
                    DB::table('job_book_desc')->insert($save_to_job_desc);
                    JobBookTemp::truncate();
                    return redirect()->back()->with('transfer_job_detail','Transferred the Details');
                }else{

                    return redirect()->back()->with('transfer_job_detail_dgr','Please Fill out Service Type');
                }

            }elseif ($check_tw_number==0){
                return redirect()->back()->with('transfer_job_detail_dgr','no threewheel found on that number');
            }
        }else{
                return redirect()->back()->with('transfer_job_detail_dgr','no details in list');
        }



//        if ($check_tw_number==1){
//            return redirect()->back()->with('transfer_job_detail','Transferred The Details'.$check_tw_number);
//        }else{
//            return redirect()->back()->with('transfer_job_detail','Error');
//        }
    }

    public function GotCheck(){
        $tw_number  =   Input::get('tw_number');
        $cost       =   Input::get('cost');

        $save_to_income = array([
           'description'    =>  'got the check from David Pieris for service charge from '.$tw_number,
            'amount'        =>  $cost
        ]);

        DB::table('income')->insert($save_to_income);
        DB::table('upcoming_income_services')->where('tw_number','=',$tw_number)->delete();

        return redirect()->back()->with('check_received','transfer the detail to income');
    }

    //----------------------------Others ----------------
    public function OtherExpenseToExpense(Request $request){
        $other_expense  =   $request->Input('other_expenses');
        $pay_amount     =   $request->Input('pay_amount');

        $save_to_expense =   array([
           'description'    =>  'Other Expense: '.$other_expense,
           'amount'         =>  $pay_amount
        ]);
        DB::table('expense')->insert($save_to_expense);
        return redirect()->back()->with('other_expense_to_expense','Expense Added');
    }

    public function OtherIncomeToIncome(Request $request){
        $other_income  =   $request->Input('other_income');
        $pay_amount     =   $request->Input('pay_amount');

        $save_to_income =   array([
            'description'    =>  'Other Income: '.$other_income,
            'amount'         =>  $pay_amount
        ]);
        DB::table('income')->insert($save_to_income);
        return redirect()->back()->with('other_income_to_expense','Income Added');
    }

    public function deleteComment(){
        $comment_id = Input::get('comment_id');
        DB::table('comments')->where('id','=',$comment_id)->delete();
        return redirect()->back()->with('delet_comment','Comment Removed');
    }

    //------------------ calculate monthly Income and Expense-----------------------
    public function calMonthlyIncome(){
        $get_monthly_income =   DB::table('income')->sum('amount');
        $timestemp = date('Y-m-d H:i:s');
        $year = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $timestemp)->year;
        $month = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $timestemp)->month;

        $save_to_monthly_income = array([
           'description'    =>  'Monthly Income for '.$year.'-'.$month,
           'amount'         =>  $get_monthly_income
        ]);
        DB::table('income_monthly')->insert($save_to_monthly_income);

        $old_date = Income::select('description','amount')->get();

        foreach($old_date as $data){
            $new_data = new IncomeBook();
            $new_data->description = $data->description;
            $new_data->amount = $data->amount;

            $new_data->save();
        }
        Income::truncate();

        return redirect()->back()->with('cal_income_for_month','calculate done');
    }

    public function calMonthlyExpense(){
        $get_monthly_expense =   DB::table('expense')->sum('amount');
        $timestemp = date('Y-m-d H:i:s');
        $year = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $timestemp)->year;
        $month = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $timestemp)->month;

        $save_to_monthly_expense = array([
            'description'    =>  'Monthly Expense for '.$year.'-'.$month,
            'amount'         =>  $get_monthly_expense
        ]);
        DB::table('expense_monthly')->insert($save_to_monthly_expense);

        $old_date = Expense::select('description','amount')->get();

        foreach($old_date as $data){
            $new_data = new ExpenseBook();
            $new_data->description = $data->description;
            $new_data->amount = $data->amount;

            $new_data->save();
        }
        Expense::truncate();

        return redirect()->back()->with('cal_expense_for_month','calculate done');
    }

    public function addToDoList(Request $request){
        $note   =   $request->Input('note');
        $date   =   $request->Input('date');
        $time   =   $request->Input('time');

        $save_to_do_list    =   array([
           'note'   =>  $note,
           'date'   =>  $date,
           'time'   =>  $time
        ]);

        DB::table('to_do_list')->insert($save_to_do_list);
        return redirect()->back()->with('message_toDoList','Add Notice');

    }

    public function deleteNotice(){
        $notice_id  =   Input::get('notice_id');
        DB::table('to_do_list')->where('notice_id','=',$notice_id)->delete();
        return redirect()->back()->with('notice_deleted_message','notice_deleted');
    }

    public function updateNews(){
        $news_id    =   Input::get('news_id');
        $news       =   Input::get('news');

        News::where('news_id','=',$news_id)->update([
           'news'   =>  $news
        ]);
        return redirect()->back()->with('updateNews_message','Updated');
    }

    public function deleteNews(){
        $news_id    =   Input::get('news_id');
        News::where('news_id','=',$news_id)->delete();
        return redirect()->back()->with('updateNews_message','Deleted');
    }

    public function publishNews(Request $request){
        $news   =   $request->input('news');

        $save_to_news   =   array([
           'news'   =>  $news
        ]);
        DB::table('news')->insert($save_to_news);
        return redirect()->back()->with('updateNews_message','News Published');
    }

    public function reservationDone(){
        $reserve_id  =   Input::get('reserve_id');

        $name       =   Input::get('name');
        $mobile_number       =   Input::get('mobile_number');
        $nic       =   Input::get('nic');
        $tw_number       =   Input::get('tw_number');
        $date       =   Input::get('date');
        $type       =   Input::get('type');
        $number       =   Input::get('number');

        $save_to_reserve_history = array([
            'name'=>$name,
            'mobile_number'=>$mobile_number,
            'nic'=>$nic,
            'tw_number'=>$tw_number,
            'date'=>$date,
            'type'=>$type,
            'number'=>$number
        ]);

        $check = DB::table('reservation_history')->insert($save_to_reserve_history);
        if ($check){
            Reservation::where('id','=',$reserve_id)->delete();
        }
        return redirect()->back()->with('reservationDone','Done');
    }

    public function reservationRemove(){
        $reserve_id  =   Input::get('reserve_id');

        DB::table('reservation')->where('id','=',$reserve_id)->delete();
        return redirect()->back()->with('reservationDone','Removed');
    }

    public function SendMail(Request $request){
        $subject = $request->input('subject');
        $email_to = $request->input('email_to');
        //$email_text = 'body hard cord';
        $email_text = $request->input('email_text');

        $data = array(
            'email_to' => $email_to,
            'subject' => $subject,
            'bodyMessage' => $email_text.'this is a body'
        );

        Mail::send('mail',$data,function($message) use($data){
            $message->to($data['email_to']);
            $message->subject($data['subject']);
            $message->setBody($data['bodyMessage'],'text/html');
            $message->from('tuktukser@gmail.com');
            $message->replyTo('tuktukser@gmail.com', $name = 'Mr.T.T.S.Admin');
        });
        return redirect()->back()->with('email','success'.$email_text);
    }

    public function EditAdminUsername(){
        $username=Auth::user()->username;

        $newusername = Input::get('username');

        User::where('username','=',$username)->update([
            'username'  =>  $newusername
        ]);
        return redirect()->back()->with('update_user','Updated');
    }

    public function updateAdminpassword(Request $request){
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Failed. The old password doesn't match.");
        }
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","Password confirmation failed");
        }
        $this->validate($request, [
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("success","Password successfully updated!");
    }

}
