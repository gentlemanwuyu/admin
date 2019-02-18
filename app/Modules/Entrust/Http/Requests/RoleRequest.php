<?php

namespace App\Modules\Entrust\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|alpha_dash|max:32',
            'display_name' => 'required|max:32',
            'description' => 'max:64',
            'permissions' => 'required',
        ];

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
        return [
            'name.required' => trans('entrust::role.name_required'),
            'name.alpha_dash' => trans('entrust::role.name_accepted'),
            'name.max' => trans('entrust::role.name_max'),
            'display_name.required' => trans('entrust::role.display_name_required'),
            'display_name.max' => trans('entrust::role.display_name_max'),
            'description.max' => trans('entrust::role.description_max'),
            'permissions.required' => trans('entrust::role.please_select_permission'),
        ];
    }
}
