<?php

namespace Tests\Dev;

use Database\Seeders\TestSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserMultiGuardsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Only logged users
     */
    public function test_user_logged_error(): void
    {
        $this->seed(TestSeeder::class);

        $response = $this->getJson('/web/api/only-user');

        $response->assertStatus(401)->assertJson([
            'message' => 'Unauthenticated.',
        ]);

        // Login user error
        $response = $this->postJson('/web/api/login', [
            'email' => 'invalid@example.com',
            'password' => 'Password123#',
        ]);

        $response->assertStatus(422)->assertJson([
            'message' => 'These credentials do not match our records.',
        ]);
    }

    public function test_user_logged_success(): void
    {
        $this->seed(TestSeeder::class);

        // Login user
        $response = $this->postJson('/web/api/login', [
            'email' => 'test@example.com',
            'password' => 'Password123#',
        ]);

        $response->assertStatus(200);

        // Authenticated.
        $response = $this->getJson('/web/api/logged');

        $response->assertStatus(200)->assertJson([
            'message' => 'Authenticated.',
            'guard' => 'web',
        ]);

        // Admin not logged
        $response = $this->getJson('/web/api/admin/only-writer');

        $response->assertStatus(401)->assertJson([
            'message' => 'Unauthenticated.',
        ]);
    }

    /**
     * Only logged admins
     */
    public function test_admin_logged_error(): void
    {
        $this->seed(TestSeeder::class);

        $response = $this->getJson('/web/api/admin/logged');

        $response->assertStatus(422)->assertJson([
            'message' => 'Unauthenticated.',
        ]);

        // Login admin error
        $response = $this->postJson('/web/api/admin/login', [
            'email' => 'invalid@example.com',
            'password' => 'Password123#',
        ]);

        $response->assertStatus(422)->assertJson([
            'message' => 'These credentials do not match our records.',
        ]);
    }

    public function test_admin_logged_success(): void
    {
        $this->seed(TestSeeder::class);

        // Login writer
        $response = $this->postJson('/web/api/admin/login', [
            'email' => 'writer@example.com',
            'password' => 'Password123#',
        ]);

        $response->assertStatus(200)->assertJson([
            'message' => 'Authenticated.',
            'guard' => 'admin',
        ]);

        // Writer logged
        $response = $this->getJson('/web/api/admin/logged');

        $response->assertStatus(200)->assertJson([
            'message' => 'Authenticated.',
            'guard' => 'admin',
        ]);

        // Writer not allowed
        $response = $this->getJson('/web/api/admin/only-admin');

        $response->assertStatus(403)->assertJson([
            'message' => 'User does not have the right roles.',
        ]);

        // User not logged
        $response = $this->getJson('/web/api/only-user');

        $response->assertStatus(401)->assertJson([
            'message' => 'Unauthenticated.',
        ]);
    }
}
