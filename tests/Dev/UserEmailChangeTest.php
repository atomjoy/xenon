<?php

namespace Tests\Dev;

use App\Enums\UserRoles;
use Database\Seeders\TestSeeder;
use App\Models\User;
use App\Mail\ChangeMail;
use App\Mail\ChangeMailRecovery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class UserEmailChangeTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_email_change_not_logged(): void
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

        $response = $this->postJson('web/api/change/email', [
            'email' => $email,
        ]);

        $response->assertStatus(401)->assertJson([
            'message' => 'Unauthenticated.',
        ]);
    }

    public function test_email_change_logged(): void
    {
        $this->seed(TestSeeder::class);

        Mail::fake();

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

        $this->actingAs($user);

        $new_email = 'new' . $email;

        $response = $this->postJson('web/api/change/email', [
            'email' => $new_email,
        ]);

        $response->assertStatus(200)->assertJson([
            'message' => 'The e-mail with the code has been sent.',
        ]);

        // $cache = Cache::get('emailchange_' . md5($user->id));
        // $needle = $user->id . '|' . $new_email . '|';

        // $this->assertNotEmpty($cache);
        // $this->assertStringContainsString($needle, $cache);

        Mail::assertSent(ChangeMail::class, function ($mail) use ($email, $name) {
            $mail->build();
            $html = $mail->render();
            $subject = $mail->subject;

            $this->assertTrue(strpos($html, $name) !== false);
            $this->assertEquals("👋 Account e-mail change.", $subject, 'The subject was not the right one.');
            $this->assertMatchesRegularExpression('/\/change\/email\/[0-9]+\/[a-z0-9]+\?locale=[a-z]{2}"/i', $html);

            return $mail->hasTo($email) && $mail->hasSubject("👋 Account e-mail change.");
        });
    }

    /**
     * Register user.
     */
    public function test_email_change_event(): void
    {
        $this->seed(TestSeeder::class);

        Event::fake([MessageSent::class]);

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

        $this->actingAs($user);

        $response = $this->postJson('web/api/change/email', [
            'email' => $email,
        ]);

        $response->assertStatus(422)->assertJson([
            'message' => 'It is your current email address.',
        ]);

        $new_email = 'new_' . $email;

        $response = $this->postJson('web/api/change/email', [
            'email' => $new_email,
        ]);

        $response->assertStatus(200)->assertJson([
            'message' => 'The e-mail with the code has been sent.',
        ]);

        Event::assertDispatchedTimes(MessageSent::class, 2);

        Event::assertDispatched(MessageSent::class, function ($e) use ($email, $name) {
            $html = $e->message->getHtmlBody();
            $subject = $e->message->getSubject();
            $recipient = collect($e->message->getTo())->first()->getAddress();
            $this->assertStringContainsString($name, $html);

            // Multiple events
            if (!in_array($subject, ['👋 Account e-mail change.', '👋 Restoring your e-mail address.'])) {
                return false;
            }
            // Single event
            // $this->assertEquals('👋 Account e-mail change.', $subject, 'The subject was not the right one.');

            // Multiple events
            $this->assertMatchesRegularExpression('/\/change\/email\/[0-9]+\/[a-z0-9]+\?locale=[a-z]{2}|\/change\/email\/recovery\/[0-9]+\/[a-z0-9]+\?locale=[a-z]{2}"/i', $html);

            return $recipient == $email;
        });
    }
}
