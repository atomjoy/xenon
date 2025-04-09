<?php

namespace App\Http\Controllers\Panel;

use App\Models\User;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Http\Resources\CommentCollection;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		$perpage = request()->integer('perpage', default: 6);

		return  new CommentCollection(
			Comment::latest('id')
				->where('commentable_type', User::class)
				->where('commentable_id', Auth::guard('web')->user()->id)
				->paginate($perpage)
		);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		// Route not exists
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreCommentRequest $request)
	{
		// Route not exists
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Comment $comment)
	{
		return new CommentResource($comment);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Comment $comment)
	{
		// Route not exists
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateCommentRequest $request, Comment $comment)
	{
		$user = Auth::guard('web')->user();

		if (
			$user->id == $comment->commentable_id &&
			$comment->commentable_type == User::class
		) {
			$comment->update($request->safe()->only(['content']));
			return response()->json(['message' => 'Updated']);
		}

		return response()->json(['message' => 'Failed'], 422);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Comment $comment)
	{
		$user = Auth::guard('web')->user();

		if (
			$user->id == $comment->commentable_id &&
			$comment->commentable_type == User::class
		) {
			$comment->delete();
			return response()->json(['message' => 'Deleted']);
		}

		return response()->json(['message' => 'Failed'], 422);
	}

	/**
	 * Display the specified resource.
	 */
	public function count(User $user)
	{
		return response()->json([
			'message' => 'Counted',
			'count' => $user->comments()->count() ?? 0
		]);
	}
}
