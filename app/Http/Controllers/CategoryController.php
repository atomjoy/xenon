<?php

namespace App\Http\Controllers;

use App\Exceptions\JsonException;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CategoryController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		Gate::authorize('viewAny', Category::class);

		$perpage = request()->integer('perpage', default: 5);

		return Category::with(['parent'])->latest('id')->paginate($perpage);
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
	public function store(StoreCategoryRequest $request)
	{
		Gate::authorize('create', Category::class);

		$category = Category::create($request->validated());

		$this->upload($category);

		return response()->json([
			'message' => 'Created',
			'data' => $category,
		]);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Category $category)
	{
		Gate::authorize('view', $category);

		return $category;
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Category $category)
	{
		// Route not exists
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateCategoryRequest $request, Category $category)
	{
		Gate::authorize('update', $category);

		$category->update($request->validated());

		$this->upload($category);

		return response()->json([
			'message' => 'Updated',
			'data' => $category,
		]);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Category $category)
	{
		Gate::authorize('delete', $category);

		$category->articles()->detach();

		$category->delete();

		return response()->json(['message' => 'Deleted']);
	}

	/**
	 * Upload category image
	 *
	 * @param Category $category
	 * @return void
	 */
	function upload($category)
	{
		Gate::authorize('create', $category);

		try {
			if (request()->file('image')) {
				$path = 'category/' . $category->id . '.webp';

				$image = (new ImageManager(new Driver()))
					->read(request()->file('image'))
					->toWebp();

				Storage::put($path, (string) $image);

				$category->image = $path;
				$category->save();
			}
		} catch (\Throwable $e) {
			report($e->getMessage());
		}
	}

	/**
	 * Remove category image
	 *
	 * @param Category $category
	 * @return void
	 */
	function remove(Category $category)
	{
		Gate::authorize('update', $category);

		try {
			if (Storage::exists($category->image)) {
				Storage::delete($category->image);
				$category->image = null;
				$category->save();
			}

			return response()->json([
				'message' => __('remove.image.success'),
			], 200);
		} catch (\Throwable $e) {
			report($e);
			throw new JsonException(__('remove.image.error'), 422);
		}
	}

	/**
	 * Display a listing of the resource.
	 */
	public function allCategories()
	{
		// Gate::authorize('viewAny', Category::class);

		return Category::latest('id')->get();
	}

	/**
	 * Display a listing of the resource.
	 */
	public function mainCategories()
	{
		// Gate::authorize('viewAny', Category::class);

		return Category::with(['subcats'])->latest('id')->where('category_id', null)->get();
	}
}
