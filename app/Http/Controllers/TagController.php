<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use Illuminate\Support\Facades\Gate;

class TagController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		Gate::authorize('viewAny', Tag::class);

		$perpage = request()->integer('perpage', default: 5);

		return Tag::latest('id')->paginate($perpage);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		// Route not exist
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreTagRequest $request)
	{
		Gate::authorize('create', Tag::class);

		$tag = Tag::create($request->validated());

		return response()->json([
			'message' => 'Created',
			'data' => $tag,
		]);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Tag $tag)
	{
		Gate::authorize('view', $tag);

		return $tag;
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Tag $tag)
	{
		// Route not exists
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateTagRequest $request, Tag $tag)
	{
		Gate::authorize('update', $tag);

		$tag->update($request->validated());

		return response()->json([
			'message' => 'Updated',
			'data' => $tag,
		]);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Tag $tag)
	{
		Gate::authorize('delete', $tag);

		$tag->delete();

		return response()->json(['message' => 'Deleted']);
	}
}
