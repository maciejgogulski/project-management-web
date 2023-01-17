<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::name('users.')->prefix('users')->group( function () {
        Route::get('', [UserController::class, 'index'])
            ->name('index')
            ->middleware(['permission:users.index']);
    });

    Route::resource('tasks', TaskController::class)->only(
        ['index', 'create', 'edit', 'show']
    );

    Route::resource('projects', ProjectController::class)->only([
        'index', 'create', 'edit', 'show']
    );

    Route::get('async/users', [UserController::class, 'async'])
    ->name('async.users');

    Route::get('async/projects', [ProjectController::class, 'async'])
        ->name('async.projects');
});
