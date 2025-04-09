<?php

use Illuminate\Support\Facades\Route;

// Public
include 'webapi/blog.php';

// Import web.api routes
include 'webapi/admin.php';
include 'webapi/user.php';
include 'storage/img.php';
include 'storage/notifications.php';
// Samples
include 'sample/striptags.php';
include 'sample/article.php';
include 'sample/test.php';

// Vue routes
Route::get('/', function () {
	return view('vue');
});

// Vue catch all
if (!app()->runningUnitTests()) {
	Route::fallback(function () {
		return view('vue');
	});
}
