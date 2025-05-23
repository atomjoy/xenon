<?php

namespace App\Http\Middleware;

use App\Models\Article;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
	/**
	 * The root template that's loaded on the first page visit.
	 *
	 * @see https://inertiajs.com/server-side-setup#root-template
	 *
	 * @var string
	 */
	protected $rootView = 'app';

	/**
	 * Determines the current asset version.
	 *
	 * @see https://inertiajs.com/asset-versioning
	 */
	public function version(Request $request): ?string
	{
		return parent::version($request);
	}

	/**
	 * Define the props that are shared by default.
	 *
	 * @return array<string, mixed>
	 */
	public function share(Request $request)
	{
		return [
			...parent::share($request),
			'auth' => [
				'user' => $request->user(),
				'permissions' => [
					'post' => [
						'create' => $request->user()->can('create', Article::class),
					],
				],
			],
			'name' => config('app.name'),
			'location' => $request->url(),
			'sidebarOpen' => ! $request->hasCookie('sidebar_state') || $request->cookie('sidebar_state') === 'true',
		];
	}
}
