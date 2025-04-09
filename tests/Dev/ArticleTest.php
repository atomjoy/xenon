<?php

namespace Tests\Dev;

use App\Models\Admin;
use App\Models\Article;
use App\Models\User;
use Database\Seeders\ArticleSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\CommentSeeder;
use Database\Seeders\TagSeeder;
use Database\Seeders\TestSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ArticleTest extends TestCase
{
	use RefreshDatabase;

	public function setUp(): void
	{
		parent::setUp();
		// $this->faker = Faker::create();
	}

	public function test_articles(): void
	{
		$this->seed(TestSeeder::class);

		$user = Admin::role('writer')->first();
		$this->actingAs($user, 'admin');
		Storage::fake('public');
		config(['filesystems.default' => 'public']);

		// Create
		$response = $this->postJson('/web/api/admin/articles', [
			'title' => 'Wiosna w ogrodzie pszczółki',
			'slug' => 'wiosna-w-ogrodzie-pszczolki',
			'excerpt' => 'Short article content',
			'image' => UploadedFile::fake()->image('article.jpg'),
			'meta' => null,
			'content_html' => '<h1>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</h1> <p>Ratione molestias distinctio dolore fugiat non nostrum quae obcaecati adipisci id totam quos animi ipsum, consequuntur nobis reprehenderit nam harum, quidem sunt.</p>',
			'category_id' => [1],
			'published_at' => '2025-01-01 22:22:22',
		]);

		$response->assertStatus(200)->assertJson([
			'message' => 'Created',
			'data' => [
				'id' => 21,
				'image' => 'articles/article-21.webp'
			],
		]);

		// Check on disk
		Storage::disk('public')->assertExists('articles/article-21.webp');

		// Create
		$response = $this->postJson('/web/api/admin/articles', []);

		$response->assertStatus(422)->assertJson([
			"message" => "The title field is required."
		]);

		// Update
		$response = $this->patchJson('/web/api/admin/articles/1', [
			'title' => 'New article title',
			'slug' => 'new-article-title',
			'image' => UploadedFile::fake()->image('article.jpg'),
			'content_html' => '<h1>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</h1> <p>Ratione molestias distinctio dolore fugiat non nostrum quae obcaecati adipisci id totam quos animi ipsum, consequuntur nobis reprehenderit nam harum, quidem sunt.</p>',
			'category_id' => [1],
			'published_at' => '2025-01-01 22:22:22',
			'meta' => null,
			'tags' => ['blog'],
		]);

		$response->assertStatus(200)->assertJson([
			"message" => "Updated",
			'data' => [
				'title' => 'New article title',
				'id' => 1,
				'image' => 'articles/article-1.webp'
			]
		]);

		// Check on disk
		Storage::disk('public')->assertExists('articles/article-1.webp');

		// Show
		$response = $this->getJson('/web/api/admin/articles');

		$response->assertStatus(200)->assertJson([
			// 'current_page' => 1,
			'data' => [
				['title' => 'Wiosna w ogrodzie pszczółki']
			],
		]);

		// Show
		$response = $this->getJson('/web/api/admin/articles?page=2');

		$response->assertStatus(200)->assertJson([
			// 'current_page' => 2,
			'data' => [
				['title' => 'Article title 16']
			],
		]);

		// Show
		$response = $this->getJson('/web/api/admin/articles?page=2&perpage=3');

		$response->assertStatus(200)->assertJson([
			// 'current_page' => 2,
			'data' => [
				['title' => 'Article title 18']
			],
		]);

		// Show (Poprawić po implementacji commentables !!!)
		$response = $this->getJson('/web/api/admin/articles/1');

		$response->assertStatus(200)->assertJson([
			'data' => [
				'id' => 1,
				'admin_id' => 1,
				'title' => 'New article title',
				'comments' => [
					'data' => [
						[
							"id" => 4,
							"article_id" => 1,
							"content" => "Comment article 1",
							"is_article_author" => true,
							"author" => [],
							'replies' => [
								'data' => [
									['id' => 1]
								]
							]
						]
					]
				],
				'tags' => [
					[
						'id' => 61,
						'slug' => 'blog',
					]
				],
				// 'admin' => [
				// 	'id' => 1,
				// 	'roles' => [
				// 		[
				// 			'name' => 'writer'
				// 		],
				// 	]
				// ],
			]
		]);

		// Delete
		$response = $this->deleteJson('/web/api/admin/articles/3');

		$response->assertStatus(200)->assertJson([
			'message' => 'Deleted'
		]);

		// Show
		$response = $this->getJson('/web/api/admin/articles/3');

		$response->assertStatus(404)->assertJson([
			'message' => 'Record not found.'
		]);
	}
}
