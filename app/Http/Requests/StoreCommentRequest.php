<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCommentRequest extends FormRequest
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
			'link' => 'sometimes|min:3|max:255',
			'reply_id' => 'sometimes|nullable|exists:comments,id',
		];
	}

	function prepareForValidation()
	{
		$this->merge([
			'reply_id' => $this->reply_id == 'null' ? null : (int) $this->reply_id,
		]);
	}
}
