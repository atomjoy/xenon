<?php

namespace Tests\Dev;

use App\Models\User;
use App\Enums\UserRoles;
use Database\Seeders\TestSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserAccountDeleteTest extends TestCase
{
	use RefreshDatabase;

	/**
	 * A basic feature test example.
	 */
	public function test_example(): void
	{
		$this->seed(TestSeeder::class);

		$user = User::factory()->create([
			'email' => 'alex@example.com',
			'password' => Hash::make('Password123#'),
		])->assignRole([
			...UserRoles::allRoles(),
		]);

		$email = $user->email;

		$this->actingAs($user, 'web');

		$response = $this->patchJson('/web/api/account/delete', [
			'current_password' => 'Password123#'
		]);

		$response->assertStatus(200)->assertJson([
			'message' => 'Account has been deleted.'
		]);

		$this->assertDatabaseHas('users', [
			'email' => '#del#' . str_replace('@', '#', $email),
			'remember_token' => null,
		]);
	}
}
