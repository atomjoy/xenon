<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
			'name' => $this->name,
			'slug' => $this->slug,
			'about' => $this->about,
			'image' => $this->image,
			'visible' => $this->visible,
			'patent' => $this->parent,
			'subcats' => $this->subcats,
			'articles' => new ArticleCollection(
				$this->articles()
					->latest('id')
					->whereDate('published_at', '<', now())
					->paginate(6)
			)
		];
	}
}
