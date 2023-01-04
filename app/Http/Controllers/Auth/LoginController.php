<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    //use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginForm($type)
    {
        return view('auth.login',['type' => $type ]);
    }
    public function login(Request $request)
    {
        if($request->type == 'student') {
            $guardType = 'student';
        }
        elseif($request->type == 'teacher') {
            $guardType = 'teacher';
        }
        elseif($request->type == 'myparent') {
            $guardType = 'myparent';
        }
        elseif($request->type == 'admin') {
            $guardType = 'admin';
        }
        // else{
        //     $guardType = 'web';
        // }

        if(Auth::guard($guardType)->attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            if($request->type == 'student'){
                return redirect()->to(RouteServiceProvider::STUDENT);
            }
            else if($request->type == 'teacher'){
                return redirect()->to(RouteServiceProvider::TEACHER);
            }
            else if($request->type == 'myparent'){
                return redirect()->to(RouteServiceProvider::MYPARENT);
            }
            else if($request->type == 'admin'){
                return redirect()->to(RouteServiceProvider::ADMIN);
            }
        }
        else {
            return redirect()->back()->with('message','Incorrect password or email');
        }
    }


    public function logout(Request $request,$type)
    {
        Auth::guard($type)->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
