<?php

namespace Tests\Dev;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserLogoutTest extends TestCase
{
    use RefreshDatabase;

    function test_check_logout_user()
    {
        $response = $this->getJson('/web/api/logout');
        $response->assertStatus(200)->assertJson([
            'message' => 'Logged out.'
        ]);

        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->getJson('/web/api/logout');
        $response->assertStatus(200)->assertJson([
            'message' => 'Logged out.'
        ]);
    }
}
