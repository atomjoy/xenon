<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{
	/** @use HasFactory<\Database\Factories\ArticleFactory> */
	use HasFactory;

	/**
	 * Display relations with model
	 *
	 * @var array
	 */
	protected $with = ['categories'];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var list<string>
	 */
	protected $fillable = [
		'published_at',
		'admin_id',
		'title',
		'slug',
		'image',
		'excerpt',
		'content_html',
		'content_cleaned',
		'views',
		'schema_seo',
		'meta_seo',
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
			'schema_seo' => 'json',
			'meta_seo' => 'json',
		];
	}

	public function getRouteKeyName()
	{
		return 'id'; // 'slug'
	}

	/**
	 * Get the user that owns the article.
	 */
	public function admin(): BelongsTo
	{
		return $this->belongsTo(Admin::class);
	}

	/**
	 * Get the article categories.
	 */
	public function categories(): BelongsToMany
	{
		return $this->belongsToMany(Category::class);
	}

	/**
	 * Get the user that owns the article.
	 */
	public function tags(): HasMany
	{
		return $this->hasMany(Tag::class);
	}

	/**
	 * Get the user that owns the article.
	 */
	public function comments(): HasMany
	{
		return $this->hasMany(Comment::class)->chaperone();
	}

	/**
	 * ArticleResource relations
	 *
	 * Limit relations does not work in ArticleResource
	 * 'comments' => $this->comments()->latest('id')->limit(3),
	 * Use this
	 * 'comments' => $this->comments_limited(),
	 */
	public function comments_limited()
	{
		// return $this->comments()->latest('id')->paginate(6);
		// return $this->comments()->latest('id')->limit(3)->get();
	}
}
