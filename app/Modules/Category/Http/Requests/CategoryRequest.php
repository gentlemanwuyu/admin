<?php
/**
 * Created by PhpStorm.
 * User: WuYu
 * Date: 2019/3/7
 * Time: 18:06
 */

namespace App\Modules\Category\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:32',
            'display_name' => 'required|max:32',
        ];
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
        return [
            'name.required' => trans('category::category.name_required'),
            'name.max' => trans('category::category.name_max'),
            'display_name.required' => trans('category::category.display_name_required'),
            'display_name.max' => trans('category::category.display_name_max'),
        ];
    }
}