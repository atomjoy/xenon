<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\AUth\TestSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PermissionsTest extends TestCase
{
	use RefreshDatabase;

	/**
	 * A basic test example.
	 */
	public function test_user_roles(): void
	{
		$this->seed(TestSeeder::class);

		$user = User::role('writer')->first();

		$this->actingAs($user);

		$response = $this->getJson('/web/api/test/permissions');
		$response->assertStatus(200);
		$response->assertJson([
			'user' => [
				"id" => 2,
				'permission' => [
					[
						"id" => 9,
						"name" => "article_view",
						"guard_name" => "web"
					],
					[
						"id" => 10,
						"name" => "article_create",
						"guard_name" => "web"
					],
					[
						"id" => 11,
						"name" => "article_update",
						"guard_name" => "web"
					],
					[
						"id" => 12,
						"name" => "article_delete",
						"guard_name" => "web"
					],
				],
				'permissions' => [
					[
						"id" => 9,
						"name" => "article_view",
						"guard_name" => "web"
					],
					[
						"id" => 10,
						"name" => "article_create",
						"guard_name" => "web"
					],
					[
						"id" => 11,
						"name" => "article_update",
						"guard_name" => "web"
					],
					[
						"id" => 12,
						"name" => "article_delete",
						"guard_name" => "web"
					],
				],
				'roles' => [
					[
						"id" => 4,
						"name" => "writer",
						"guard_name" => "web",
						'permissions' => [],
					]
				],
			]
		]);
	}
}
