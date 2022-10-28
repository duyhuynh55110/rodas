<?php

namespace App\Exceptions;

use Exception;

class DataNotFoundException extends Exception
{
    public function __construct($message = NOT_FOUND_DATA)
    {
        $this->message = $message;
    }
}
