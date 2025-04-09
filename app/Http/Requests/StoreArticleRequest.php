<?php

namespace App\Http\Requests;

use App\Validate\Html;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class StoreArticleRequest extends FormRequest
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
		// $article = $this->route('article');

		return [
			'title' => 'required|min:3|max:255',
			'slug' => 'required|min:3|max:255|unique:articles',
			'excerpt' => 'required|min:3|max:255',
			'content_html' => 'required|min:3|max:65500',
			'content_cleaned' => 'required|min:3|max:65500',
			'category_id' => 'required|array|exists:categories,id',
			'image' => 'sometimes|image|mimes:jpg,jpeg,png,gif,webp|max:4096',
			'published_at' => 'required|date_format:Y-m-d H:i:s',
			'meta_seo' => 'sometimes|json',
			'schema_seo' => 'sometimes|json',
			// 'category_id' => 'required|numeric|exists:categories,id',
		];
	}

	function prepareForValidation()
	{
		$this->merge([
			'slug' => Str::slug($this->slug, '-'),
			'content_cleaned' => Html::htmlEntities($this->content_html),
		]);
	}

	// public function failedValidation(Validator $validator)
	// {
	//     throw new ValidationException($validator, response()->json([
	//         'message' => $validator->errors()->first()
	//     ], 422));
	// }
}
