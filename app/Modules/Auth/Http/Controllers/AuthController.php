<?php
namespace App\Modules\Auth\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Modules\Auth\Http\Requests\LoginRequest;
use App\Modules\Auth\Http\Requests\ModifyPasswordRequest;
use App\Modules\Auth\Http\Requests\CreateOrUpdateUserRequest;
use App\Modules\Auth\Services\AuthService;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

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
            return Redirect::back()->withErrors(trans('auth::auth.login_failure'));
        }
    }

    public function signOut()
    {
        if (Auth::check()) {
            Auth::logout();
        }

        return Redirect::intended('/');
    }

    public function modifyPasswordPage()
    {
        return view('auth::auth.modify_password');
    }

    public function modifyPassword(ModifyPasswordRequest $request)
    {
        try {
            $result = $this->authService->modifyPassword($request->get('new_password'), Auth::user()->id);
            if (!$result) {
                throw new \Exception(trans('application.database_exception'));
            }

            return ['status' => 'success'];
        }catch (\Exception $e) {
            return ['status' => 'fail', 'msg' => $e->getMessage()];
        }
    }

    public function userList(Request $request)
    {
        $users = $this->authService->getUserList($request);

        return view('auth::auth.user_list', compact('users'));
    }

    public function createOrUpdateUserPage(Request $request)
    {
        $roles = $this->authService->getRoles();
        $departments = $this->authService->getDepartments();
        $data = compact('roles', 'departments');
        if ('update' == $request->get('action')) {
            $user_info = $this->authService->getUser($request->get('user_id'));
            $data = array_merge($data, compact('user_info'));
        }

        return view('auth::auth.create_or_update_user', $data);
    }

    public function createOrUpdateUser(CreateOrUpdateUserRequest $request)
    {
        return response()->json($this->authService->createOrUpdateUser($request));
    }

    public function deleteUser(Request $request)
    {
        return response()->json($this->authService->deleteUser($request));
    }

}
