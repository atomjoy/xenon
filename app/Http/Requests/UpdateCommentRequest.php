<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class UpdateCommentRequest extends FormRequest
{
	/**
	 * Show only first error message.
	 *
	 * @var boolean
	 */
	protected $stopOnFirstFailure = true;

	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array
	{
		return [
			'content' => 'required|min:3|max:500',
			'is_approved' => 'sometimes|numeric',
			'link' => 'sometimes|min:3|max:255',
		];
	}

	function prepareForValidation()
	{

		$val = 0;

		if ($this->is_approved == 1) {
			$val = 1;
		}

		$this->merge([
			'is_approved' => $val,
		]);
	}
}
