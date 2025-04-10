<?php

namespace App\Http\Controllers;

use App\Models\Work;
use App\Http\Requests\StoreWorkRequest;
use App\Http\Requests\UpdateWorkRequest;
use App\Http\Resources\WorkCollection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class WorkController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		Gate::authorize('viewAny', Work::class);

		$perpage = request()->integer('perpage', default: 6);

		return  new WorkCollection(Work::latest('id')->paginate($perpage));
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
	public function store(StoreWorkRequest $request)
	{
		Gate::authorize('create', Work::class);

		$valid = $request->validated();

		$work = Work::create($valid);

		return response()->json([
			'message' => 'Created',
			'data' => $work,
		]);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Work $work)
	{
		Gate::authorize('view', $work);

		return $work;
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Work $work)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateWorkRequest $request, Work $work)
	{
		Gate::authorize('update', $work);

		$valid = $request->validated();

		$work->update($valid);

		return response()->json([
			'message' => 'Updated',
			'data' => $work,
		]);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Work $work)
	{
		Gate::authorize('delete', $work);

		$work->delete();

		return response()->json(['message' => 'Deleted']);
	}
}
