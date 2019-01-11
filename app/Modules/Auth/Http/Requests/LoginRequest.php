<?php
namespace App\Modules\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'email' => 'required|email',
			'password' => 'required',
			'captcha' => 'required|captcha',
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
			'email.required' => trans('auth::auth.email_required'),
			'email.email' => trans('auth::auth.email_format'),
			'password.required' => trans('auth::auth.password_required'),
			'captcha.required' => trans('auth::auth.captcha_required'),
			'captcha.captcha' => trans('auth::auth.captcha_invalid'),
		];
	}
}
