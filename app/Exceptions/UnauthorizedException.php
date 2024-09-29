<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UnauthorizedException extends HttpException
{
    public function __construct(string $message, $code = Response::HTTP_UNAUTHORIZED)
    {
        parent::__construct($code, $message);
    }
}
