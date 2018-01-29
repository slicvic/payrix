<?php

namespace App\Models;

interface ModelInterface
{
    /**
     * @return true|array of errors.
     */
    public function valid();
}
