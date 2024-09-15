<?php

use App\Http\Controllers\OptionController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [UserController::class, 'login'])->name('user.login');
Route::post('/register', [UserController::class, 'store'])->name('user.store');

Route::middleware(['auth:sanctum', 'is_admin'])->group(function () {
    Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');
    Route::delete('/questions/{id}', [QuestionController::class, 'destroy'])->name('questions.destroy');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/score/store', [ScoreController::class, 'store'])->name('score.store');
    Route::get('/score/{uid}', [ScoreController::class, 'show'])->name('score.show');
});

Route::get('/questions', [QuestionController::class, 'index'])->name('questions');
Route::get('/questions/show', [QuestionController::class, 'show'])->name('questions.show');

Route::get('/options/{id}', [OptionController::class, 'index'])->name('options');
Route::post('/options/{qid}/{oid}', [OptionController::class, 'verify'])->name('options.store');
