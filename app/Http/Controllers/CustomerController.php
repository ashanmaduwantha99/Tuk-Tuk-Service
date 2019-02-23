<?php

namespace App\Http\Controllers;
use App\JobBookDesc;
use \DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use PDF;
use Redirect;
use \Auth;
use\Hash;
use App\User;
use App\CustomerRegister;
class CustomerController extends Controller
{
    public function CustomerHome(){
        $TodayDate  =  date('Y-m-d');
        $tomorrow = date("Y-m-d", strtotime('tomorrow'));

        $username=Auth::user()->username;

        $getNumberCount = DB::table('reservation')->where('date','=',$tomorrow)->count();
        if ($getNumberCount==0){
            $getnumberToString = 0;
        }else{
            $getnumber = DB::table('reservation')->select('number')->where('date','=',$tomorrow)->get();
            $getnumberToString = strval($getnumber[0]->number);
        }

        $userData = CustomerRegister::where('username','=',$username)->get();
        return view ('Users/usersHome',
            [ 'tomorrow'=>$tomorrow,
              'getnumberToString'=>$getnumberToString
            ])
            ->with(compact('userData',$userData));
    }
    public function reserveDate(Request $request){
//        $date = $request->input('date');
        //$url = "https://sandbox.payhere.lk/pay/checkout";
        //return Redirect::to($url);
    }
    public function CustomerJobBook(){
        $username=Auth::user()->username;
        $get_tw_number = DB::table('customer_register')->select('tw_number')->where('username','=',$username)->get();
        $get_tw_number_to_String = strval($get_tw_number[0]->tw_number);

        $get_details = JobBookDesc::where('tw_number','=',$get_tw_number_to_String)->get();
        return view('Users/userJobBook')
            ->with(compact('get_details',$get_details));
    }
    public function CustomerSettings(){
        $username=Auth::user()->username;
        $get_data = User::where('username','=',$username)->get();
        return view('Users/userSettings')
            ->with(compact('get_data',$get_data));
    }

    public function EditCustomerUsername(){
        $username=Auth::user()->username;

        $newusername = Input::get('username');

        CustomerRegister::where('username','=',$username)->update([
            'username'  =>  $newusername
        ]);

        User::where('username','=',$username)->update([
            'username'  =>  $newusername
        ]);

        return redirect()->back()->with('update_user','Updated');
    }

    public function updateCustomerpassword(Request $request){
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
