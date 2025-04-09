<?php

namespace App\Http\Resources;

use App\Models\Admin;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
			'reply_id' => $this->reply_id,
			'article_id' => $this->article_id,
			'content' => $this->content,
			'link' => $this->link,
			'image' => $this->image,
			'ip_address' => $this->ip_address,
			'is_approved' => $this->is_approved,
			'is_article_author' => $this->commentable_type == Admin::class,
			'commentable_id' => $this->commentable_id,
			'commentable_type' => $this->commentable_type,
			'created_at' => $this->created_at->format('Y-m-d H:i:s'),
			'author' => new CommentAuthorResource($this->commentable),
			'replies' => new CommentCollection(
				$this->replies()->paginate(
					perPage: $request->integer('perpage_reply', 25),
					pageName: 'page_reply'
				)
			),
			'article' => $this->article->only(['slug', 'title']),
		];
	}
}
