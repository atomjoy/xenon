<?php

namespace Tests\Dev;

use App\Enums\AdminRoles;
use App\Models\Admin;
use Database\Seeders\TestSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class XAdminUploadAvatarTest extends TestCase
{
    use RefreshDatabase;

    function test_upload_avatar()
    {
        $this->seed(TestSeeder::class);

        $disk = config('filesystems.default', 'public');

        Storage::fake($disk);

        $user = Admin::create([
            'name' => 'Adelajda Brzęczyszczykiewicz',
            'email' => uniqid() . '@gmail.com',
            'username' => 'benbax',
            'password' => 'invalidpass',
        ]);

        $user->assignRole([
            ...AdminRoles::writerRoles(),
        ]);

        $user->email_verified_at = now();
        $user->save();

        $this->assertDatabaseHas('admins', [
            'name' => $user->name,
            'email' => $user->email,
        ]);

        $this->actingAs($user, 'admin');

        $response = $this->postJson('/web/api/admin/upload/avatar', [
            'avatar' => UploadedFile::fake()->image('avatar.webp'),
        ]);

        $response->assertStatus(422)->assertJson([
            'message' => 'The avatar field has invalid image dimensions.',
        ]);

        $response = $this->postJson('/web/api/admin/upload/avatar', [
            'avatar' => UploadedFile::fake()->image('avatar.bmp', 200, 200),
        ]);

        $response->assertStatus(422)->assertJson([
            'message' => 'The avatar field must be a file of type: webp, jpeg, jpg, png, gif.',
        ]);

        $response = $this->postJson('/web/api/admin/upload/avatar', [
            // 'avatar' => UploadedFile::fake()->image('avatar.webp', 200, 200),
            'avatar' => UploadedFile::fake()->createWithContent('avatar.webp', file_get_contents(base_path('tests\Dev\image\fake.webp'))),
        ]);

        $response->assertStatus(200)->assertJson([
            'message' => 'Avatar has been uploaded.',
            'avatar' => 'avatars/admin/' . $user->id . '.webp'
        ]);

        $this->assertDatabaseHas('admins', [
            'avatar' => 'avatars/admin/' . $user->id . '.webp',
        ]);

        Storage::disk($disk)->assertExists('avatars/admin/' . $user->id . '.webp');
    }
}
