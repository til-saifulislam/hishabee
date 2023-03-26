<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/saiful', function () {
    return "Hello";
});

Route::resource('/expenditure-segment', App\Http\Controllers\API\ExpenditureSegmentController::class)->only(['index', 'store', 'show', 'edit', 'update', 'destroy']);
Route::resource('/expenditure-list', App\Http\Controllers\API\ExpenditureListController::class)->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);