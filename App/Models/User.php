<?php

namespace App\Models;

class User extends Model
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    public $fullname;

    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $password;

    /**
     * @return true|array
     */
    public function valid()
    {
        $errors = [];

        if (!is_string($this->fullname) || empty($this->fullname)) {
            $errors[] = 'The full name is required';
        }

        if (!is_string($this->username) || empty($this->username)) {
            $errors[] = 'The username is required';
        }

        if (!is_string($this->password) || strlen($this->password) < 6) {
            $errors[] = 'The password must be at least 6 characters long';
        }

        return  (empty($errors)) ? true : $errors;
    }
}
