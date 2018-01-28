<?php

namespace App\View;

interface ViewInterface
{
    /**
     * @return string
     * @throws \App\Exceptions\ViewException
     */
    public function render();
}
