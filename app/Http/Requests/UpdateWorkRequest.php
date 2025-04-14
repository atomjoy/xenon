<?php

namespace App\Http\Requests;

use App\Validate\Html;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateWorkRequest extends FormRequest
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
		$work = $this->route('work');

		return [
			'title' => 'required|min:3|max:255',
			'slug' => 'required|min:3|max:255|unique:works,slug,' . $work->id,
			'experience' => 'required|min:3|max:255',
			'time' => 'required|min:2|max:255',
			'remote' => 'required|min:2|max:255',
			'salary' => 'required|min:2|max:255',
			'content_html' => 'required|min:3|max:65500',
			'content_cleaned' => 'required|min:3|max:65500',
			'meta_seo' => 'sometimes|json',
			'schema_seo' => 'sometimes|json',
			'published_at' => 'required|date_format:Y-m-d H:i:s',
			'expired_at' => 'sometimes|date_format:Y-m-d H:i:s',
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
