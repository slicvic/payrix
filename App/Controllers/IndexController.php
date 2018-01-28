<?php

namespace App\Controllers;

use App\View\View;

class IndexController
{
    public function indexAction()
    {
        $view = new View(VIEWPATH . 'index/index.html', [
            'greeting' => 'Hello, World!'
        ]);

        return $view->render();
    }
}
