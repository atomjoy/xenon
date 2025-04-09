<?php

namespace Tests\Dev;

use App\Enums\AdminRoles;
use App\Models\Admin;
use Database\Seeders\TestSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class XAdminAccountUpdateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_admin_account_update(): void
    {
        $this->seed(TestSeeder::class);

        $user = Admin::factory()->create([
            'email' => 'dummy@gmail.com',
            'password' => Hash::make('Password123#'),
        ])->assignRole([
            ...AdminRoles::writerRoles(),
        ]);

        $this->actingAs($user, 'admin');

        $response = $this->postJson('/web/api/admin/account/update', [
            'name' => 'Alex Moonlite',
            'location' => 'Usa, Collorado',
            'bio' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit neque, sapiente et ut assumenda eum dolores ipsum eius sunt incidunt voluptate quos aliquid laudantium unde corrupti voluptatibus in labore hic.',
            'mobile_prefix' => '48',
            'mobile' => '100200300',
            'allow_email' => 1,
            'allow_sms' => 1,
        ]);

        $response->assertStatus(200)->assertJson([
            'message' => 'User account has been updated.',
            'user' => [
                'name' => 'Alex Moonlite',
                'location' => 'Usa, Collorado',
                'bio' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit neque, sapiente et ut assumenda eum dolores ipsum eius sunt incidunt voluptate quos aliquid laudantium unde corrupti voluptatibus in labore hic.',
                'mobile_prefix' => '48',
                'mobile' => '100200300',
                'allow_email' => 1,
                'allow_sms' => 1,
            ]
        ]);
    }
}
