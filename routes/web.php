<?php

use App\Http\Controllers\PollController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get('/polls', [PollController::class, 'index'])->name('polls.index');
    Route::get('/polls/create', [PollController::class, 'create'])->name('polls.create');
    Route::get('/polls/edit/{poll}', [PollController::class, 'edit'])->name('polls.edit');
    Route::post('/polls', [PollController::class, 'store']);
    Route::patch('/polls/{poll}', [PollController::class, 'update']);

    Route::get('userinterface/edit', [\App\Http\Controllers\UserInterfaceController::class, 'edit'])->name('interface.edit');
    Route::post('userinterface', [\App\Http\Controllers\UserInterfaceController::class, 'update']);

    Route::get('pollvoting', [\App\Http\Controllers\UserInterfaceController::class, 'index'])->name('poll_voting');
    Route::post('polls/vote/{poll_option}', [\App\Http\Controllers\PollOptionController::class, "vote"]);

});
