<?php
/**
 * Created by PhpStorm.
 * User: patpat
 * Date: 2019/10/17
 * Time: 17:06
 */

namespace App\Modules\Customer\Database\Seeds;

use Illuminate\Database\Seeder;
use App\Modules\Customer\Models\Customer;
use App\Modules\Customer\Models\CustomerContact;

class CustomerTableSeeder extends Seeder
{
    public function run()
    {
        $customer = Customer::create([
            'name' => '博诚',
            'code' => 'xhsjxs001',
            'company' => '无锡博诚',
            'introduction' => '',
            'phone_number' => '',
            'fax' => '',
            'country_code' => 'CN',
            'state_id' => '810',
            'city_id' => '823',
            'county_id' => '0',
            'street_address' => '博诚公司',
            'address' => '',
            'is_black' => '1',
            'manager_id' => '1',
        ]);
        CustomerContact::create(['customer_id' => $customer->id, 'name' => '丁晖', 'position' => '老板', 'phone_number' => '13626233563']);
        CustomerContact::create(['customer_id' => $customer->id, 'name' => '毕良山', 'position' => '合伙人', 'phone_number' => '13395165352']);
        CustomerContact::create(['customer_id' => $customer->id, 'name' => '宋俊培', 'position' => '合伙人', 'phone_number' => '15961531625']);

        $customer = Customer::create([
            'name' => '太仓万盛',
            'code' => 'xhsjxs002',
            'company' => '太仓万盛',
            'introduction' => '',
            'phone_number' => '',
            'fax' => '',
            'country_code' => 'CN',
            'state_id' => '810',
            'city_id' => '849',
            'county_id' => '857',
            'street_address' => '',
            'address' => '',
            'is_black' => '1',
            'manager_id' => '1',
        ]);
        CustomerContact::create(['customer_id' => $customer->id, 'name' => '小饶', 'position' => '老板', 'phone_number' => '15206226661']);
        CustomerContact::create(['customer_id' => $customer->id, 'name' => '老饶', 'position' => '老板', 'phone_number' => '13814573589']);
    }
}