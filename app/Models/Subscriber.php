<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
	/** @use HasFactory<\Database\Factories\SubscriberFactory> */
	use HasFactory;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var list<string>
	 */
	protected $fillable = [
		'email',
		'name',
		'is_approved',
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
			'updated_at' => 'datetime:Y-m-d H:i:s',
		];
	}
}
