<?php

namespace App\Http\Controllers\Blog;

use App\Models\Article;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleCollection;
use App\Http\Resources\ArticleResource;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
	/**
	 * Get articles.
	 */
	public function index()
	{
		$perpage = request()->integer('perpage', default: 6);

		return new ArticleCollection(
			Article::latest('id')
				->orWhereDate('published_at', '<', now())
				->paginate($perpage)
		);
	}

	/**
	 * Get article.
	 */
	public function show(Article $article)
	{
		$article->update(['views' => ((int) $article->views) + 1]);

		return new ArticleResource($article);
	}
}
