<?php
namespace App\Modules\Customer\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Customer\Services\CustomerService;
use App\Services\WorldService;
use App\Modules\Customer\Repositories\CustomerRepository;
use App\Modules\Auth\Services\AuthService;
use App\Modules\Customer\Http\Requests\CustomerRequest;
use App\Modules\Customer\Http\Requests\AssignCustomerRequest;

class CustomerController extends Controller
{
    protected $customerService;
    protected $customerRepository;
    protected $authService;

    public function __construct(CustomerService $customerService, CustomerRepository $customerRepository, AuthService $authService)
    {
        $this->customerService = $customerService;
        $this->customerRepository = $customerRepository;
        $this->authService = $authService;
    }

    public function myCustomer(Request $request)
    {
        $page_name = 'my_customer';
        $customers = $this->customerService->myCustomerList($request);

        return view('customer::customer.list', compact('page_name', 'customers'));
    }

    public function blackList(Request $request)
    {
        $page_name = 'black_list';
        $customers = $this->customerService->blackList($request);

        return view('customer::customer.list', compact('page_name', 'customers'));
    }

    public function customerPool(Request $request)
    {
        $page_name = 'customer_pool';
        $customers = $this->customerService->customerPool($request);

        return view('customer::customer.list', compact('page_name', 'customers'));
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

    public function createOrUpdateCustomer(CustomerRequest $request)
    {
        return response()->json($this->customerService->createOrUpdateCustomer($request));
    }

    public function deleteCustomer(Request $request)
    {
        return response()->json($this->customerService->deleteSupplier($request->get('customer_id')));
    }

    public function blackCustomer(Request $request)
    {
        return response()->json($this->customerService->blackCustomer($request->get('customer_id'), $request->get('reason')));
    }

    public function releaseCustomer(Request $request)
    {
        return response()->json($this->customerService->releaseCustomer($request->get('customer_id')));
    }

    public function assignCustomerPage(Request $request)
    {
        $users = $this->authService->getUsersWithoutAdmin();

        return view('customer::customer.assign_customer', compact('users'));
    }

    public function assignCustomer(AssignCustomerRequest $request)
    {
        return response()->json($this->customerService->assignCustomer($request->get('customer_id'), $request->get('manager_id')));
    }

    public function abandonCustomer(Request $request)
    {
        return response()->json($this->customerService->abandonCustomer($request->get('customer_id')));
    }
}