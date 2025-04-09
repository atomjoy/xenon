<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Support\Str;

/**
 * Uuid class
 *
 * // Table key
 * $table->uuid('id')->primary();
 *
 * // Column
 * $table->uuid('user_id');
 *
 * // Relation with column
 * $table->uuidMorphs('tokenable');
 * $table->foreignUuid('user_id')->constrained();
 */
class Uuid extends Model
{
	use HasUuids;

	// protected $incrementing = false;
	// protected $keyType = 'string';
	// protected $primaryKey = 'id';

	public static function generateUuid(): string
	{
		return (string) Str::uuid();
	}
}
