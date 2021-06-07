<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller {

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/portal/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login() {
        return view('backend.login');
    }

    protected function credentials(Request $request) {
        $field = filter_var($request->input($this->username()), FILTER_VALIDATE_EMAIL) ? 'users_email' : 'users_mobile';
        $request->merge([$field => $request->input($this->username())]);
        return array_merge($request->only($field, 'password'), ['users_status' => 'Active']);
    }

    public function username() {
        return 'username';
    }

    public function authenticate(Request $request) {
        $credentials = $this->credentials($request);
        
        if (Auth::attempt($credentials)) {
            if (Auth::user()->users_type === 'Super Admin') {
                    return redirect()->intended('portal/dashboard');
            } elseif (Auth::user()->users_type === 'Admin') {
                    
                    return redirect()->intended('portal/dashboard/admin');
            } elseif (Auth::user()->users_type === 'User') {
    
                   return redirect()->intended('portal/dashboard/user');
                   
            } elseif (Auth::user()->users_type === 'Company') {
                    return redirect()->intended('portal/dashboard/company');
            } else {
                Auth::logout();
                 return redirect()->intended('portal/login')
                        ->withInput($request->except('password'))
                        ->with('error', 'Invalid login credentials. Check you username or mobile number and password Or your account is not active yet!');
            }
        } else {
        return redirect()->intended('portal/login')
                        ->withInput($request->except('password'))
                        ->with('error', 'Invalid login credentials. Check you username or mobile number and password Or your account is not active yet!');
        }
    }

}
