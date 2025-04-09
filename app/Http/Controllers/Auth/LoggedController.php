<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Events\LoggedUser;
use App\Events\LoggedUserError;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoggedController extends Controller
{
    function index(Request $request)
    {
        Auth::shouldUse('web'); // Default guard

        if (Auth::check()) {
            LoggedUser::dispatch(Auth::user());

            return response()->json([
                'message' => __('logged.authenticated'),
                'guard' => 'web',
                'user' => Auth::user()->fresh(),
            ], 200);
        } else {
            LoggedUserError::dispatch();

            return response()->json([
                'message' => __('logged.unauthenticated'),
                'guard' => 'web',
                'user' => null,
            ], 422);
        }
    }
}
