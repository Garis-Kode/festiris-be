<?php

namespace App\Http\Middleware;

use App\Helpers\Response as ApiResponse;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OnlyAcceptJson
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('oauth/*')) {
            return $next($request);
        }

        if ($request->expectsJson()) {
            return $next($request);
        }

        return ApiResponse::error(null, 'Only accepts JSON requests.', ApiResponse::STATUS_NOT_ACCEPTABLE);

    }
}
