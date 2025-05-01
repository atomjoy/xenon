<?php

namespace App\Http\Resources;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
		$admin = Admin::find($this->admin_id);
		$admin->current_article_id = $this->id;

		return [
			'id' => $this->id,
			'title' => $this->title,
			'slug' => $this->slug,
			'excerpt' => $this->excerpt,
			'content_html' => $this->content_html,
			'content_cleaned' => $this->content_cleaned,
			'image' => $this->image,
			'views' => $this->views,
			'meta_seo' => $this->meta_seo,
			'schema_seo' => $this->schema_seo,
			'created_at' => $this->created_at->format('Y-m-d H:i:s'),
			'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
			'published_at' => $this->published_at,
			'tags' => $this->tags,
			'admin_id' => $this->admin_id,
			'categories' => $this->categories,
			'comments_count' => $this->comments()->where('is_approved', 1)->count(),
			'comments' => new CommentCollection(
				$this->comments()
					->where('is_approved', 1)
					->whereNull('reply_id')
					->paginate(perPage: $request->integer('perpage', 6))
			),
			'author' => new ArticleAuthorResource($admin),
		];

		// return parent::toArray($request);
	}

	// Add custom data
	public function with($request)
	{
		return ['status' => 'success'];
	}
}
