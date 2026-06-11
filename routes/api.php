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
        Route::put('admin/event/{id}', [EventController::class, 'update']);
        Route::delete('admin/event/{id}', [EventController::class, 'destroy']);
        Route::post('admin/ticket', [TicketController::class, 'store']);
        Route::put('admin/ticket/{id}', [TicketController::class, 'update']);
        Route::delete('admin/ticket/{id}', [TicketController::class, 'destroy']);
        Route::get('admin/user', [UserController::class, 'index']);
        Route::post('admin/user', [UserController::class, 'store']);
        Route::get('admin/user/{id}', [UserController::class, 'show']);
        Route::put('admin/user/{id}', [UserController::class, 'update']);
        Route::delete('admin/user/{id}', [UserController::class, 'destroy']);
        Route::get('admin/transaction', [TransactionController::class, 'index']);
    });

    // User route
    Route::middleware('role:user')->group(function () {
        Route::get('transaction', [TransactionController::class, 'indexUser']);
        Route::post('transaction', [TransactionController::class, 'store']);
        Route::get('transaction/{id}', [TransactionController::class, 'show']);
        Route::put('transaction/{id}', [TransactionController::class, 'update']);
        Route::delete('transaction/{id}', [TransactionController::class, 'destroy']);
        Route::get('user', [UserController::class, 'indexUser']);
    });
});

// Route::get('user', [UserController::class, 'index']);
// Route::post('user', [UserController::class, 'store']);
// Route::get('user/{id}', [UserController::class, 'show']);/
// Route::put('user/{id}', [UserController::class, 'update']);
// Route::delete('user/{id}', [UserController::class, 'destroy']);

// Route::get('event', [EventController::class, 'index']);
// Route::post('event', [EventController::class, 'store']);
// Route::get('event/{id}', [EventController::class, 'show']);
// Route::put('event/{id}', [EventController::class, 'update']);
// Route::delete('event/{id}', [EventController::class, 'destroy']);

// Route::get('ticket', [TicketController::class, 'index']);
// Route::post('ticket', [TicketController::class, 'store']);
// Route::get('ticket/{id}', [TicketController::class, 'show']);
// Route::put('ticket/{id}', [TicketController::class, 'update']);
// Route::delete('ticket/{id}', [TicketController::class, 'destroy']);

// Route::get('transaction', [TransactionController::class, 'index']);
// Route::post('transaction', [TransactionController::class, 'store']);
// Route::get('transaction/{id}', [TransactionController::class, 'show']);
// Route::put('transaction/{id}', [TransactionController::class, 'update']);
// Route::delete('transaction/{id}', [TransactionController::class, 'destroy']);