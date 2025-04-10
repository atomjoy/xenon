<?php

namespace App\Http\Controllers;

use App\Models\Reference;
use App\Http\Requests\StoreReferenceRequest;
use App\Http\Requests\UpdateReferenceRequest;
use App\Http\Resources\ReferenceCollection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ReferenceController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		Gate::authorize('viewAny', Reference::class);

		$perpage = request()->integer('perpage', default: 6);

		return  new ReferenceCollection(Reference::latest('id')->paginate($perpage));
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
	public function store(StoreReferenceRequest $request)
	{
		Gate::authorize('create', Reference::class);

		$valid = $request->validated();

		$valid['vote'] = round($valid['vote'] * 2) / 2;

		$reference = Reference::create($valid);

		if ($request->file('image')) {
			$image = (new ImageManager(new Driver()))
				->read($request->file('image'))
				->resize(1024, 1024)
				->toWebp();

			$path = 'references/reference-' . $reference->id . '.webp';
			Storage::put($path, (string) $image);
			$valid['image'] = $path;
			$reference->update($valid);
		}

		return response()->json([
			'message' => 'Created',
			'data' => $reference,
		]);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Reference $reference)
	{
		Gate::authorize('view', $reference);

		return $reference;
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Reference $reference)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateReferenceRequest $request, Reference $reference)
	{
		Gate::authorize('update', $reference);

		$valid = $request->validated();

		$valid['vote'] = round($valid['vote'] * 2) / 2;

		$reference->update($valid);

		if ($request->file('image')) {
			$image = (new ImageManager(new Driver()))
				->read($request->file('image'))
				->resize(1024, 1024)
				->toWebp();

			$path = 'references/reference-' . $reference->id . '.webp';
			Storage::put($path, (string) $image);
			$valid['image'] = $path;
			$reference->update($valid);
		}

		return response()->json([
			'message' => 'Updated',
			'data' => $reference,
		]);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Reference $reference)
	{
		Gate::authorize('delete', $reference);

		try {
			if (Storage::exists($reference->image)) {
				Storage::delete($reference->image);
			}
		} catch (\Throwable $e) {
			report($e);
		}

		$reference->delete();

		return response()->json(['message' => 'Deleted']);
	}

	/**
	 * Remove reference image
	 *
	 * @param Reference $reference
	 * @return void
	 */
	function remove(Reference $reference)
	{
		Gate::authorize('update', $reference);

		try {
			if (Storage::exists($reference->image)) {
				Storage::delete($reference->image);
				$reference->image = null;
				$reference->save();
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
