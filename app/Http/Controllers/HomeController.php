<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
class HomeController extends Controller {
    public function emailnotificationwithpdf() {
        $users = User::all();
        $toemail ="jahirair@gmail.com";

        $data = [

            'title'=> 'Monthly Sale',

            'date'=>date( 'm/d/y' ),

            'users'=>$users,

            'email'=>$toemail

        ];

        $pdf = PDF::loadView( 'alluser', $data );
        // return $pdf->stream( 'alluser.pdf' );//seen by browser        

        Mail::send('alluser',$data,function($setting) use ($data,$pdf){
        $setting->to($data['email'])
        ->subject('Total User Report')
        ->attachData($pdf->output(),'alluser.pdf');
        });

        dd('Sent');
    }
}