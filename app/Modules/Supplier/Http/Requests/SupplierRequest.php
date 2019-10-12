<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/10/12
 * Time: 14:05
 */

namespace App\Modules\Supplier\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
                $this->custom_messages[$key.'.required'] = trans('supplier::supplier.contact_name_required');
                $this->custom_messages[$key.'.max'] = trans('supplier::supplier.contact_name_max', ['number' => 32]);
                $key = 'contacts.'.$index.'.position';
                $rules[$key] = 'max:32';
                $this->custom_messages[$key.'.max'] = trans('supplier::supplier.contact_position_max', ['number' => 32]);
                $key = 'contacts.'.$index.'.phone_number';
                $rules[$key] = 'max:32';
                $this->custom_messages[$key.'.max'] = trans('supplier::supplier.contact_phone_number_max', ['number' => 32]);
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
            'name.required' => trans('supplier::supplier.name_required'),
            'name.max' => trans('supplier::supplier.name_max', ['number' => 32]),
            'code.alpha_dash' => trans('supplier::supplier.code_accepted'),
            'code.max' => trans('supplier::supplier.code_max', ['number' => 32]),
            'company.max' => trans('supplier::supplier.company_max', ['number' => 64]),
            'phone.max' => trans('supplier::supplier.phone_max', ['number' => 32]),
            'fax.max' => trans('supplier::supplier.fax_max', ['number' => 32]),
            'country_code.required' => trans('supplier::supplier.please_select_country'),
            'street_address.max' => trans('supplier::supplier.street_address_max', ['number' => 64]),
            'address.max' => trans('supplier::supplier.address_max', ['number' => 64]),
        ]);
    }
}