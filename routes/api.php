<?php

use App\Http\Controllers\API\TestController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\EventController;
use App\Http\Controllers\APi\TicketController;
use App\Http\Controllers\API\TransactionController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/** 
 * Route::get('/user', function (Request $request) {
 * return $request->user();
 * })->middleware('auth:sanctum');
 */

// Public route
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::apiResource('test', TestController::class);
Route::get('event', [EventController::class, 'index']);
Route::get('event/{id}', [EventController::class, 'show']);
Route::get('ticket', [TicketController::class, 'index']);
Route::get('ticket/{id}', [TicketController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);

    // Admin route
    Route::middleware('role:admin')->group(function () {
        Route::post('admin/event', [EventController::class, 'store']);
        Route::patch('admin/event/{id}', [EventController::class, 'update']);
        Route::delete('admin/event/{id}', [EventController::class, 'destroy']);
        Route::post('admin/ticket', [TicketController::class, 'store']);
        Route::patch('admin/ticket/{id}', [TicketController::class, 'update']);
        Route::delete('admin/ticket/{id}', [TicketController::class, 'destroy']);
        Route::get('admin/user', [UserController::class, 'index']);
        Route::post('admin/user', [UserController::class, 'store']);
        Route::get('admin/user/{id}', [UserController::class, 'show']);
        Route::patch('admin/user/{id}', [UserController::class, 'update']);
        Route::delete('admin/user/{id}', [UserController::class, 'destroy']);
        Route::get('admin/transaction/{id}', [TransactionController::class, 'show']);
        Route::get('admin/transaction', [TransactionController::class, 'indexAdmin']);
        Route::patch('admin/transaction/{id}', [TransactionController::class, 'update']);
        Route::delete('admin/transaction/{id}', [TransactionController::class, 'destroy']);
    });

    // User route
    Route::middleware('role:user')->group(function () {
        Route::post('transaction', [TransactionController::class, 'store']);
        Route::get('transaction', [TransactionController::class, 'indexUser']);
        Route::get('transaction/{id}', [TransactionController::class, 'show']);
        Route::get('user', [UserController::class, 'indexUser']);
    });
});
