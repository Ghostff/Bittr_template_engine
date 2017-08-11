<?php

namespace Compiler;


class Render
{
    private $path = null;

    public function __construct()
    {
        $this->path = Helpers::realpath(Config::$path) . DS;
    }

    public function view(array $files, array $data = [])
    {
        foreach ($files as $file)
        {
            var_dump(glob($this->path . '*'));
            return $this->path . $file . '.bt';
        }
    }
}