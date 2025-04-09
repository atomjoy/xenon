<?php

namespace Tests\Dev;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UserUploadAvatarTest extends TestCase
{
    use RefreshDatabase;

    function test_upload_avatar()
    {
        $disk = config('filesystems.default', 'public');

        Storage::fake($disk);

        $user = User::factory()->create([
            'name' => 'Adelajda Brzęczyszczykiewicz',
            'email' => uniqid() . '@gmail.com'
        ]);

        $this->assertDatabaseHas('users', [
            'name' => $user->name,
            'email' => $user->email,
        ]);

        $this->actingAs($user);

        $response = $this->postJson('/web/api/upload/avatar', [
            'avatar' => UploadedFile::fake()->image('avatar.webp'),
        ]);

        $response->assertStatus(422)->assertJson([
            'message' => 'The avatar field has invalid image dimensions.',
        ]);

        $response = $this->postJson('/web/api/upload/avatar', [
            'avatar' => UploadedFile::fake()->image('avatar.bmp', 200, 200),
        ]);

        $response->assertStatus(422)->assertJson([
            'message' => 'The avatar field must be a file of type: webp, jpeg, jpg, png, gif.',
        ]);

        $response = $this->postJson('/web/api/upload/avatar', [
            'avatar' => UploadedFile::fake()->image('avatar.webp', 256, 256),
        ]);

        $response->assertStatus(200)->assertJson([
            'message' => 'Avatar has been uploaded.',
            'avatar' => 'avatars/' . $user->id . '.webp'
        ]);

        $response = $this->postJson('/web/api/upload/avatar', [
            'avatar' => UploadedFile::fake()->createWithContent('avatar.png', file_get_contents(base_path('tests\Dev\image\fake.png'))),
        ]);

        $response->assertStatus(200)->assertJson([
            'message' => 'Avatar has been uploaded.',
            'avatar' => 'avatars/' . $user->id . '.webp'
        ]);

        $this->assertDatabaseHas('users', [
            'avatar' => 'avatars/' . $user->id . '.webp',
        ]);

        Storage::disk($disk)->assertExists('avatars/' . $user->id . '.webp');
    }
}
