<?php

namespace App\Helpers;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use JsonSerializable;

abstract class Response
{

    public const STATUS_OK = 200;

    public const STATUS_CREATED = 201;

    public const STATUS_ACCEPTED = 202;

    public const STATUS_NO_CONTENT = 204;

    public const STATUS_BAD_REQUEST = 400;

    public const STATUS_UNAUTHORIZED = 401;

    public const STATUS_FORBIDDEN = 403;

    public const STATUS_NOT_FOUND = 404;

    public const STATUS_UNPROCESSABLE_ENTITY = 422;

    public const STATUS_INTERNAL_SERVER_ERROR = 500;

    public const STATUS_SERVICE_UNAVAILABLE = 503;

    public const STATUS_GATEWAY_TIMEOUT = 504;

    /**
     * Response success.
     *
     * @param mixed $data
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function success(mixed $data, string $message, int $statusCode = self::STATUS_OK): JsonResponse
    {
        $content['success'] = true;
        $content['message'] = $message;


        if ($data instanceof ResourceCollection && $data->resource instanceof LengthAwarePaginator) {
            if ($data->resource->isEmpty()) {
                $content['data'] = [];


                return response()->json($content);

            }
            $content['data'] = $data->resource->items();
            $content['meta'] = [
                'total'       => $data->resource->total(),
                'perPage'     => $data->resource->perPage(),
                'currentPage' => $data->resource->currentPage(),
                'lastPage'    => $data->resource->lastPage(),
                'hasNext'     => $data->resource->hasMorePages(),
                'hasPrevious' => $data->resource->currentPage() > 1,
            ];
        } elseif ($data instanceof JsonSerializable) {
            $content['data'] = $data->jsonSerialize();
        } elseif ($data instanceof Arrayable) {
            $content['data'] = $data;
        } else {
            if ($data !== null) $content['data'] = $data;
        }

        return response()->json($content, $statusCode);
    }

    /**
     * Response error.
     *
     * @param mixed $data
     * @param string $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function error(mixed $data, string $message, int $statusCode): JsonResponse
    {
        $content = [
            'success' => false,
            'message' => $message,
        ];

        if ($data) $content['data'] = $data;

        return response()->json($content, $statusCode);
    }

    /**
     * Response no content
     *
     * @return JsonResponse
     */
    public static function noContent(): JsonResponse
    {
        return response()->json(null, self::STATUS_NO_CONTENT);
    }

    /**
     * Response unauthorized.
     *
     * @param string $message
     * @return JsonResponse
     */
    public static function unauthorized(string $message = 'Unauthorized'): JsonResponse
    {
        $content = [
            'success' => false,
            'message' => $message
        ];

        return response()->json(
            $content,
            self::STATUS_UNAUTHORIZED
        );
    }

    /**
     * Response not found.
     *
     * @param string $message
     * @return JsonResponse
     */
    public static function notFound(string $message = 'Not Found'): JsonResponse
    {
        $content = [
            'success' => false,
            'message' => $message
        ];

        return response()->json($content, self::STATUS_NOT_FOUND);
    }
}