<?php

namespace App\Http\Controllers;

use\DB;
use\Mail;
class MailController extends Controller
{
//    public function Send(){
//        Mail::send('mail',['text'=>'mail'],['name'=>'Ashan'],function($message){
//            $message->to('intouch.wd.am@gmail.com','To intouch web')->subject('Test Email');
//            $message->from('intouch.wd.am@gmail.com','intouch web');
//        });
//    }

    public function Send($view,array $data = []){
        Mail::send('mail',['name','Ripon Uddin Arman'],function($message){
            $message->to('intouch.wd.am@gmail.com')->subject("Email Testing with Laravel");
            $message->from('intouch.wd.am@gmail.com','intouch web');
        });
    }
}
