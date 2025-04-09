<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentCollection;
use App\Http\Resources\CommentResource;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		Gate::authorize('viewAny', Comment::class);

		$perpage = request()->integer('perpage', default: 6);

		return  new CommentCollection(Comment::latest('id')->paginate($perpage));
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
		Gate::authorize('view', $comment);

		return new CommentResource($comment);
		// return $comment->with(['user'])->first();
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
		Gate::authorize('update', $comment);

		$comment->update($request->validated());

		return response()->json([
			'message' => 'Updated',
			'data' => $comment,
		]);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Comment $comment)
	{
		Gate::authorize('delete', $comment);

		$comment->delete();

		return response()->json(['message' => 'Deleted']);
	}

	/**
	 * Display the specified resource.
	 */
	public function count(Admin $admin)
	{
		return response()->json([
			'message' => 'Counted',
			'count' => $admin->comments()->count() ?? 0
		]);
	}
}
