<?php

namespace Tests\Dev;

use App\Enums\AdminRoles;
use App\Models\Admin;
use Database\Seeders\TestSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class XAdminLoggedTest extends TestCase
{
    use RefreshDatabase;

    function test_check_is_user_logged()
    {
        $this->seed(TestSeeder::class);

        $user = Admin::create([
            'name' => 'Dummy Admin',
            'email' => 'dummy_super_admin@gmail.com',
            'password' => Hash::make('Password123#'),
            // 'username' => uniqid('user.'),
        ]);

        $user->assignRole([
            // ...AdminRoles::writerRoles(),
            ...AdminRoles::superAdminRoles(),
        ]);

        $this->actingAs($user, 'admin');

        $response = $this->getJson('/web/api/admin/logged');
        $response->assertStatus(200)->assertJson([
            'message' => 'Authenticated.',
            'user' => [
                'roles' => [
                    // ['name' => 'writer'],
                    ['name' => 'super_admin'],
                ],
            ]
        ])->assertJsonStructure([
            'user' => [
                'f2a',
                'roles',
                'email',
                'name',
                'location',
                'bio',
            ],
        ]);
    }

    function test_logged_not_authenticated()
    {
        Auth::guard('admin')->logout();

        $response = $this->getJson('/web/api/admin/logged');

        $response->assertStatus(422)->assertJson([
            'message' => 'Unauthenticated.'
        ])->assertJsonStructure(['user'])->assertJsonPath('user', null);
    }
}
