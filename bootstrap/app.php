<?php

use App\Helpers\Response;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {})
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Throwable $exception, Request $request) {
            $getErrorContent = function (Throwable $exception): ?array {
                if (config('app.debug')) {
                    return [
                        'message' => $exception->getMessage(),
                        'exception' => get_class($exception),
                        'file' => $exception->getFile(),
                        'line' => $exception->getLine(),
                        'trace' => $exception->getTrace(),
                    ];
                }

                return null;
            };
            $getModelName = function (ModelNotFoundException $exception): string {
                $modelName = preg_replace('/(?<!^)([A-Z])/', ' $1', class_basename($exception->getModel()));

                return ucfirst(strtolower($modelName));
            };

            if ($exception instanceof NotFoundHttpException) {
                $previousException = $exception->getPrevious();
                if ($previousException instanceof ModelNotFoundException) {
                    return Response::notFound("{$getModelName($previousException)} not found.");
                }

                return Response::notFound($exception->getMessage());
            }

            if ($exception instanceof AuthenticationException) {
                return Response::unauthorized($exception->getMessage());
            }

            if ($exception instanceof \Illuminate\Validation\ValidationException) {
                return Response::error($exception->errors(), $exception->getMessage(), Response::STATUS_UNPROCESSABLE_ENTITY);
            }

            if ($exception instanceof HttpException) {
                $content = $getErrorContent($exception);

                return Response::error($content, $exception->getMessage(), $exception->getStatusCode());
            }

            $content = $getErrorContent($exception);

            return Response::error($content, 'Please contact our support.', Response::STATUS_INTERNAL_SERVER_ERROR);
        });
    })->create();
