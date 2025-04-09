<?php

namespace App\Http\Controllers\Blog;

use App\Models\Tag;
use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;

class TagController extends Controller
{
	/**
	 * Get categories.
	 */
	public function index()
	{
		$perpage = request()->integer('perpage', default: 9);

		return TagResource::collection(
			Tag::latest('id')->paginate($perpage)
		);
	}

	/**
	 * Get tag.
	 */
	public function show(Tag $tag)
	{
		return new TagResource($tag);
	}
}
