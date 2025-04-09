<?php

namespace App\Http\Resources;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleMiniResource extends JsonResource
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
			'slug' => $this->slug,
			'excerpt' => $this->excerpt,
			'content_html' => $this->content_html,
			'content_cleaned' => $this->content_cleaned,
			'image' => $this->image,
			'views' => $this->views,
			'author' => new ArticleAuthorMiniResource(Admin::find($this->admin_id)),
			'published_at' => $this->published_at,
			// 'author' => Admin::select('name', 'avatar', 'id')->find($this->admin_id),
		];

		// return parent::toArray($request);
	}
}
