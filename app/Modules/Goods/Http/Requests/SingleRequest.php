<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/6/25
 * Time: 18:05
 */

namespace App\Modules\Goods\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SingleRequest extends FormRequest
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
        $rules = [
            'code' => 'required|alpha_dash|max:32',
            'name' => 'required|max:32',
            'category_id' => 'required',
            'skus' => 'required',
        ];

        $data = $this->all();
        if (isset($data['skus'])) {
            foreach ($data['skus'] as $index => $value) {
                // sku编码
                $key = 'skus.'.$index.'.code';
                $rules[$key] = 'required|alpha_dash|max:32';
                $this->custom_messages[$key.'.required'] = trans('goods::goods.sku_code_required');
                $this->custom_messages[$key.'.alpha_dash'] = trans('goods::goods.sku_code_accepted');
                $this->custom_messages[$key.'.max'] = trans('goods::goods.sku_code_max');
                // sku最低售价
                $key = 'skus.'.$index.'.lowest_price';
                $rules[$key] = 'required|numeric';
                $this->custom_messages[$key.'.required'] = trans('goods::goods.sku_lowest_price_required');
                $this->custom_messages[$key.'.numeric'] = trans('goods::goods.sku_lowest_price_numeric');
                // sku的建议零售价
                $key = 'skus.'.$index.'.msrp';
                $rules[$key] = 'numeric';
                $this->custom_messages[$key.'.numeric'] = trans('goods::goods.sku_msrp_numeric');
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
            'code.required' => trans('goods::goods.code_required'),
            'code.alpha_dash' => trans('goods::goods.code_accepted'),
            'code.max' => trans('goods::goods.code_max'),
            'name.required' => trans('goods::goods.name_required'),
            'name.max' => trans('goods::goods.name_max'),
            'category_id.required' => trans('goods::goods.please_select_category'),
            'skus.required' => trans('goods::goods.skus_required'),
        ]);
    }
}