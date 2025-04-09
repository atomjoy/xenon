<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Admin;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ArticleController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		// Gate::authorize('viewAny', [Article::class, $team_id]);
		Gate::authorize('viewAny', Article::class);

		$perpage = request()->integer('perpage', default: 5);

		// All articles
		if (Auth::user()->hasRole(['admin', 'super_admin'])) {
			return ArticleResource::collection(
				Article::latest('id')->paginate($perpage)
			);
		}

		// Author articles only
		return ArticleResource::collection(
			Article::where('admin_id', Auth::guard('admin')->user()->id)->latest('id')->paginate($perpage)
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
	public function store(StoreArticleRequest $request)
	{
		Gate::authorize('create', Article::class);

		Auth::shouldUse('admin');

		$valid = $request->validated();

		$valid['admin_id'] = Auth::id();

		$article = Article::create($valid);

		if ($request->file('image')) {
			$image = (new ImageManager(new Driver()))
				->read($request->file('image'))
				->toWebp();

			$path = 'articles/article-' . $article->id . '.webp';
			Storage::put($path, (string) $image);
			$valid['image'] = $path;
			$article->update($valid);
		}

		$article->categories()->sync([...$valid['category_id']]);

		return response()->json([
			'message' => 'Created',
			'data' => $article,
		]);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Article $article)
	{
		Gate::authorize('view', $article);

		return new ArticleResource($article);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Article $article)
	{
		// Route not exists
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateArticleRequest $request, Article $article)
	{
		Gate::authorize('update', $article);

		$valid = $request->validated();

		$article->update($valid);

		$article->categories()->sync([...$valid['category_id']]);

		$tags = explode(',', ...$valid['tags']);

		if (count($tags) > 0) {
			$article->tags()->delete();

			foreach ($tags as $slug) {
				if (!empty($slug)) {
					Tag::create([
						'article_id' => $article->id,
						'slug' => $slug
					]);
				}
			}
		}

		if ($request->file('image')) {
			$image = (new ImageManager(new Driver()))
				->read($request->file('image'))
				->toWebp();

			$path = 'articles/article-' . $article->id . '.webp';
			Storage::put($path, (string) $image);
			$valid['image'] = $path;
			$article->update($valid);
		}

		return response()->json([
			'message' => 'Updated',
			'data' => $article,
			'category_id' => $valid['category_id'],
		]);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Article $article)
	{
		Gate::authorize('delete', $article);

		$article->delete();

		return response()->json(['message' => 'Deleted']);
	}

	/**
	 * Remove article image
	 *
	 * @param Article $article
	 * @return void
	 */
	function remove(Article $article)
	{
		Gate::authorize('update', $article);

		try {
			if (Storage::exists($article->image)) {
				Storage::delete($article->image);
			}

			$article->image = null;
			$article->save();

			return response()->json([
				'message' => __('remove.image.success'),
			], 200);
		} catch (\Throwable $e) {
			report($e);
			throw new JsonException(__('remove.image.error'), 422);
		}
	}

	/**
	 * Display the specified resource.
	 */
	public function count(Admin $admin)
	{
		return response()->json([
			'message' => 'Counted',
			'count' => $admin->articles()->count() ?? 0
		]);
	}
}
