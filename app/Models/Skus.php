<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Skus extends Model
{
	/** @use HasFactory<\Database\Factories\SkuFactory> */
	// use HasFactory;

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
	protected $guarded = [];

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

	public function product(): BelongsTo
	{
		return $this->belongsTo(Product::class, 'product_id');
	}

	public function attributes(): BelongsToMany
	{
		return $this->belongsToMany(Attribute::class, 'attribute_sku')->withPivot(['value']);
	}

	public function images(): MorphMany
	{
		return $this->morphMany(Image::class, 'imageable')->chaperone();
	}

	public function latestImage(): MorphOne
	{
		return $this->morphOne(Image::class, 'imageable')->latestOfMany();
	}

	public function oldestImage(): MorphOne
	{
		return $this->morphOne(Image::class, 'imageable')->oldestOfMany();
	}

	public function bestImage(): MorphOne
	{
		return $this->morphOne(Image::class, 'imageable')->ofMany('likes', 'max');
	}
}
