<?php

use App\Http\Controllers\Auth\ActivateController;
use App\Http\Controllers\Auth\AccountDeleteController;
use App\Http\Controllers\Auth\PasswordConfirmController;
use App\Http\Controllers\Auth\PasswordChangeController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\LoggedController;
use App\Http\Controllers\Auth\LocaleController;
use App\Http\Controllers\Auth\CsrfController;
use App\Http\Controllers\Auth\F2aController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\UploadAvatarController;
use App\Http\Controllers\Auth\EmailChangeController;
use App\Http\Controllers\Auth\EmailChangeConfirmController;
use App\Http\Controllers\Auth\EmailChangeRecoverController;
use App\Http\Controllers\Auth\NotificationsController;
use App\Http\Controllers\Auth\UserAccountController;
use App\Http\Controllers\Blog\CareerController;
use App\Http\Controllers\Blog\ContactController;
use App\Http\Controllers\Panel\CommentController;
use App\Http\Controllers\SubscriberController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Recovery email
Route::get('/change/email/recovery/{id}/{code}', [EmailChangeRecoverController::class, 'index'])->name('change.email.recovery');

// User routes
Route::prefix('web/api')->name('web.api')->middleware([
	'web',
	'locales'
])->group(function () {
	// Public
	Route::get('/activate/{id}/{code}', [ActivateController::class, 'index'])->name('activate');
	Route::post('/login', [LoginController::class, 'index'])->name('login');
	Route::post('/register', [RegisterController::class, 'index'])->name('register');
	Route::post('/password', [PasswordResetController::class, 'index'])->name('password');
	Route::post('/f2a', [F2aController::class, 'index'])->name('f2a');
	Route::get('/logout', [LogoutController::class, 'index'])->name('logout');
	Route::get('/logged', [LoggedController::class, 'index'])->name('logged');
	Route::get('/csrf', [CsrfController::class, 'index'])->name('csrf');
	Route::get('/locale/{locale}', [LocaleController::class, 'index'])->name('locale');

	// Subscribe
	Route::post('/subscribe', [SubscriberController::class, 'subscribe'])->name('subscribe.store');
	Route::get('/subscribe/confirm/{subscriber}', [SubscriberController::class, 'confirm'])->name('subscribe.confirm');
	Route::get('/subscribe/remove/{email}', [SubscriberController::class, 'unsubscribe'])->name('subscribe.remove');

	// Contact forms
	Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
	Route::post('/career', [CareerController::class, 'store'])->name('career.store');

	// Private user
	Route::middleware([
		'auth:web',
	])->group(function () {
		// 2FA auth on/off
		Route::post('/f2a/enable', [F2aController::class, 'enable'])->name('f2a.enable');
		Route::post('/f2a/disable', [F2aController::class, 'disable'])->name('f2a.disable');
		// Password
		Route::post('/password/change', [PasswordChangeController::class, 'index'])->name('change');
		Route::post('/password/confirm', [PasswordConfirmController::class, 'index'])->name('confirm');
		// Avatar
		Route::post('/upload/avatar', [UploadAvatarController::class, 'index'])->name('upload.avatar');
		Route::post('/remove/avatar', [UploadAvatarController::class, 'remove'])->name('remove.avatar');
		// Remove account
		Route::singleton('/account/delete', AccountDeleteController::class, ['except' => ['edit', 'show']]);
		// Change email
		Route::post('/change/email', [EmailChangeController::class, 'index'])->name('change.email');
		Route::get('/change/email/{id}/{code}', [EmailChangeConfirmController::class, 'index'])->name('change.email.confirm');
		// Notifications
		Route::get('/notifications/page/{page}', [NotificationsController::class, 'index'])->name('notifications.page');
		Route::get('/notifications/toggle/{id}', [NotificationsController::class, 'toggle'])->name('notifications.toggle');
		Route::get('/notifications/delete/{id}', [NotificationsController::class, 'delete'])->name('notifications.delete');
		Route::get('/notifications/readall', [NotificationsController::class, 'readall'])->name('notifications.readall');
		// Account update
		Route::post('/account/update', [UserAccountController::class, 'update'])->name('account.update');
		// Comments
		Route::resource('/comments', CommentController::class)->except(['create', 'edit']);
		Route::get('/comments/count/{user}', [CommentController::class, 'count'])->name('comments.count');

		// Only logged user
		Route::get('/only-user', function () {
			return response()->json([
				'message' => 'User logged.',
				'guard' => 'web',
				'user' => Auth::guard('web')->user(),
			]);
		});
	});
});
