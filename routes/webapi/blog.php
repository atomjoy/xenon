<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Blog\ArticleController;
use App\Http\Controllers\Blog\CareerController;
use App\Http\Controllers\Blog\CategoryController;
use App\Http\Controllers\Blog\TagController;
use App\Http\Controllers\Blog\TeamController;
use App\Http\Controllers\Blog\CommentController;
use App\Http\Controllers\Blog\ReferenceController;
use App\Http\Controllers\Blog\QuestionController;
use App\Http\Controllers\Blog\ServiceController;
use App\Http\Controllers\Blog\ProjectController;

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

	Route::get('/blog/references', [ReferenceController::class, 'index'])->name('references.index');
	Route::get('/blog/references/{reference}', [ReferenceController::class, 'show'])->name('references.show');

	Route::get('/blog/questions', [QuestionController::class, 'index'])->name('questions.index');
	Route::get('/blog/questions/{question}', [QuestionController::class, 'show'])->name('questions.show');

	Route::get('/blog/careers', [CareerController::class, 'index'])->name('careers.index');
	Route::get('/blog/careers/{work}', [CareerController::class, 'show'])->name('careers.show');

	Route::get('/blog/teams', [TeamController::class, 'index'])->name('teams.index');
	Route::get('/blog/teams/{employee}', [TeamController::class, 'show'])->name('teams.show');

	Route::get('/blog/services', [ServiceController::class, 'index'])->name('services.index');
	Route::get('/blog/services/{service}', [ServiceController::class, 'show'])->name('services.show');

	Route::get('/blog/projects', [ProjectController::class, 'index'])->name('projects.index');
	Route::get('/blog/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');

	// Logged users only
	Route::middleware([
		'auth:web,admin',
	])->group(function () {
		Route::post('/blog/comments/{article}', [CommentController::class, 'store'])->name('blog.comments.store');
	});
});
