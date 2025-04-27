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

        $isNotPublished = !$quiz->is_published;
        $started = $quiz->start_at && $now->lt($quiz->start_at);
        $ended = $quiz->end_at && $now->gt($quiz->end_at);

        if ($isNotPublished || !$started || $ended) {
            return $this->errorResponse('This quiz is not active', Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
