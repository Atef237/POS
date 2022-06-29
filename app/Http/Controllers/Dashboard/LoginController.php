<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{


    public function login(Request $request){

        // return  $request;
        if(auth()->guard('web')->attempt([ 'email' => $request->email , 'password'=>$request->password ])){
           return redirect()->route('home');
        }else{
            return "error";
        }

    }

}
