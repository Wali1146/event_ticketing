<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/** 
 * Route::get('/user', function (Request $request) {
 * return $request->user();
 * })->middleware('auth:sanctum');
*/
Route::apiResource('/user', UserController::class);
Route::apiResource('/event', EventController::class);
Route::apiResource('/ticket', TicketController::class);
Route::apiResource('/transaction', TransactionController::class);