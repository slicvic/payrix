<?php

namespace App\Controllers;

use App\View\View;

abstract class BaseController
{
    protected function view(string $file, array $vars = [])
    {
        $view = new View(VIEWPATH . $file, $vars);

        return $view->render();
    }
}
