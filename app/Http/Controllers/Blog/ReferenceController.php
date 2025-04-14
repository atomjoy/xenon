<?php

namespace App\Http\Controllers\Blog;

use App\Models\Reference;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReferenceCollection;

class ReferenceController extends Controller
{
	/**
	 * Get categories.
	 */
	public function index()
	{
		$perpage = request()->integer('perpage', default: 6);

		return new ReferenceCollection(Reference::latest('id')->paginate($perpage));
	}

	/**
	 * Get reference.
	 */
	public function show(Reference $reference)
	{
		return $reference;
	}
}
