<?php

namespace App\Http\Controllers\Blog;

use App\Models\Project;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectCollection;

class ProjectController extends Controller
{
	/**
	 * Get items.
	 */
	public function index()
	{
		$perpage = request()->integer('perpage', default: 6);

		return new ProjectCollection(Project::latest('id')->paginate($perpage));
	}

	/**
	 * Get item.
	 */
	public function show(Project $project)
	{
		return $project;
	}
}
