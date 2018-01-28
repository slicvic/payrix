<?php

namespace App\Exceptions;

class UsernameAlreadyTakenException extends \Exception
{
    protected $message = 'The username is not available';
}
