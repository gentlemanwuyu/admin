<?php
namespace App\Modules\Organization\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{


    public function chart(Request $request)
    {
        return view('organization::department.chart');
    }
}
