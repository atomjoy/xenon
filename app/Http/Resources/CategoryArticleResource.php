<?php

namespace App\Http\Resources;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryArticleResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		return [
			'id' => $this->id,
			'title' => $this->title,
			'excerpt' => $this->excerpt,
			'slug' => $this->slug,
			'image' => $this->image,
			'views' => $this->views,
			'published_at' => $this->published_at,
			'created_at' => $this->created_at->format('Y-m-d H:i:s'),
			'author' => new CategoryArticleAuthorResource($this->admin),
			'writer' => $this->admin->only(['id', 'name', 'bio', 'avatar']),
			'categories' => $this->categories,
			'tags' => $this->tags,
		];

		// return parent::toArray($request);
	}
}
