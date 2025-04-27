<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureQuizActive
{
    use ApiResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $quiz = $request->route('quiz');
        $now  = now();

        if (
            ! $quiz->is_published
            || ($quiz->start_time && $now->lt($quiz->start_time))
            || ($quiz->end_time   && $now->gt($quiz->end_time))
        ) {
            return $this->errorResponse('This quiz is not active', Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
