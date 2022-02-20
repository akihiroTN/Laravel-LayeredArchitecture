<?php

namespace App\Trait;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait ValidationErrorMessage
{
	/**
	 * Handle a failed validation attempt.
	 *
	 * @param  Validator  $validator
	 * @return void
	 *
	 * @throws HttpResponseException
	 */
	protected function failedValidation(Validator $validator)
	{
		$data = [
			'message' => __('The given data was invalid.'),
			'errors' => $validator->errors()->toArray(),
		];

		throw new HttpResponseException(response()->json($data, 422));
	}
}
