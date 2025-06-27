<?php

namespace App\Exceptions;

use Exception;

class InvalidUserException extends Exception
{
    protected $message = 'Invalid user';
    protected $code = 400;
}
