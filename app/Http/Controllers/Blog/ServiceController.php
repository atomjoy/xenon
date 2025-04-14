<?php

namespace App\Http\Controllers\Blog;

use App\Models\Service;
use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceCollection;

class ServiceController extends Controller
{
	/**
	 * Get items.
	 */
	public function index()
	{
		$perpage = request()->integer('perpage', default: 6);

		return new ServiceCollection(Service::latest('id')->paginate($perpage));
	}

	/**
	 * Get item.
	 */
	public function show(Service $service)
	{
		return $service;
	}
}
