<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\ProfileController;

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

Route::post('login', [AuthenticatedSessionController::class, 'store']);
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth:sanctum');
Route::post('register', [RegisteredUserController::class, 'store']);
Route::get('profile', [ProfileController::class, 'show'])->middleware('auth:sanctum');
Route::post('profile', [ProfileController::class, 'update'])->middleware('auth:sanctum');
Route::post('reset-password', [NewPasswordController::class, 'store']);
Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])->name('verification.verify');
Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])->name('verification.notice');
Route::post('verify-email', [EmailVerificationNotificationController::class, 'store'])->name('verification.send');
Route::get('dashboard', function () {
    // Return some data related to the dashboard
})->middleware('auth:sanctum');
// Other routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::apiResource('events', EventController::class);
    Route::apiResource('tickets', TicketController::class);
    Route::apiResource('transactions', TransactionController::class);
});
