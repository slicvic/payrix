<?php

namespace App\Controllers;

class IndexController extends BaseController
{
    public function indexAction()
    {
        return $this->view('index/index.html', [
            'greeting' => 'Hello, World!'
        ]);
    }
}
