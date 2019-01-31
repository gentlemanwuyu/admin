<?php
namespace App\Modules\Organization\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        return view('organization::position.index');
	}
}
