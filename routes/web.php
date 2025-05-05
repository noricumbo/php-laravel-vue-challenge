<?php

use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Home');
});

// Users routes
Route::resource('users', UserController::class);

// Teams routes
Route::resource('teams', TeamController::class);
Route::get('teams-select-members', [TeamController::class, 'selectMembers']);
Route::post('teams-save-members', [TeamController::class, 'saveMembers']);