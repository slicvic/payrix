<?php

namespace App\Exceptions;

class ValidationException extends \Exception
{
    /**
     * @var array
     */
    protected $errors;

    public function __construct(array $errors)
    {
        $this->errors = $errors;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
