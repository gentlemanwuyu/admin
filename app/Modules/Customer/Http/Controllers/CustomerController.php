<?php
namespace App\Modules\Customer\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Customer\Services\CustomerService;
use App\Services\WorldService;
use App\Modules\Customer\Repositories\CustomerRepository;

class CustomerController extends Controller
{
    protected $customerService;
    protected $customerRepository;

    public function __construct(CustomerService $customerService, CustomerRepository $customerRepository)
    {
        $this->customerService = $customerService;
        $this->customerRepository = $customerRepository;
    }

    public function myCustomer(Request $request)
    {
        $customers = $this->customerService->myCustomerList($request);

        return view('customer::customer.list', compact('customers'));
    }

    public function createOrUpdateCustomerPage(Request $request)
    {
        $countries = WorldService::countries();
        $chinese_regions = WorldService::chineseTree();
        $data = compact('countries', 'chinese_regions');

        if ('update' == $request->get('action')) {
            $customer_info = $this->customerRepository->find($request->get('customer_id'));
            $data = array_merge($data, compact('customer_info'));
        }

        return view('customer::customer.create_or_update_customer', $data);
    }

    public function createOrUpdateCustomer(Request $request)
    {
        return response()->json($this->customerService->createOrUpdateCustomer($request));
    }
}