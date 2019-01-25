<?php
namespace App\Modules\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrUpdateUserRequest extends FormRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$rules = [
			'email' => 'required|email',
			'name' => 'required|alpha_dash|max:32',
			'birthday' => 'date_format:Y-m-d',
			'gender_id' => 'required',
			'telephone' => 'required',
		];

		if ('update' == $this->get('action')) {
			unset($rules['email']);
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
		return [
			'email.required' => trans('auth::auth.email_required'),
			'email.email' => trans('auth::auth.email_format'),
			'name.required' => trans('auth::auth.name_required'),
			'name.alpha_dash' => trans('auth::auth.name_accepted'),
			'name.max' => trans('auth::auth.name_max'),
			'birthday.date_format' => trans('auth::auth.birthday_date_format'),
			'gender_id.required' => trans('auth::auth.gender_required'),
			'telephone.required' => trans('auth::auth.telephone_required'),
		];
	}
}
