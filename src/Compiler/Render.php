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
            var_dump(file_exists($this->path . $file . '.bt'));
            return realpath($this->path);
        }
    }
}