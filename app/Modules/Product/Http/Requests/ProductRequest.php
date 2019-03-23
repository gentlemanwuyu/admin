<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/3/21
 * Time: 17:09
 */

namespace App\Modules\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'code' => 'required|alpha_dash|max:32',
            'name' => 'required|max:32',
            'category_id' => 'required',
            'skus' => 'required',
        ];
        if (isset($data['product_attributes'])) {
            foreach ($data['product_attributes'] as $index => $value) {
                $key = 'product_attributes.'.$index.'.name';
                $rules[$key] = 'required|max:32';
                $this->custom_messages[$key.'.required'] = trans('product::product.attribute_name_required');
                $this->custom_messages[$key.'.max'] = trans('product::product.attribute_name_max');
            }
        }
        if (isset($data['skus'])) {
            foreach ($data['skus'] as $sku_index => $sku) {
                $key = 'skus.'.$sku_index.'.code';
                $rules[$key] = 'required|alpha_dash|max:32';
                $this->custom_messages[$key.'.required'] = trans('product::product.sku_code_required');
                $this->custom_messages[$key.'.alpha_dash'] = trans('product::product.sku_code_accepted');
                $this->custom_messages[$key.'.max'] = trans('product::product.sku_code_max');
                $key = 'skus.'.$sku_index.'.weight';
                $rules[$key] = 'numeric';
                $this->custom_messages[$key.'.numeric'] = trans('product::product.sku_weight_numeric');
                $key = 'skus.'.$sku_index.'.cost_price';
                $rules[$key] = 'required|numeric';
                $this->custom_messages[$key.'.required'] = trans('product::product.sku_cost_price_required');
                $this->custom_messages[$key.'.numeric'] = trans('product::product.sku_cost_price_numeric');
                if (isset($data['product_attributes'])) {
                    foreach ($data['product_attributes'] as $index => $value) {
                        $key = 'skus.'.$sku_index.'.attributes.'.$index;
                        $rules[$key] = 'max:32';
                        $this->custom_messages[$key.'.max'] = trans('product::product.sku_attribute_value_max');
                        if (isset($value['is_required'])) {
                            $rules[$key] = 'required|max:32';
                            $this->custom_messages[$key.'.required'] = sprintf(trans('product::product.sku_attribute_value_required'), $value['name']);
                        }
                    }
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
            'code.required' => trans('product::product.code_required'),
            'code.alpha_dash' => trans('product::product.code_accepted'),
            'code.max' => trans('product::product.code_max'),
            'name.required' => trans('product::product.name_required'),
            'name.max' => trans('product::product.name_max'),
            'category_id.required' => trans('product::product.please_select_category'),
            'skus.required' => trans('product::product.skus_required'),
        ]);
    }
}