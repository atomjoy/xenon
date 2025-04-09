<?php

namespace App\Http\Controllers\Blog;

use App\Models\Article;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Resources\CommentResource;
use App\Http\Resources\CommentCollection;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
	/**
	 * Get article comments.
	 */
	public function index(Article $article)
	{
		$perpage = request()->integer('perpage', default: 6);

		return new CommentCollection(
			$article->comments()
				->whereNull('reply_id')
				->where('is_approved', true)
				->paginate($perpage)
		);
	}

	/**
	 * Get comment.
	 */
	public function show(Comment $comment)
	{
		return new CommentResource($comment);
	}

	/**
	 * Create article comment.
	 */
	public function store(StoreCommentRequest $request, Article $article)
	{
		try {
			$user = Auth::guard('web')->user();

			$valid = $request->validated();

			$valid['article_id'] = $article->id;
			$valid['ip_address'] = $request->ip();

			$user->comments()->save(new Comment($valid));

			return response()->json(['message' => 'Created']);
		} catch (\Throwable $e) {
			report($e);
		}

		return response()->json(['message' => 'Not created'], 422);
	}
}
