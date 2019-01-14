<?php
namespace App\Modules\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModifyPasswordRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'new_password' => 'required|alpha_dash|max:32',
			'confirm_password' => 'required|alpha_dash|max:32|same:new_password',
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
			'new_password.required' => trans('auth::auth.password_required'),
			'new_password.alpha_dash' => trans('auth::auth.password_alpha_dash'),
			'new_password.max' => trans('auth::auth.password_max_length'),
			'confirm_password.required' => trans('auth::auth.password_required'),
			'confirm_password.alpha_dash' => trans('auth::auth.password_alpha_dash'),
			'confirm_password.max' => trans('auth::auth.password_max_length'),
			'confirm_password.same' => trans('auth::auth.twice_password_different'),
		];
	}
}
