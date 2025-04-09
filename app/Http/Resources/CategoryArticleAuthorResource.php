<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryArticleAuthorResource extends JsonResource
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
			'articles_count' => $this->articles->count(),
		];

		// return parent::toArray($request);
	}
}
