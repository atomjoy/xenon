<?php

namespace App\Http\Requests;

use App\Validate\Html;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateProjectRequest extends FormRequest
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
		$project = $this->route('project');

		return [
			'title' => 'required|min:3|max:255',
			'slug' => 'required|min:3|max:255|unique:projects,slug,' . $project->id,
			'excerpt' => 'required|min:3|max:255',
			'content_html' => 'required|min:3|max:65500',
			'content_cleaned' => 'required|min:3|max:65500',
			'image' => 'sometimes|image|mimes:jpg,jpeg,png,gif,webp|max:4096',
			'tags' => 'sometimes|min:2|max:255',
			'category' => 'sometimes|min:2|max:255',
			'duration' => 'sometimes|min:2|max:255',
			'client' => 'sometimes|min:2|max:255',
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
			// 'schema_seo' => str_replace(["\r\n", " "], '', $this->schema_seo),
			// 'meta_seo' => str_replace(["\r\n", " "], '', $this->meta_seo),
		]);
	}
}
