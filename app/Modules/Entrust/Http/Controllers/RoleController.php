<?php
namespace App\Modules\Entrust\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        
    }
    
    public function getList(Request $request)
    {
        return view('entrust::role.list');
    }
}
