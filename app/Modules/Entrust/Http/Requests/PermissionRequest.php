<?php

namespace App\Modules\Entrust\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'type_id' => 'required',
            'name' => 'required|alpha_dash|max:32',
            'display_name' => 'required|max:32',
            'description' => 'max:64',
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
            'type_id.required' => trans('entrust::permission.please_select_permission_type'),
            'name.required' => trans('entrust::permission.name_required'),
            'name.alpha_dash' => trans('entrust::permission.name_accepted'),
            'name.max' => trans('entrust::permission.name_max'),
            'display_name.required' => trans('entrust::permission.display_name_required'),
            'display_name.max' => trans('entrust::permission.display_name_max'),
            'description.max' => trans('entrust::permission.description_max'),
        ];
    }
}
