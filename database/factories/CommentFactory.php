<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'content' => fake()->paragraph(3),
			'link' => 'https://example.com/sample.txt',
			'image' => '/default/default.webp',
			'ip_address' => null,
			'is_approved' => true,
			'article_id' => null,
			'reply_id' => null,
		];
	}
}
