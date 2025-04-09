<?php

namespace Tests\Dev;

use App\Models\Admin;
use App\Models\Article;
use App\Models\Tag;
use Database\Seeders\ArticleSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\CommentSeeder;
use Database\Seeders\TagSeeder;
use Database\Seeders\TestSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TagTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_tag(): void
    {
        $this->seed(TestSeeder::class);

        $user = Admin::role('writer')->first();

        $this->actingAs($user, 'admin');

        // Create
        $response = $this->postJson('/web/api/admin/tags');

        $response->assertStatus(422)->assertJson([
            'message' => 'The article id field is required.',
        ]);

        $id = Tag::first()->id;

        // Update
        $response = $this->patchJson('/web/api/admin/tags/' . $id, [
            'slug' => 'tag-six-nine',
        ]);

        $response->assertStatus(200)->assertJson([
            "message" => "Updated",
            'data' => [
                'slug' => 'tag-six-nine',
            ]
        ]);

        // Show
        $response = $this->getJson('/web/api/admin/tags');

        $response->assertStatus(200)->assertJson([
            'current_page' => 1,
            'data' => [
                ['slug' => 'tag-article-3']
            ],
        ]);

        // Show
        $response = $this->getJson('/web/api/admin/tags?page=2');

        $response->assertStatus(200)->assertJson([
            'current_page' => 2,
            'data' => [
                ['slug' => 'tag-article-1']
            ],
        ]);

        // Show
        $response = $this->getJson('/web/api/admin/tags?page=2&perpage=3');

        $response->assertStatus(200)->assertJson([
            'current_page' => 2,
            'data' => [
                ['slug' => 'tag-article-3']
            ],
        ]);

        // Show
        $response = $this->getJson('/web/api/admin/tags/' . $id);

        $response->assertStatus(200)->assertJson([
            'id' => $id,
            'slug' => 'tag-six-nine',
        ]);

        // Delete
        $response = $this->deleteJson('/web/api/admin/tags/' . $id);

        $response->assertStatus(200)->assertJson([
            'message' => 'Deleted'
        ]);

        $article = Article::first();

        // Create
        $response = $this->postJson('/web/api/admin/tags', [
            'article_id' => $article->id,
            'slug' => 'duplicate-error-slug',
        ]);

        $response->assertStatus(200)->assertJson([
            'message' => 'Created',
        ]);

        // Create error
        $response = $this->postJson('/web/api/admin/tags', [
            'article_id' => $article->id,
            'slug' => 'duplicate-error-slug',
        ]);

        $response->assertStatus(422)->assertJson([
            'message' => 'The slug has already been taken.',
        ]);

        $tag = Tag::latest()->first();

        // Update error
        $response = $this->patchJson('/web/api/admin/tags/' . $tag->id, [
            'slug' => $tag->slug,
        ]);

        $response->assertStatus(422)->assertJson([
            'message' => 'The slug has already been taken.',
        ]);
    }
}
