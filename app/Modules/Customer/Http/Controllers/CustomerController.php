<?php
namespace App\Modules\Customer\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {

    }

    public function myCustomer(Request $request)
    {
        return view('customer::customer.my_customer');
    }
}