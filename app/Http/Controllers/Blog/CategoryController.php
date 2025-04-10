<?php

namespace App\Http\Controllers\Blog;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
	/**
	 * Get categories.
	 */
	public function index()
	{
		$perpage = request()->integer('perpage', default: 9);

		return CategoryResource::collection(
			Category::where('visible', 1)
				->whereNull('category_id')
				->paginate($perpage)
		);
	}

	/**
	 * Get category.
	 */
	public function show(Category $category)
	{
		return new CategoryResource($category);
	}
}
