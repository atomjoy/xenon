<?php

namespace App\Http\Requests;

use App\Validate\Html;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreWorkRequest extends FormRequest
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
			'title' => 'required|min:3|max:255',
			'slug' => 'required|min:3|max:255|unique:works',
			'experience' => 'required|min:3|max:255',
			'time' => 'required|min:2|max:255',
			'remote' => 'required|min:2|max:255',
			'salary' => 'required|min:2|max:255',
			'content_html' => 'required|min:3|max:65500',
			'content_cleaned' => 'required|min:3|max:65500',
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
