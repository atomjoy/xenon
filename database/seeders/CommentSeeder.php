<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$admin = Admin::role('writer')->first();
		$user = User::role('user')->first();

		$admin->articles()->each(function ($article) use ($user, $admin) {
			// OneToMany
			$user->comments()->save(Comment::factory(1)->make([
				'content' => 'Comment article 4',
				'article_id' => $article->id,
			])->first());
			$user->comments()->save(Comment::factory(1)->make([
				'content' => 'Comment article 3',
				'article_id' => $article->id,
			])->first());
			$user->comments()->save(Comment::factory(1)->make([
				'content' => 'Comment article 2',
				'article_id' => $article->id,
			])->first());
			$admin->comments()->save(Comment::factory(1)->make([
				'content' => 'Comment article 1',
				'article_id' => $article->id,
				'reply_id' => Comment::first()->id
			])->first());
		});
	}

	function manyToManyPolymorphic()
	{
		$admin = Admin::role('writer')->first();
		$user = User::role('user')->first();

		$admin->articles()->each(function ($article) use ($user, $admin) {
			// ManyToMany Polymorphic
			$user->comments()->attach(Comment::factory(2)->create([
				'content' => 'Comment article ' . $article->id,
				'article_id' => $article->id,
			]));
			$admin->comments()->attach(Comment::factory(1)->create([
				'content' => 'Comment article ' . $article->id,
				'article_id' => $article->id,
			]));
		});
	}

	function hasMany()
	{
		$admin = Admin::role('writer')->first();
		$user = User::role('user')->first();

		$admin->articles()->each(function ($article) use ($user) {
			// HasMany relation
			$article->comments()->saveMany(Comment::factory(3)->create([
				'content' => 'Comment article ' . $article->id,
				'article_id' => $article->id,
				'user_id' => $user->id,
			]));
		});
	}
}
