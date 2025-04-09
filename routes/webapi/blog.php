<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Blog\ArticleController;
use App\Http\Controllers\Blog\CategoryController;
use App\Http\Controllers\Blog\TagController;
use App\Http\Controllers\Blog\CommentController;

// Blog
Route::prefix('web/api')->name('web.api')->middleware([
	'web',
	'locales'
])->group(function () {
	Route::get('/blog/categories', [CategoryController::class, 'index'])->name('blog.categories');
	Route::get('/blog/categories/{category:slug}', [CategoryController::class, 'show'])->name('blog.category');

	Route::get('/blog/articles', [ArticleController::class, 'index'])->name('blog.articles');
	Route::get('/blog/articles/{article:slug}', [ArticleController::class, 'show'])->name('blog.article');

	Route::get('/blog/tags/{tag:slug}', [TagController::class, 'show'])->name('blog.tag');

	Route::get('/blog/comments/{article}', [CommentController::class, 'index'])->name('blog.comments');
	Route::get('/blog/comment/{comment}', [CommentController::class, 'show'])->name('blog.comment');

	// Logged users only
	Route::middleware([
		'auth:web,admin',
	])->group(function () {
		Route::post('/blog/comments/{article}', [CommentController::class, 'store'])->name('blog.comments.store');
	});
});
