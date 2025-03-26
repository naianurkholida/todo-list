<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\ChecklistItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('jwt.auth')->group(function () {
    Route::get('checklists', [ChecklistController::class, 'index']);
    Route::post('checklists', [ChecklistController::class, 'store']);
    Route::delete('checklists/{id}', [ChecklistController::class, 'destroy']);

    Route::prefix('checklists/{checklistId}/item')->group(function () {
        Route::get('/', [ChecklistItemController::class, 'index']);
        Route::post('/', [ChecklistItemController::class, 'store']);
        Route::get('/{checklistItemId}', [ChecklistItemController::class, 'show']);
        Route::put('/{checklistItemId}', [ChecklistItemController::class, 'updateStatus']);
        Route::delete('/{checklistItemId}', [ChecklistItemController::class, 'destroy']);
        Route::put('/rename/{checklistItemId}', [ChecklistItemController::class, 'rename']);
    });
});
