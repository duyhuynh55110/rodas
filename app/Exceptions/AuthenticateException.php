<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;

class AuthenticateException extends HttpException
{
    private $statusCode;

    public function __construct($statusCode = STATUS_CODE_NOT_LOGGED_IN)
    {
        // set message
        if ($statusCode == STATUS_CODE_NOT_LOGGED_IN) {
            $this->message = 'You are not logged in';
        } else {
            $this->message = 'The username or password was not correct';
        }

        // set http code
        $this->code = HTTP_CODE_UNAUTHORIZED;
        $this->statusCode = $statusCode;
    }

    /**
     * Response status code
     *
     * @return string
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }
}
