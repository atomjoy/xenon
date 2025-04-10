<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuestionRequest extends FormRequest
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
			'message' => 'required|min:3|max:255',
			'answer' => 'sometimes|min:3|max:5000',
			'meta_seo' => 'sometimes|json',
			'schema_seo' => 'sometimes|json',
			'published_at' => 'sometimes|date_format:Y-m-d H:i:s',
		];
	}
}
