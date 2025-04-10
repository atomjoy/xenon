<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectCollection;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProjectController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		Gate::authorize('viewAny', Project::class);

		$perpage = request()->integer('perpage', default: 6);

		return  new ProjectCollection(Project::latest('id')->paginate($perpage));
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
	public function store(StoreProjectRequest $request)
	{
		Gate::authorize('create', Project::class);

		$valid = $request->validated();

		$project = Project::create($valid);

		if ($request->file('image')) {
			$image = (new ImageManager(new Driver()))
				->read($request->file('image'))
				->toWebp();

			$path = 'projects/project-' . $project->id . '.webp';
			Storage::put($path, (string) $image);
			$valid['image'] = $path;
			$project->update($valid);
		}

		return response()->json([
			'message' => 'Created',
			'data' => $project,
		]);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Project $project)
	{
		Gate::authorize('view', $project);

		return $project;
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Project $project)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateProjectRequest $request, Project $project)
	{
		Gate::authorize('update', $project);

		$valid = $request->validated();

		$project->update($valid);

		if ($request->file('image')) {
			$image = (new ImageManager(new Driver()))
				->read($request->file('image'))
				->toWebp();

			$path = 'projects/project-' . $project->id . '.webp';
			Storage::put($path, (string) $image);
			$valid['image'] = $path;
			$project->update($valid);
		}

		return response()->json([
			'message' => 'Updated',
			'data' => $project,
		]);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Project $project)
	{
		Gate::authorize('delete', $project);

		try {
			if (Storage::exists($project->image)) {
				Storage::delete($project->image);
			}
		} catch (\Throwable $e) {
			report($e);
		}

		$project->delete();

		return response()->json(['message' => 'Deleted']);
	}

	/**
	 * Remove project image
	 *
	 * @param Project $project
	 * @return void
	 */
	function remove(Project $project)
	{
		Gate::authorize('update', $project);

		try {
			if (Storage::exists($project->image)) {
				Storage::delete($project->image);
				$project->image = null;
				$project->save();
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
