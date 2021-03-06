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
use App\Modules\Customer\Models\CustomerPaymentMethod;
use App\Modules\Customer\Models\CustomerPaymentMethodApplication;

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
        CustomerPaymentMethod::create(['customer_id' => $customer->id, 'method_id' => 3, 'monthly_day' => 30]);

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
        CustomerPaymentMethod::create(['customer_id' => $customer->id, 'method_id' => 2, 'limit_amount' => 20000]);

        $customer = Customer::create([
            'name' => '深圳景旺',
            'code' => 'xhszd001',
            'company' => '深圳市景旺电子股份有限公司',
            'introduction' => '',
            'phone_number' => '0755-27697333',
            'fax' => '',
            'country_code' => 'CN',
            'state_id' => '1935',
            'city_id' => '1959',
            'county_id' => '1963',
            'street_address' => '西乡街道铁岗水库路166号(桃花源科技创业中心侧)',
            'address' => '',
            'is_black' => '1',
            'manager_id' => '1',
        ]);
        CustomerContact::create(['customer_id' => $customer->id, 'name' => '王先生', 'position' => '采购总监', 'phone_number' => '13800138000']);
        CustomerPaymentMethod::create(['customer_id' => $customer->id, 'method_id' => 3, 'monthly_day' => 90]);

        $customer = Customer::create([
            'name' => '深圳崇达',
            'code' => 'xhszd002',
            'company' => '崇达技术股份有限公司',
            'introduction' => '',
            'phone_number' => '0755-26068047',
            'fax' => '0755-26068047',
            'country_code' => 'CN',
            'state_id' => '1935',
            'city_id' => '1959',
            'county_id' => '1963',
            'street_address' => '新桥街道新玉路横岗下大街1号',
            'address' => '',
            'is_black' => '1',
            'manager_id' => '2',
        ]);
        CustomerContact::create(['customer_id' => $customer->id, 'name' => '邓先生', 'position' => '采购副总监', 'phone_number' => '13800138000']);
        CustomerPaymentMethodApplication::create(['customer_id' => $customer->id, 'method_id' => 3, 'monthly_day' => 120, 'message' => '线路板厂']);
    }
}