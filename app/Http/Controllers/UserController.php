<?php

namespace App\Http\Controllers;

use App\Comments;
use App\News;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use\Illuminate\Support\Facades\Auth;
use\Illuminate\Support\Facades\Session;
use \DB;

class UserController extends Controller
{
    public function home_index(){
        $comments = Comments::orderBy('id', 'desc')->take(2)->get();
        $news = News::orderBy('news_id', 'desc')->take(5)->get();
        return view ('Home/home')
            ->with(compact('comments',$comments))
            ->with(compact('news',$news));
    }
    public function Reservation(Request $request){

        $name               = $request->input('name');
        $mobile_number      = $request->input('mobile_number');
        $nic                = $request->input('nic');
        $tw_number          = $request->input('tw_number');
        $date               = $request->input('date');
        $type               = $request->input('type');

        $count = DB::table('reservation')->where('date',$date)
            ->count();
        $count_tw_number_date = DB::table('reservation')->select('tw_number')->where('date','=',$date)->where('tw_number','=',$tw_number)->count();

        $count_nic_date = DB::table('reservation')->select('nic')->where('date','=',$date)->where('nic','=',$nic)->count();

        if (($count_tw_number_date==1)AND($count_nic_date==1)){
            return redirect()->back()->with('message_dgr','You have already reserve this date with your NIC and Threewheel Number');
        }else{
            if($count == 0){

                $num = 1;

                $save_data =array(
                    'name'            =>$name,
                    'mobile_number'   =>$mobile_number,
                    'nic'             =>$nic,
                    'tw_number'       =>$tw_number,
                    'date'            =>$date,
                    'type'            =>$type,
                    'number'          =>$num
                );

                DB::table('reservation')->insert($save_data);

                return redirect()->back()->with('message','Time Reservation Success,You are the first at that Day. Your number is:'.$num);

            }elseif ($count < 10){
                $num = $count +1;
                $save_data =array(
                    'name'            =>$name,
                    'mobile_number'   =>$mobile_number,
                    'nic'             =>$nic,
                    'tw_number'       =>$tw_number,
                    'date'            =>$date,
                    'type'            =>$type,
                    'number'          =>$num
                );

                DB::table('reservation')->insert($save_data);

                return redirect()->back()->with('message','Time Reservation is success, Your Number is:'.$num);

            }else{

                return redirect()->back()->with('message_dgr','Time Reservation Failed. Try another date');
            }
        }

    }

    public function PostComments(Request $request){
        $name               = $request->input('name');
        $comment            =$request->input('comment');

        $save_comment = array(
            'name'    =>$name,
            'comment'  =>$comment
        );
        $sql=DB::table('comments')->insert($save_comment);
        if($sql){
            return redirect()->back()->with('message_comment','Thanks for your comment');
        }else{
            return redirect()->back()->with('message_comment_dgr','comment failed');
        }

    }

    public function CustomerRegister(Request $request){
        $name           = $request->input('name');
        $nic            =$request->input('nic');
        $mobile_number  = $request->input('mobile_number');
        $email          =$request->input('email');
        $tw_number      = $request->input('tw_number');
        $tw_ch_number          = $request->input('tw_ch_number');
        $tw_eng_number          = $request->input('tw_eng_number');
        $tw_type        =$request->input('tw_type');

        $username       = $request->input('username');
        $password       =$request->input('password');

        $count = DB::table('customer_register')->select('username')->where('username','=',$username)->count();


        $save_to_customer_reg = array([
            'name'   =>  $name,
            'nic'    =>  $nic,
            'mobile_number'  =>  $mobile_number,
            'email'     =>  $email,
            'tw_number' =>  $tw_number,
            'tw_ch_number'  =>  $tw_ch_number,
            'tw_eng_number' =>  $tw_eng_number,
            'tw_type'   =>  $tw_type,
            'username'  =>  $username
        ]);

        $save_to_user_table = array(
            'username'   =>  $username,
            'password'   =>  bcrypt($password),
            'role'       =>  'user'
        );

        $save_job_book =  array([
            'tw_number'      =>  $tw_number,
            'tw_ch_number'   =>  $tw_ch_number,
            'tw_eng_number'  =>  $tw_eng_number,
            'stork'          =>  $tw_type,
            'owner_name'     =>  $name,
            'owner_nic'      =>  $nic
        ]);

        $save_job_book_desc = array([
            'tw_number'      =>  $tw_number,
            'owner_nic'      =>  $nic,
            'job_desc'       =>  'Job Book Created'
        ]);

        if ($count==0){
            $sql1 = DB::table('customer_register')->insert($save_to_customer_reg);
            $sql2 = DB::table('users')->insert($save_to_user_table);
            DB::table('job_book')->insert($save_job_book);
            DB::table('job_book_desc')->insert($save_job_book_desc);
            if(($sql1 == true) and ($sql2 == true)){
                return redirect()->back()->with('account_created_msg','Account created Successfully, Now you can Login');
            }else{
                return redirect()->back()->with('account_created_msg_dgr','Failed');
            }
        }else{
            return redirect()->back()->with('account_created_msg_dgr','Username is already exists');
        }

    }
}
