<?php
namespace App\Modules\Customer\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Customer\Services\CustomerService;

class CustomerController extends Controller
{
    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function myCustomer(Request $request)
    {
        $customers = $this->customerService->myCustomerList($request);

        return view('customer::customer.my_customer', compact('customers'));
    }
}