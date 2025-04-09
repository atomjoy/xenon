<?php

namespace Tests\Dev;

use App\Enums\AdminRoles;
use App\Models\Admin;
use Database\Seeders\TestSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class XAdminLoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Register user.
     */
    public function test_writer_login(): void
    {
        $this->seed(TestSeeder::class);

        Auth::shouldUse('admin');

        Auth::logout();

        $user = Admin::create([
            'name' => 'Dummy Admin',
            'email' => 'dummy_super_admin@gmail.com',
            'password' => Hash::make('Password123#'),
            'email_verified_at' => now(),
            // 'username' => uniqid('user.'),
        ]);

        $user->assignRole([
            ...AdminRoles::writerRoles(),
        ]);

        $user->email_verified_at = now();
        $user->save();

        $name = $user->name;
        $email = $user->email;
        $password = 'Password123#';

        $this->assertDatabaseHas('admins', [
            'name' => $name,
            'email' => $email,
        ]);

        $response = $this->postJson('web/api/admin/login', [
            'email' => $email,
            'password' => $password,
        ]);

        $response->assertStatus(200)->assertJson([
            'message' => 'Authenticated.',
            'redirect' => null,
            'user' => [
                'roles' => [
                    ['name' => 'writer'],
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
        ])->assertJsonPath('user.email', $user->email);

        $this->assertNotNull($response['user']);
    }

    /**
     * Super admin login.
     */
    public function test_super_admin_login(): void
    {
        $this->seed(TestSeeder::class);

        Auth::guard('admin')->logout();

        $user = Admin::create([
            'name' => 'Admin',
            'username' => 'super_admin',
            'email' => 'super_admin@example.com',
            'password' => Hash::make('Password123#'),
            'email_verified_at' => now(),
        ]);

        $user->assignRole([
            ...AdminRoles::superAdminRoles()
        ]);

        $user->email_verified_at = now();
        $user->save();

        $this->actingAs($user, 'admin');

        $response = $this->getJson('/web/api/admin/only-super-admin');

        $response->assertStatus(200)->assertJson([
            'message' => 'Authenticated.'
        ]);
    }
}
