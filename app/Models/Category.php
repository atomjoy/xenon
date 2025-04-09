<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Category extends Model
{
	/** @use HasFactory<\Database\Factories\CategoryFactory> */
	use HasFactory;

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
		'name',
		'slug',
		'about',
		'image',
		'category_id'
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
	 * Get the category articles.
	 */
	public function articles(): BelongsToMany
	{
		return $this->belongsToMany(Article::class);
	}

	/**
	 * Get the parent category.
	 */
	public function parent(): HasOne
	{
		return $this->hasOne(Category::class, 'id', 'category_id');
	}

	/**
	 * Get the sub categories for the category.
	 */
	public function subcats(): HasMany
	{
		return $this->hasMany(Category::class);
	}
}
