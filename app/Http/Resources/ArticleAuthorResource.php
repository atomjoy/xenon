<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleAuthorResource extends JsonResource
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
			'bio' => $this->bio,
			'avatar' => $this->avatar,
			'articles' => ArticleMiniResource::collection($this->articles()->limit(3)->whereNot('id', $this->current_article_id)->inRandomOrder()->get()),
			'articles_count' => $this->articles->count(),
			// 'roles' => $this->roles,
		];
	}
}
