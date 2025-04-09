<?php

namespace App\Http\Resources;

use App\Models\Tag;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @return array<string, mixed>
	 */
	public function toArray(Request $request): array
	{
		$ids = Tag::select('article_id')
			->where('slug', $this->slug)
			->pluck('article_id');

		$articles = Article::whereIn("id", $ids)->distinct()
			->latest('id')
			->paginate(6);

		return [
			'id' => $this->id,
			'slug' => $this->slug,
			'articles' => new ArticleCollection(
				$articles
			)
		];
	}
}
