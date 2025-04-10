<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReferenceRequest extends FormRequest
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
			'name' => 'required|min:3|max:255',
			'company' => 'required|min:3|max:255',
			'message' => 'required|min:3|max:2000',
			'vote' => ['required', 'numeric', 'min:1', 'max:5.00', 'decimal:0,1', 'regex:/^\d+(\.\d{1,2})?$/'],
			'website' => 'sometimes|min:3|max:255',
			'image' => 'sometimes|image|mimes:jpg,jpeg,png,gif,webp|max:4096',
			'project_id' => 'sometimes|nullable|numeric|exists:projects,id',
			'published_at' => 'required|date_format:Y-m-d H:i:s',
		];
	}
}
