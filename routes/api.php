<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuizSubmissionController;
use App\Http\Middleware\EnsureQuizActive;

Route::get('quizzes', [QuizController::class, 'index']);

Route::middleware([EnsureQuizActive::class])->group(function () {
    Route::get('quizzes/{quiz}', [QuizController::class, 'show']);
    Route::post('quizzes/{quiz}/submissions', [QuizSubmissionController::class, 'submit']);
});