<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$admin = Admin::role('writer')->get();

		// Create articles for each user
		$admin->each(function ($user) {
			Article::factory(20)->sequence(function (Sequence $sequence) {
				return [
					'title' => 'Article title ' . ($sequence->index + 1),
				];
			})->create([
				'admin_id' => $user->id,
			])->each(function ($article) use ($user) {
				$article->categories()->sync([rand(1, 4), rand(5, 8)]);
			});
			// ->create([
			// 	'admin_id' => $user->id,
			// 	'category_id' => Category::inRandomOrder()->first()->id,
			// ])->each(function ($article) use ($user) {
			//     $article->comments()->saveMany(Comment::factory(3)->create([
			//         'content' => 'Comment article ' . $article->id,
			//         'user_id' => $user->id,
			//         'article_id' => $article->id,
			//     ]));
			// });
		});
	}
}
