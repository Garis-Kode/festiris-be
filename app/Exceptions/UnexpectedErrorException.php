<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UnexpectedErrorException extends HttpException
{
    public function __construct(string $message = 'Please contact our support.', $code = Response::HTTP_INTERNAL_SERVER_ERROR)
    {
        parent::__construct($code, $message);
    }
}
