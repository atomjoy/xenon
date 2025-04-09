<?php

namespace Tests\Dev;

use App\Enums\UserRoles;
use App\Models\User;
use Database\Seeders\TestSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UserLoggedTest extends TestCase
{
    use RefreshDatabase;

    function test_check_is_user_logged()
    {
        $this->seed(TestSeeder::class);

        $user = User::factory()->create();

        $user->assignRole([
            ...UserRoles::allRoles(),
        ]);

        $this->actingAs($user);

        $response = $this->getJson('/web/api/logged');
        $response->assertStatus(200)->assertJson([
            'message' => 'Authenticated.',
            'user' => [
                'roles' => [
                    ['name' => 'user'],
                ],
            ]
        ])->assertJsonStructure([
            'user' => [
                'f2a',
                'roles'
            ],
        ]);
    }

    function test_logged_not_authenticated()
    {
        Auth::logout();

        $response = $this->getJson('/web/api/logged');

        $response->assertStatus(422)->assertJson([
            'message' => 'Unauthenticated.'
        ])->assertJsonStructure(['user'])->assertJsonPath('user', null);
    }
}
