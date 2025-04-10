<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
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
		$category = $this->route('category');

		return [
			'name' => 'required|min:2|max:255|unique:categories,name,' . $category->id,
			'slug' => 'required|min:2|max:255|unique:categories,slug,' . $category->id,
			'about' => 'sometimes|min:3',
			'category_id' => 'sometimes|nullable|exists:categories,id',
			'visible' => 'sometimes|boolean',
			'image' => [
				'sometimes',
				'mimes:webp,jpeg,jpg,png,gif',
				Rule::dimensions()
					->minWidth(config('default.avatar_min_pixels', 192))
					->minHeight(config('default.avatar_min_pixels', 108)),
				Rule::dimensions()
					->maxWidth(config('default.avatar_max_pixels', 5000))
					->maxHeight(config('default.avatar_max_pixels', 5000)),
				Rule::file()->types(['webp', 'jpeg', 'jpg', 'png', 'gif'])
					->max(config('default.max_upload_size_mb', 5) * 1024),
			]
		];
	}

	function prepareForValidation()
	{
		$category = $this->route('category');
		$category_id = $this->category_id;

		if ($category_id == 'null' || $category_id == $category->id) {
			$category_id = null;
		}

		$this->merge([
			'slug' => Str::slug($this->slug, '-'),
			'category_id' => $category_id,
			'visible' => $this->visible == 1 ? 1 : 0,
		]);
	}
}
