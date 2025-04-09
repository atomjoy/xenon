<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		return [
			'admin_id' => null,
			'title' => fake()->sentence(3),
			'slug' => fake()->unique()->slug(4),
			'image' => '/default/article/default.webp',
			'excerpt' => fake()->sentence(4),
			'content_html' => fake()->sentence(6),
			'content_cleaned' => fake()->sentence(6),
			'schema_seo' => null,
			'meta_seo' => null,
			'views' => rand(1, 999),
			'published_at' => now(),
		];
	}

	public function contentJson()
	{
		return [
			'content' => [
				'pages' => [
					[
						'id' => uniqid(),
						'type' => 'page',
						'content' => [
							[
								'id' => uniqid(),
								'type' => 'h1',
								'content' => [
									'text' => 'Page title',
								]
							],
							[
								'id' => uniqid(),
								'type' => 'paragraph',
								'content' => [
									'text' => fake()->sentence(3),
								]
							],
							[
								'id' => uniqid(),
								'type' => 'h2',
								'content' => [
									'text' => 'Page sub title',
								]
							],
							[
								'id' => uniqid(),
								'type' => 'list',
								'content' => [
									'text' => fake()->sentence(3),
									'list' => [
										'Text 1',
										'Text 2',
										'Text 3',
									]
								]
							],
							[
								'id' => uniqid(),
								'type' => 'container',
								'content' => [
									[
										'id' => uniqid(),
										'type' => 'span',
										'content' => [
											'text' => fake()->sentence(3),
										]
									],
									[
										'id' => uniqid(),
										'type' => 'link',
										'content' => [
											'text' => 'Promocje',
											'url' => 'https://url.to',
										]
									],
									[
										'id' => uniqid(),
										'type' => 'span',
										'content' => [
											'text' => fake()->sentence(3),
										]
									],
									[
										'id' => uniqid(),
										'type' => 'strong',
										'content' => [
											'text' => ' Paris ',
										]
									],
									[
										'id' => uniqid(),
										'type' => 'code',
										'content' => [
											'text' => '.active { color: red; }',
										]
									]
								]
							],
						]
					],
					[
						'id' => uniqid(),
						'type' => 'page',
						'content' => [
							[
								'id' => uniqid(),
								'type' => 'h1',
								'content' => [
									'text' => 'Page title 2',
								]
							],
							[
								'id' => uniqid(),
								'type' => 'p',
								'content' => [
									'text' => fake()->sentence(3),
								]
							],
							[
								'id' => uniqid(),
								'type' => 'gallery',
								'content' => [
									'text' => 'Cars gallery',
								]
							]
						]
					]
				]
			]
		];
	}
}
