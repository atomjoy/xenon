# Ftp Storage Laravel

Dtorage docs <https://laravel.com/docs/12.x/filesystem#sftp-driver-configuration>

```sh
composer require league/flysystem-ftp "^3.0"
```

## Provider

```php
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Ftp storage class
 *
 * https://laravel.com/docs/12.x/filesystem#sftp-driver-configuration
 * composer require league/flysystem-ftp "^3.0"
 */
class StorageFtpProvider extends ServiceProvider
{
 /**
  * Register services.
  */
 public function register(): void
 {
	// Change storage disk to ftp (or in .env FILESYSTEM_DISK=ftp)
	if (
		config('filesystems.default') == 'local' ||
		config('filesystems.default') == 'public'
	) {
		config(['filesystems.default' => 'ftp']);
	}

	// Add storage ftp
	$this->app->config['filesystems.disks.ftp'] = [
		'driver' => 'ftp',
		'username' => env('FTP_USERNAME', 'laravel'),
		'password' => env('FTP_PASSWORD', 'password'),
		'host' => env('FTP_HOST', 'localhost'),
		'port' => (int) env('FTP_PORT', 21),
		'ssl' => env('FTP_SSL', true),

		// Optional FTP Settings...
		// 'root' => env('FTP_ROOT'),
		// 'passive' => true,
		// 'timeout' => 30,
	];
	}

	/**
	 * Bootstrap services.
	*/
	public function boot(): void
	{
		//
	}
}
```

## Save images with Storage

```php
// Save files
if($request->hasFile('image')){
	$path = Storage::putFile('photos', new File('/path/to/photo'));
	$path = Storage::putFileAs('photos', new File('/path/to/photo'), 'photo.webp');

	$path = $request->file('image')->store('media/avatars');
	$path = Storage::putFileAs('media/avatars', $request->file('image'), 'photo.webp');
}

// Url with storage/ or https://
$url = Storage::url('media/avatars/photo.webp');

// Temp url
$imgurl = Storage::temporaryUrl('media/avatars/photo.webp', now()->addMinutes(5));

// Base64
<img src="data:image/jpeg;base64,{{
	base64_encode(Storage::get('media/avatars/photo.webp'))
}}" alt="Example image">
```

## Display images with Storage

```php
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

// Js onerror url fetch
Route::get('/img/url', function () {
	try {
		$path = request('path');
		if (Storage::exists($path)) {
			return Storage::url($path);
		}
	} catch (\Throwable $e) {
		return '/default/avatar.webp';
	}
});

// Image response
Route::get('/img/show', function () {
	try {
		$path = request('path');
		if (Storage::exists($path)) {
			return Storage::response($path);
		}
	} catch (\Throwable $e) {
		return response()->file(public_path('/default/avatar.webp'));
	}
});

// Use image response
Route::get('/img', function () {
	return '<img src="/img/show?path=avatars/1.webp">';
});
```

## Custom driver

```php
<?php

use Illuminate\Support\Facades\Storage;

try {
	$ftp = Storage::createFtpDriver([
		'driver'   => 'ftp',
		'host'     => $web->server_ip,
		'port'     => $web->server_port,
		'username' => $web->server_username,
		'password' => $web->server_password,
		'passive'  => false,
		'ignorePassiveAddress' => true,
	]);

	$ftp->put(
		'/default/welcome.webp',
		Storage::disk('local')->get('sample.webp')
	);

} catch (\Throwable $e) {
	report($e->getMessage());
	return 'Something went wrong with the ftp connection.';
}
```

## Links

```sh
# Storage
https://laravel.com/docs/12.x/filesystem#sftp-driver-configuration
```
