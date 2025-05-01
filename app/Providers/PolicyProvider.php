<?php

namespace App\Providers;

use App\Models\Web\Subscriber;
use App\Policies\Web\SubscriberPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class PolicyProvider extends ServiceProvider
{
	/**
	 * Register services.
	 */
	public function register(): void
	{
		//
	}

	/**
	 * Bootstrap services.
	 */
	public function boot(): void
	{
		// Register Policy custom model locations
		// Gate::policy(Subscriber::class, SubscriberPolicy::class);
	}
}
