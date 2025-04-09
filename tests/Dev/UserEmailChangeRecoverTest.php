<?php

namespace Tests\Dev;

use App\Enums\UserRoles;
use Database\Seeders\TestSeeder;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\ChangeEmail;

class UserEmailChangeRecoverTest extends TestCase
{
	use RefreshDatabase;

	function test_change_user_email_recover()
	{
		$this->seed(TestSeeder::class);

		$user = User::factory()->create([
			'name' => 'Alex',
			'email' => uniqid() . '@gmail.com'
		])->assignRole([
			...UserRoles::allRoles(),
		]);

		$name = $user->name;
		$email = $user->email;

		$this->assertDatabaseHas('users', [
			'name' => $name,
			'email' => $email,
		]);

		$code = uniqid();

		ChangeEmail::create([
			'user_id' => $user->id,
			'email_old' => $user->email,
			'email_new' => 'new_' . $user->email,
			'code' => $code,
		]);

		$response = $this->getJson('/change/email/recovery/' . $user->id . '/' . $code);

		$response->assertStatus(200)->assertJson([
			'message' => 'Email address has been updated. Refresh panel page.',
		]);
	}
}
