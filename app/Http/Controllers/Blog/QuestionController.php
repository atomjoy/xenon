<?php

namespace App\Http\Controllers\Blog;

use App\Models\Question;
use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionCollection;

class QuestionController extends Controller
{
	/**
	 * Get categories.
	 */
	public function index()
	{
		$perpage = request()->integer('perpage', default: 6);

		return new QuestionCollection(Question::latest('id')->paginate($perpage));
	}

	/**
	 * Get question.
	 */
	public function show(Question $question)
	{
		return $question;
	}
}
