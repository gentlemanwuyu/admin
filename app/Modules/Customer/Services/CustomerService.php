<?php
/**
 * Created by PhpStorm.
 * User: patpat
 * Date: 2019/10/16
 * Time: 20:14
 */

namespace App\Modules\Customer\Services;

use App\Modules\Customer\Repositories\CustomerRepository;

class CustomerService
{
    protected $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function myCustomerList($request)
    {
        return  $this->customerRepository->paginate();
    }
}