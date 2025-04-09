<?php

use App\Http\Resources\CatResource;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Blog\CategoryController;

Route::get('/test', function () {
	// Works with resource
	// return new CategoryResource(Category::find(7));
	return new CatResource(Category::find(7));

	// return Category::with(['articles' => function ($q) {
	// 	$q->select('title')->where('published_at', '<', now())->paginate(1);
	// }])->first();

	// return Category::find(7)->articles()->paginate(2);

	// Works (for single model without paginate)
	// return CatResource::collection(Category::latest('id')->get());

	// With paginate() you need use $this->articles()->offset(request('offset'))->take(3) in resource with $request->query('offset')
	// return CategoryResource::collection(Category::latest('id')->paginate(2));
});
