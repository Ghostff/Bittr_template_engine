<?php

namespace Compiler;

use RuntimeException;

class Render extends Processor
{
    private $template_path = null;

    public function __construct()
    {
        $this->template_path = DS . Helpers::realpath(__DIR__ . '../../Templates') . DS;
    }

    public function view()
    {
        echo $this->template_path;
    }
}