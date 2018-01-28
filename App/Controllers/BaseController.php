<?php

namespace App\Controllers;

use App\View\View;

abstract class BaseController
{
    protected function view(string $file, array $vars = [])
    {
        $view = new View(VIEWPATH . $file, $vars);

        $layout = new View(VIEWPATH . 'layout.html', [
            'content' => $view->render()
        ]);

        return $layout->render();
    }

    public function redirect(string $url)
    {
        header("Location: $url");
        exit;
    }
}
