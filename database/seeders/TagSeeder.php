<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Admin::role('writer')->first();

        $admin->articles()->each(function ($article) {
            $article->tags()->saveMany(Tag::factory(1)->create([
                'slug' => 'tag-article-1',
                'article_id' => $article->id,
            ]));
            $article->tags()->saveMany(Tag::factory(1)->create([
                'slug' => 'tag-article-2',
                'article_id' => $article->id,
            ]));
            $article->tags()->saveMany(Tag::factory(1)->create([
                'slug' => 'tag-article-3',
                'article_id' => $article->id,
            ]));
        });
    }
}
