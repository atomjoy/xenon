<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Http\Resources\ServiceCollection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ServiceController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		Gate::authorize('viewAny', Service::class);

		$perpage = request()->integer('perpage', default: 6);

		return  new ServiceCollection(Service::latest('id')->paginate($perpage));
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreServiceRequest $request)
	{
		Gate::authorize('create', Service::class);

		$valid = $request->validated();

		$service = Service::create($valid);

		if ($request->file('image')) {
			$image = (new ImageManager(new Driver()))
				->read($request->file('image'))
				->toWebp();

			$path = 'services/service-' . $service->id . '.webp';
			Storage::put($path, (string) $image);
			$valid['image'] = $path;
			$service->update($valid);
		}

		return response()->json([
			'message' => 'Created',
			'data' => $service,
		]);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Service $service)
	{
		Gate::authorize('view', $service);

		return $service;
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Service $service)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateServiceRequest $request, Service $service)
	{
		Gate::authorize('update', $service);

		$valid = $request->validated();

		$service->update($valid);

		if ($request->file('image')) {
			$image = (new ImageManager(new Driver()))
				->read($request->file('image'))
				->toWebp();

			$path = 'services/service-' . $service->id . '.webp';
			Storage::put($path, (string) $image);
			$valid['image'] = $path;
			$service->update($valid);
		}

		return response()->json([
			'message' => 'Updated',
			'data' => $service,
		]);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Service $service)
	{
		Gate::authorize('delete', $service);

		$service->delete();

		return response()->json(['message' => 'Deleted']);
	}

	/**
	 * Remove service image
	 *
	 * @param Service $service
	 * @return void
	 */
	function remove(Service $service)
	{
		Gate::authorize('update', $service);

		try {
			if (Storage::exists($service->image)) {
				Storage::delete($service->image);
				$service->image = null;
				$service->save();
			}

			return response()->json([
				'message' => __('remove.image.success'),
			], 200);
		} catch (\Throwable $e) {
			report($e);
			throw new JsonException(__('remove.image.error'), 422);
		}
	}
}
