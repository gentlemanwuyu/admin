<?php
/**
 * Created by PhpStorm.
 * User: patpat
 * Date: 2019/10/17
 * Time: 16:58
 */

namespace App\Modules\Customer\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    /**
     * 自定义信息
     *
     * @var array
     */
    protected $custom_messages = [];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $data = $this->all();
        $rules = [
            'name' => 'required|max:32',
            'code' => 'alpha_dash|max:32',
            'company' => 'max:64',
            'phone' => 'max:32',
            'fax' => 'max:32',
            'country_code' => 'required',
            'street_address' => 'max:64',
            'address' => 'max:64',
        ];

        if (isset($data['contacts'])) {
            foreach ($data['contacts'] as $index => $value) {
                $key = 'contacts.'.$index.'.name';
                $rules[$key] = 'required|max:32';
                $this->custom_messages[$key.'.required'] = trans('customer::customer.contact_name_required');
                $this->custom_messages[$key.'.max'] = trans('customer::customer.contact_name_max', ['number' => 32]);
                $key = 'contacts.'.$index.'.position';
                $rules[$key] = 'max:32';
                $this->custom_messages[$key.'.max'] = trans('customer::customer.contact_position_max', ['number' => 32]);
                $key = 'contacts.'.$index.'.phone_number';
                $rules[$key] = 'max:32';
                $this->custom_messages[$key.'.max'] = trans('customer::customer.contact_phone_number_max', ['number' => 32]);
            }
        }

        if ('create' == $data['action'] && 'my_customer' == $data['source']) {
            $rules['payment_method_id'] = 'required';
            if (isset($data['payment_method_id'])) {
                if (2 == $data['payment_method_id']) {
                    $key = 'limit_amount';
                    $rules[$key] = 'required|integer';
                    $this->custom_messages[$key.'.required'] = trans('customer::customer.limit_amount_required');
                    $this->custom_messages[$key.'.integer'] = trans('customer::customer.limit_amount_integer');
                    $key = 'apply_reason';
                    $rules[$key] = 'required';
                    $this->custom_messages[$key.'.required'] = trans('customer::customer.apply_reason_required');
                }elseif (3 == $data['payment_method_id']) {
                    $key = 'monthly_day';
                    $rules[$key] = 'required|integer';
                    $this->custom_messages[$key.'.required'] = trans('customer::customer.monthly_day_required');
                    $this->custom_messages[$key.'.integer'] = trans('customer::customer.monthly_day_integer');
                    $key = 'apply_reason';
                    $rules[$key] = 'required';
                    $this->custom_messages[$key.'.required'] = trans('customer::customer.apply_reason_required');
                }
            }
        }

        return $rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return array_merge($this->custom_messages, [
            'name.required' => trans('customer::customer.name_required'),
            'name.max' => trans('customer::customer.name_max', ['number' => 32]),
            'code.alpha_dash' => trans('customer::customer.code_accepted'),
            'code.max' => trans('customer::customer.code_max', ['number' => 32]),
            'company.max' => trans('customer::customer.company_max', ['number' => 64]),
            'phone.max' => trans('customer::customer.phone_max', ['number' => 32]),
            'fax.max' => trans('customer::customer.fax_max', ['number' => 32]),
            'country_code.required' => trans('customer::customer.please_select_country'),
            'street_address.max' => trans('customer::customer.street_address_max', ['number' => 64]),
            'address.max' => trans('customer::customer.address_max', ['number' => 64]),
            'payment_method_id.required' => trans('customer::customer.please_select_payment_method'),
        ]);
    }
}