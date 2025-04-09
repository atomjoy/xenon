<?php

namespace Tests\Dev;

use App\Enums\UserRoles;
use Database\Seeders\TestSeeder;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Notifications\Messages\UserMessage;
use App\Notifications\UserNotification;
use Illuminate\Support\Facades\Hash;

class UserNotificationsTest extends TestCase
{
    use RefreshDatabase;

    function test_create_notifications()
    {
        $this->seed(TestSeeder::class);

        $user = User::factory()->create([
            'email' => 'dummy@gmail.com',
            'password' => Hash::make('Password123#'),
        ])->assignRole([
            ...UserRoles::allRoles(),
        ]);

        $this->actingAs($user);

        $msg = new UserMessage();
        $msg->setContent('Hello max your link_signup and link_signin link (Register link_signup).');
        $msg->setLink('link_signup', 'https://example.com/signup', 'Sign Up');
        $msg->setLink('link_signin', 'https://example.com/signin', 'Sign In');

        $user->notify(new UserNotification($msg));
        $user->notifyNow(new UserNotification($msg));

        $this->assertTrue($user->notifications()->count() == 2);

        // Get notifications page
        $res = $this->getJson('/web/api/notifications/page/1');

        $res->assertStatus(200)->assertJson([
            'message' => 'Notifications.',
            'unread' => 2,
        ]);

        $this->assertTrue(count($res['notifications']) == 2);

        $id1 = $res['notifications'][0]['id'];
        $id2 = $res['notifications'][1]['id'];

        // Toggle
        $res = $this->getJson('/web/api/notifications/toggle/' . $id1);

        $res->assertStatus(200)->assertJson([
            'message' => 'Updated.'
        ]);

        $this->assertDatabaseMissing('notifications', [
            'id' => $id1,
            'read_at' => NULL,
        ]);

        // Toggle
        $res = $this->getJson('/web/api/notifications/toggle/' . $id1);

        $res->assertStatus(200)->assertJson([
            'message' => 'Updated.'
        ]);

        $this->assertDatabaseHas('notifications', [
            'id' => $id1,
            'read_at' => NULL,
        ]);

        // Mark all
        $res = $this->getJson('/web/api/notifications/readall');

        $res->assertStatus(200)->assertJson([
            'message' => 'Updated.'
        ]);

        $this->assertDatabaseMissing('notifications', [
            'id' => $id2,
            'read_at' => NULL,
        ]);

        // Delete
        $this->assertDatabaseHas('notifications', [
            'id' => $id2
        ]);

        $res = $this->getJson('/web/api/notifications/delete/' . $id2);

        $res->assertStatus(200)->assertJson([
            'message' => 'Updated.'
        ]);

        $this->assertDatabaseMissing('notifications', [
            'id' => $id2
        ]);

        // Get notifications page
        $res = $this->getJson('/web/api/notifications/page/1');

        $res->assertStatus(200)->assertJson([
            'message' => 'Notifications.'
        ]);

        $this->assertTrue(count($res['notifications']) == 1);
    }
}
