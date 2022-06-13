<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\StudentController;
use \App\Http\Controllers\ProjectController;
use \App\Http\Controllers\GroupController;

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

Route::prefix('/v1')->name('v1.')->group(function () {
    Route::prefix('/students')->name('students.')->group(function () {
        Route::get('/', [StudentController::class, 'index'])->name('list');
        Route::get('/delete/{id}', [StudentController::class, 'destroy'])->name('destroy');
        Route::post('/create', [StudentController::class, 'create'])->name('create');
    });
    Route::prefix('/projects')->name('projects.')->group(function () {
        Route::get('/', [ProjectController::class, 'index'])->name('list');
        Route::get('/delete/{id}', [ProjectController::class, 'destroy'])->name('destroy');
        Route::post('/create', [ProjectController::class, 'create'])->name('create');
    });
    Route::prefix('/groups')->name('groups.')->group(function () {
        Route::get('/', [GroupController::class, 'index'])->name('list');
        Route::get('/delete/{id}', [GroupController::class, 'destroy'])->name('destroy');
        Route::post('/create', [GroupController::class, 'create'])->name('create');
    });
});
