<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CatResource extends JsonResource
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
			'articles' => new ArticleCollection($this->articles()->latest('id')->paginate(2)),
		];

		// return parent::toArray($request);
	}
}
