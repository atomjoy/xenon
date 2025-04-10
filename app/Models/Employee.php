<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
	/** @use HasFactory<\Database\Factories\EmployeeFactory> */
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
		'position',
		'slug',
		'email',
		'mobile',
		'experience',
		'image',
		'excerpt',
		'content_html',
		'content_cleaned',
		'facebook',
		'twitter',
		'instagram',
		'youtube',
		'linkedin',
		'pinterest',
		'dribbble',
		'behance',
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
}
