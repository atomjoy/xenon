<?php

namespace Tests\Dev;

use App\Models\Admin;
use App\Models\Category;
use Database\Seeders\ArticleSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\CommentSeeder;
use Database\Seeders\TagSeeder;
use Database\Seeders\TestSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
	use RefreshDatabase;

	/**
	 * A basic feature test example.
	 */
	public function test_category(): void
	{
		$this->seed(TestSeeder::class);

		$user = Admin::role('admin')->first();

		$this->actingAs($user, 'admin');

		// Create
		$response = $this->postJson('/web/api/admin/categories');

		$response->assertStatus(422)->assertJson([
			'message' => 'The name field is required.',
		]);

		$id = Category::first()->id;

		// Update
		$response = $this->patchJson('/web/api/admin/categories/' . $id, [
			'name' => 'Category 69',
			'slug' => 'category-six-nine',
			'about' => 'Category sixty nine description',
		]);

		$response->assertStatus(200)->assertJson([
			"message" => "Updated",
			'data' => [
				'name' => 'Category 69',
				'slug' => 'category-six-nine',
				'about' => 'Category sixty nine description'
			]
		]);

		// Show
		$response = $this->getJson('/web/api/admin/categories');

		$response->assertStatus(200)->assertJson([
			'current_page' => 1,
			'data' => [
				['name' => 'Category 9']
			],
		]);

		// Show
		$response = $this->getJson('/web/api/admin/categories?page=2');

		$response->assertStatus(200)->assertJson([
			'current_page' => 2,
			'data' => [
				['name' => 'Category 4']
			],
		]);

		// Show
		$response = $this->getJson('/web/api/admin/categories?page=2&perpage=3');

		$response->assertStatus(200)->assertJson([
			'current_page' => 2,
			'data' => [
				['name' => 'Category 6']
			],
		]);

		// Show
		$response = $this->getJson('/web/api/admin/categories/' . $id);

		$response->assertStatus(200)->assertJson([
			'id' => $id,
			'name' => 'Category 69',
		]);

		// Delete
		$response = $this->deleteJson('/web/api/admin/categories/' . $id);

		$response->assertStatus(200)->assertJson([
			'message' => 'Deleted'
		]);

		// Show
		$response = $this->getJson('/web/api/admin/categories/' . $id);

		$response->assertStatus(404)->assertJson([
			'message' => 'Record not found.'
		]);
	}
}
