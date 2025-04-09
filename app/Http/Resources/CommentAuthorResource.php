<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentAuthorResource extends JsonResource
{
	/**
	 * The "data" wrapper that should be applied.
	 *
	 * @var string
	 */
	public static $wrap = 'data';

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
			'avatar' => $this->avatar,
			'bio' => $this->bio,
		];
	}
}
