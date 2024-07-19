<?php

use App\Http\Controllers\FeedbackController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\RegisterController;

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



Route::controller(RegisterController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});



Route::middleware('auth:sanctum')->group( function () {
    Route::get('/logout', [RegisterController::class, 'logout']);
    Route::get('/user', [RegisterController::class, 'user']);

    // Feedback

    Route::post('/save-feedback', [FeedbackController::class, 'saveFeedback'])->name('saveFeedback');
    Route::get('/get-all-feedback', [FeedbackController::class, 'getAllFeedback'])->name('getAllFeedback');
});
