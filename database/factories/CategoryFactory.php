<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		$name = 'Category ' . uniqid();

		return [
			'name' => $name,
			'slug' => Str::slug($name, '-'),
			'about' => ucfirst($name) . ' description',
			'image' => '/default/category/image.webp',
			'category_id' => null,
			'visible' => 1,
		];
	}
}
