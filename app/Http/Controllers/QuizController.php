<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuizResource;
use App\Models\Quiz;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    use ApiResponse;

    public function index(Request $request)
    {
        return $this->successResponse(Quiz::all(), 'Display all active quizzes');
    }

    public function show(Quiz $quiz)
    {
        // Eager loading for performance
        $quiz->load(['questions.options', 'user']);

        return $this->successResponse(new QuizResource($quiz), 'Display a specific quiz');
    }
}
