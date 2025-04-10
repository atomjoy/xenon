<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Http\Resources\QuestionCollection;
use Illuminate\Support\Facades\Gate;

class QuestionController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		Gate::authorize('viewAny', Question::class);

		$perpage = request()->integer('perpage', default: 6);

		return  new QuestionCollection(Question::latest('id')->paginate($perpage));
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
	public function store(StoreQuestionRequest $request)
	{
		Gate::authorize('create', Question::class);

		$valid = $request->validated();

		$question = Question::create($valid);

		return response()->json([
			'message' => 'Created',
			'data' => $question,
		]);
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Question $question)
	{
		Gate::authorize('view', $question);

		return $question;
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Question $question)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateQuestionRequest $request, Question $question)
	{
		Gate::authorize('update', $question);

		$valid = $request->validated();

		$question->update($valid);

		return response()->json([
			'message' => 'Updated',
			'data' => $question,
		]);
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Question $question)
	{
		Gate::authorize('delete', $question);

		$question->delete();

		return response()->json(['message' => 'Deleted']);
	}
}
