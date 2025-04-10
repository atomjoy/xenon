<?php

namespace App\Http\Requests;

use App\Validate\Html;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreEmployeeRequest extends FormRequest
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
		$email = 'email:rfc,dns';
		if (env('APP_DEBUG') == true) {
			$email = 'email';
		}

		return [
			'name' => 'required|min:3|max:255',
			'position' => 'required|min:3|max:255',
			'slug' => 'required|min:3|max:255|unique:employees',
			'experience' => 'required|min:3|max:255',
			'email' => ['required', $email, 'max:191'],
			'mobile' => 'required|max:100',
			'excerpt' => 'required|min:3|max:255',
			'content_html' => 'required|min:3|max:65500',
			'content_cleaned' => 'required|min:3|max:65500',
			'image' => 'sometimes|image|mimes:jpg,jpeg,png,gif,webp|max:4096',
			'facebook' => 'sometimes|min:2|max:255',
			'twitter' => 'sometimes|min:2|max:255',
			'youtube' => 'sometimes|min:2|max:255',
			'instagram' => 'sometimes|min:2|max:255',
			'linkedin' => 'sometimes|min:2|max:255',
			'pinterest' => 'sometimes|min:2|max:255',
			'dribbble' => 'sometimes|min:2|max:255',
			'behance' => 'sometimes|min:2|max:255',
			'published_at' => 'required|date_format:Y-m-d H:i:s',
		];
	}

	function prepareForValidation()
	{
		$this->merge([
			'slug' => Str::slug($this->slug, '-'),
			'content_cleaned' => Html::htmlEntities($this->content_html),
		]);
	}
}
