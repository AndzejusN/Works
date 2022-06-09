<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\StudentController;

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
        Route::post('/store/{id?}', [StudentController::class, 'store'])->name('store');
    });
});
