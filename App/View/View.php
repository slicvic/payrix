<?php

namespace App\View;

use App\Exceptions\ViewException;

class View implements ViewInterface
{
    /**
     * @var string
     */
    protected $file;

    /**
     * @var array
     */
    protected $vars;

    public function __construct(string $file, array $vars = [])
    {
        $this->file = $file;
        $this->vars = $vars;
    }

    /**
     * {@inheritdoc}
     */
    public function render()
    {
        if (!is_readable($this->file)) {
            throw new ViewException("Unable to read file: {$this->file}");
        }

        // Extract variables to be used by the view
        if (!empty($this->vars)) {
            extract($this->vars);
        }

        // Start output buffer
        ob_start();

        include_once $this->file;

        // Get buffer contents
        $view = ob_get_contents();

        // Close buffer
        ob_end_clean();

        return $view;
    }
}
