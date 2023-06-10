<?php

use App\Http\Rest\NoteApiController;
use App\Http\Rest\ProjectApiController;
use App\Http\Rest\TaskApiController;
use App\Http\Rest\UserApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', function (Request $request) {
        $request->user()->currentAccessToken()->delete();
        return ['message' => 'Logged out'];
    });

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/check-auth', function () {
        return response()->json(auth()->check());
    });

    Route::group(['prefix' => 'projects'], function () {
        Route::get('/', [ProjectApiController::class, 'index']);
        Route::post('/', [ProjectApiController::class, 'store']);
        Route::get('/with-tasks', [ProjectApiController::class, 'projectWithTasks']);
        Route::get('/{project}', [ProjectApiController::class, 'show']);
        Route::put('/{project}', [ProjectApiController::class, 'edit']);
    });

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserApiController::class, 'index']);
    });

    Route::group(['prefix' => 'tasks'], function () {
        Route::post('/', [TaskApiController::class, 'store']);
        Route::get('/after-deadline', [TaskApiController::class, 'afterDeadlineTasks']);
        Route::get('/before-deadline', [TaskApiController::class, 'beforeDeadlineTasks']);
        Route::get('/{task}', [TaskApiController::class, 'show']);
        Route::put('/{task}', [TaskApiController::class, 'update']);
        Route::delete('/{task}', [TaskApiController::class, 'delete']);
    });

    Route::group(['prefix' => 'notes'], function () {
        Route::post('/', [NoteApiController::class, 'store']);
        Route::get('/{note}', [NoteApiController::class, 'show']);
        Route::put('/{note}', [NoteApiController::class, 'update']);
        Route::delete('/{note}', [NoteApiController::class, 'delete']);
    });
});

Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (auth()->attempt($credentials)) {
        $user = $request->user();
        $token = $user->createToken('authToken')->plainTextToken;
        return ['token' => $token];
    }

    return response(['message' => 'Invalid credentials'], 401);
});
