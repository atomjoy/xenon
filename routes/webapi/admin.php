<?php

use App\Http\Controllers\Auth\Admin\F2aController as AdminF2aController;
use App\Http\Controllers\Auth\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Auth\Admin\LogoutController as AdminLogoutController;
use App\Http\Controllers\Auth\Admin\LoggedController as AdminLoggedController;
use App\Http\Controllers\Auth\Admin\PasswordChangeController as AdminPasswordChangeController;
use App\Http\Controllers\Auth\Admin\PasswordResetController as AdminPasswordResetController;
use App\Http\Controllers\Auth\Admin\UploadAvatarController as AdminUploadAvatarController;
use App\Http\Controllers\Auth\Admin\NotificationsController as AdminNotificationsController;
use App\Http\Controllers\Auth\Admin\AdminAccountController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleMediaController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\WorkController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Admin routes
Route::prefix('web/api/admin')->name('web.api.admin')->middleware([
	'web',
	'locales'
])->group(function () {
	// Public
	Route::post('/login', [AdminLoginController::class, 'index'])->name('login');
	Route::post('/password', [AdminPasswordResetController::class, 'index'])->name('password');
	Route::get('/logout', [AdminLogoutController::class, 'index'])->name('logout');
	Route::get('/logged', [AdminLoggedController::class, 'index'])->name('logged');
	Route::post('/f2a', [AdminF2aController::class, 'index'])->name('f2a');

	// Private admin guard
	Route::middleware([
		'auth:admin',
		'role:writer|worker|admin|super_admin,admin',
	])->group(function () {
		// All logged with admin guard
		Route::post('/password/change', [AdminPasswordChangeController::class, 'index'])->name('change');
		Route::post('/f2a/enable', [AdminF2aController::class, 'enable'])->name('f2a.enable');
		Route::post('/f2a/disable', [AdminF2aController::class, 'disable'])->name('f2a.disable');
		// Avatar
		Route::post('/upload/avatar', [AdminUploadAvatarController::class, 'index'])->name('upload.avatar');
		Route::post('/remove/avatar', [AdminUploadAvatarController::class, 'remove'])->name('remove.avatar');
		// Account update
		Route::post('/account/update', [AdminAccountController::class, 'update'])->name('account.update');
		// Notifications
		Route::get('/notifications/page/{page}', [AdminNotificationsController::class, 'index'])->name('notifications.page');
		Route::get('/notifications/toggle/{id}', [AdminNotificationsController::class, 'toggle'])->name('notifications.toggle');
		Route::get('/notifications/delete/{id}', [AdminNotificationsController::class, 'delete'])->name('notifications.delete');
		Route::get('/notifications/readall', [AdminNotificationsController::class, 'readall'])->name('notifications.readall');

		// Blog
		Route::resource('tags', TagController::class)->except(['create', 'edit']);
		Route::resource('comments', CommentController::class)->except(['create', 'edit']);
		Route::get('comments/count/{admin}', [CommentController::class, 'count'])->name('comments.count');
		Route::resource('articles', ArticleController::class)->except(['create', 'edit']);
		Route::get('articles/remove/{article}', [ArticleController::class, 'remove']);
		Route::get('articles/count/{admin}', [ArticleController::class, 'count'])->name('article.count');
		// Route::resource('', Controller::class);

		// Media
		Route::resource('articlemedia', ArticleMediaController::class)->except(['create', 'edit']);
		Route::get('articlemedia/remove/{articlemedia}', [ArticleMediaController::class, 'remove']);

		Route::get('/only-writer', function () {
			return response()->json([
				'message' => 'User logged.',
				'guard' => 'admin',
				'user' => Auth::guard('admin')->user(),
			]);
		})->middleware('throttle:20,1'); // 20/1min
	});

	Route::middleware([
		'auth:admin',
		'role:worker|admin|super_admin,admin',
	])->group(function () {
		// Only logged worker, admin
		Route::resource('categories', CategoryController::class)->except(['create', 'edit']);
		Route::get('categories/remove/{category}', [CategoryController::class, 'remove']);
		Route::get('categories/get/all', [CategoryController::class, 'allCategories']);
		Route::get('categories/get/main', [CategoryController::class, 'mainCategories']);
		// Subscribe
		Route::resource('subscribers', SubscriberController::class)->except(['create', 'edit']);
		Route::get('subscribers/export/csv', [SubscriberController::class, 'csv']);
		// Contact
		Route::resource('contacts', ContactController::class)->except(['create', 'edit', 'store']);
		Route::get('contacts/export/file', [ContactController::class, 'download']);
		// Services
		Route::resource('services', ServiceController::class)->except(['create', 'edit']);
		Route::get('services/remove/{service}', [ServiceController::class, 'remove']);
		// Project
		Route::resource('projects', ProjectController::class)->except(['create', 'edit']);
		Route::get('projects/remove/{project}', [ProjectController::class, 'remove']);
		// Employee
		Route::resource('employees', EmployeeController::class)->except(['create', 'edit']);
		Route::get('employees/remove/{employee}', [EmployeeController::class, 'remove']);
		// Reference
		Route::resource('references', ReferenceController::class)->except(['create', 'edit']);
		Route::get('references/remove/{reference}', [ReferenceController::class, 'remove']);
		// Question
		Route::resource('questions', QuestionController::class)->except(['create', 'edit']);
		// Work
		Route::resource('works', WorkController::class)->except(['create', 'edit']);

		Route::get('/only-worker', function () {
			return response()->json([
				'message' => 'User logged.',
				'guard' => 'admin',
				'user' => Auth::guard('admin')->user(),
			]);
		})->middleware('throttle:20,1'); // 20/1min
	});

	Route::middleware([
		'auth:admin',
		'role:admin|super_admin,admin',
	])->group(function () {
		// Only logged admin
		// Route::resource('users', UserController::class);

		Route::get('/only-admin', function () {
			return response()->json([
				'message' => 'User logged.',
				'guard' => 'admin',
				'user' => Auth::guard('admin')->user(),
			]);
		})->middleware('throttle:20,1'); // 20/1min
	});

	Route::middleware([
		'auth:admin',
		'role:super_admin,admin',
	])->group(function () {
		// Only logged super_admin
		// Route::resource('roles', RoleController::class);
		// Route::resource('admins', AdminController::class);
		// Route::resource('', Controller::class);

		Route::get('/only-super-admin', function () {
			return response()->json([
				'message' => 'Authenticated.',
				'guard' => 'admin',
				'user' => Auth::guard('admin')->user(),
			]);
		})->middleware('throttle:20,1'); // 20/1min
	});
});
