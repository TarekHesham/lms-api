<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmitQuizRequest;
use App\Http\Resources\QuizSubmissionResource;
use App\Models\Quiz;
use App\Services\QuizSubmissionService;
use App\Traits\ApiResponse;

class QuizSubmissionController extends Controller
{
    use ApiResponse;

    public function __construct(
        protected QuizSubmissionService $service
    ) {}

    public function submit(SubmitQuizRequest $request, Quiz $quiz)
    {
        // Submission logic in quiz submission service.
        $submission = $this->service->submit(
            $quiz,
            $request->validated('student_id'),
            $request->validated('answers')
        );

        if (! $submission) {
            return $this->errorResponse('You have reached the maximum number of attempts', 422);
        }

        return new QuizSubmissionResource($submission);
    }
}
