<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StoreTagRequest extends FormRequest
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
            'article_id' => 'required|numeric|exists:articles,id',
            'slug' => [
                'required',
                'min:3',
                'max:50',
                Rule::unique('tags', 'slug')->where('article_id', $this->input('article_id')),
            ],
        ];
    }

    function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->slug, '-')
        ]);
    }
}
