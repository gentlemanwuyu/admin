<?php
namespace App\Modules\Auth\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
	//

    public function login()
    {
        return view('auth::auth.login');
    }

    public function signIn(Request $request)
    {

    }

}
