<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BadRequestException extends HttpException
{
    public function __construct(string $message, $code = Response::HTTP_BAD_REQUEST)
    {
        parent::__construct($code, $message);
    }
}
