<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscriber>
 */
class SubscriberFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'email' => fake()->unique()->safeEmail(),
			'name' => fake()->name(),
			'is_approved' => 1,
		];
	}

	public function approved(): Factory
	{
		return $this->state(function (array $attributes) {
			return [
				'is_approved' => 1,
			];
		});
	}
}
