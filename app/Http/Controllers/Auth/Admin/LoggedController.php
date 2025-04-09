<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Events\LoggedUser;
use App\Events\LoggedUserError;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoggedController extends Controller
{
    function index(Request $request)
    {
        Auth::shouldUse('admin'); // Default guard

        if (Auth::check()) {
            LoggedUser::dispatch(Auth::user());

            return response()->json([
                'message' => __('logged.authenticated'),
                'guard' => 'admin',
                'user' => Auth::user()->fresh(),
            ], 200);
        } else {
            LoggedUserError::dispatch();

            return response()->json([
                'message' => __('logged.unauthenticated'),
                'guard' => 'admin',
                'user' => null
            ], 422);
        }
    }
}
