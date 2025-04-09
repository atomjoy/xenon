<?php

namespace Tests\Dev;

use App\Enums\UserRoles;
use App\Models\User;
use Database\Seeders\TestSeeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserPasswordConfirmTest extends TestCase
{
    use RefreshDatabase;

    function test_confirm_logged_user_password()
    {
        $this->seed(TestSeeder::class);

        $user = User::factory()->create([
            'password' => Hash::make('Password123#')
        ]);

        $user->assignRole([
            ...UserRoles::allRoles(),
        ]);

        $this->actingAs($user);

        $res = $this->postJson('/web/api/password/confirm', [
            'password' => 'Password123##'
        ]);

        $res->assertStatus(422)->assertJson([
            'message' => 'Invalid current password.'
        ]);

        $res = $this->postJson('/web/api/password/confirm', [
            'password' => 'Password123#'
        ]);

        $res->assertStatus(200)->assertJson([
            'message' => 'Confirmed.'
        ]);

        Auth::logout();

        $res = $this->postJson('/web/api/password/confirm', [
            'password' => 'Password123#'
        ]);

        $res->assertStatus(401)->assertJson([
            'message' => 'Unauthenticated.'
        ]);
    }
}
