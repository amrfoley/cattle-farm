<?php

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

use App\Http\Controllers\PastureController;
use App\Http\Controllers\CattleController;
// use App\Http\Controllers\CattlePastureController;

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {

    Route::resource('pastures', PastureController::class);
    Route::resource('cattles', CattleController::class);
    // Route::resource('reports', CattlePastureController::class);
});
