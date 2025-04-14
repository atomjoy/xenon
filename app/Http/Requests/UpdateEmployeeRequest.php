<?php

namespace App\Http\Requests;

use App\Validate\Html;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateEmployeeRequest extends FormRequest
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

		$employee = $this->route('employee');

		return [
			'name' => 'required|min:3|max:255',
			'position' => 'required|min:3|max:255',
			'slug' => 'required|min:3|max:255|unique:employees,slug,' . $employee->id,
			'experience' => 'sometimes|min:3|max:255',
			'email' => ['sometimes', $email, 'max:191'],
			'mobile' => 'sometimes|max:100',
			'excerpt' => 'sometimes|min:3|max:255',
			'content_html' => 'sometimes|min:3|max:65500',
			'content_cleaned' => 'sometimes|min:3|max:65500',
			'image' => 'sometimes|image|mimes:jpg,jpeg,png,gif,webp|max:4096',
			'facebook' => 'sometimes|max:255',
			'twitter' => 'sometimes|max:255',
			'youtube' => 'sometimes|max:255',
			'instagram' => 'sometimes|max:255',
			'linkedin' => 'sometimes|max:255',
			'pinterest' => 'sometimes|max:255',
			'dribbble' => 'sometimes|max:255',
			'behance' => 'sometimes|max:255',
			'meta_seo' => 'sometimes|json',
			'schema_seo' => 'sometimes|json',
			'published_at' => 'sometimes|date_format:Y-m-d H:i:s',
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
