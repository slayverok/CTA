<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class MaestroLoginController extends Controller
{
	public function __construct(){

		$this->middleware('guest:maestro',['except'=>['logout']]);
	}

    public function showLoginForm(){
		return view('auth.maestro-login');

    }

    public function login(Request $request){

    		//Validate the form data
    	$this->validate($request,[
    		'email' => 'required|email',
    		'password' => 'required|min:6'
    		]);

    	//Attempt to log the user in
    	if (Auth::guard('maestro')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember )){
    		//if successful, the redirect to their intend location 
    		return redirect()->intended(route('maestro.dashboard'));

    	}
    	//if unsuccessful, then redirect back to the login with the form data
    	return redirect()->back()->withInput($request->only('email','remember'));
    }

    public function logout(){
        Auth::guard('maestro')->logout();
        return redirect('/');

    }


}
