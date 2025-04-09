<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
	/** @use HasFactory<\Database\Factories\ProjectFactory> */
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
		'title',
		'excerpt',
		'image',
		'slug',
		'content_html',
		'content_cleaned',
		'tags',
		'category',
		'duration',
		'client',
		'code',
		'views',
		'meta_seo',
		'schema_seo',
		'published_at',
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

	/**
	 * Get the references for the project.
	 */
	public function references(): HasMany
	{
		return $this->hasMany(Reference::class)->chaperone();
	}
}
