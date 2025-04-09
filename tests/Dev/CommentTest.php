<?php

namespace Tests\Dev;

use App\Models\Admin;
use App\Models\Comment;
use Database\Seeders\TestSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
	use RefreshDatabase;

	/**
	 * A basic feature test example.
	 */
	public function test_comment(): void
	{
		$this->seed(TestSeeder::class);

		$user = Admin::role('writer')->first();

		$this->actingAs($user, 'admin');

		// Create
		$response = $this->postJson('/web/api/admin/comments', []);

		$response->assertStatus(422)->assertJson([
			'message' => 'The content field is required.',
		]);

		// Get comment
		$id = Comment::first()->id;

		// Update
		$response = $this->patchJson('/web/api/admin/comments/' . $id, [
			'content' => 'New comment content',
		]);

		$response->assertStatus(200)->assertJson([
			"message" => "Updated",
			'data' => [
				'content' => 'New comment content',
			]
		]);

		// Show
		$response = $this->getJson('/web/api/admin/comments');

		$response->assertStatus(200)->assertJson([
			'current_page' => 1,
			'data' => [
				['content' => 'Comment article 1']
			],
		]);

		// Show
		$response = $this->getJson('/web/api/admin/comments?page=2');

		$response->assertStatus(200)->assertJson([
			'current_page' => 2,
			'data' => [
				['content' => 'Comment article 2']
			],
		]);

		// Show
		$response = $this->getJson('/web/api/admin/comments?page=2&perpage=3');

		$response->assertStatus(200)->assertJson([
			'current_page' => 2,
			'data' => [
				['content' => 'Comment article 4']
			],
		]);

		// Show
		$response = $this->getJson('/web/api/admin/comments/' . $id);

		$response->assertStatus(200)->assertJson([
			'id' => 161,
			'article_id' => 42,
			'content' => 'New comment content',
			// 'user_id' => 3,
			// 'user' => [
			// 	'id' => 3,
			// 	'roles' => [
			// 		[
			// 			'name' => 'user'
			// 		],
			// 	]
			// ]
		]);

		// Delete
		$response = $this->deleteJson('/web/api/admin/comments/' . $id);

		$response->assertStatus(200)->assertJson([
			'message' => 'Deleted'
		]);

		// Show
		$response = $this->getJson('/web/api/admin/comments/' . $id);

		$response->assertStatus(404)->assertJson([
			'message' => 'Record not found.'
		]);
	}
}
