<?php
namespace App\Modules\Auth\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Modules\Auth\Http\Requests\LoginRequest;

class AuthController extends Controller
{

    public function login()
    {
        return view('auth::auth.login');
    }

    public function signIn(LoginRequest $request)
    {
        //判断帐号是否激活
        $parameters = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'deleted_at' => null,
        ];
        $login = Auth::attempt($parameters,$request->get('remember'));
        if($login){
            return Redirect::intended('/');
        }else{
            return Redirect::back()->withErrors();
        }
    }

    public function signOut()
    {
        if (Auth::check()) {
            Auth::logout();
        }

        return Redirect::intended('/');
    }

}
