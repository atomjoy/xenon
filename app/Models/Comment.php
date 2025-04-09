<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Notifications\Notifiable;

class Comment extends Model
{
	/** @use HasFactory<\Database\Factories\CommentFactory> */
	use HasFactory;
	use Notifiable;

	/**
	 * Display relations with model
	 *
	 * @var array
	 */
	protected $with = [];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var list<string>
	 */
	protected $fillable = [
		'content',
		'article_id',
		'reply_id',
		'ip_address',
		'is_approved',
		'image',
		'link',
	];

	/**
	 * Get the attributes that should be cast.
	 *
	 * @return array<string, string>
	 */
	protected function casts(): array
	{
		return [
			'created_at' => 'datetime:Y-m-d H:i:s',
		];
	}

	/**
	 * Get the article.
	 */
	public function article(): BelongsTo
	{
		return $this->belongsTo(Article::class);
	}

	/**
	 * Get the parent commentable model (user or admin).
	 */
	public function commentable(): MorphTo
	{
		return $this->morphTo();
	}

	/**
	 * Get the comment replies.
	 */
	public function replies(): HasMany
	{
		return $this->hasMany(Comment::class, 'reply_id', 'id');
	}

	/**
	 * Get the parent comment.
	 */
	public function parent(): HasOne
	{
		return $this->hasOne(Comment::class, 'id', 'reply_id');
	}
}
