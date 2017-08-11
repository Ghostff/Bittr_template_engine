<?php

namespace Compiler;


class Render
{
    private $path = null;

    public function __construct()
    {
        $this->path = Config::$path;
    }

    public function view(array $files, array $data = [])
    {
        foreach ($files as $file)
        {
            return $this->path . $file;
        }
    }
}