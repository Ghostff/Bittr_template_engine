<?php

namespace Compiler;


class Render
{
    private $path = null;
    private $extension = null;

    public function __construct()
    {
        $this->path = DS . Helpers::realpath(Config::$path) . DS;
        $this->extension = Config::$extension;
    }

    public function view(array $files, array $data = [])
    {
        foreach ($files as $file)
        {
            $file_name = rtrim($this->path . $file, '.' . $this->extension) . '.' . $this->extension;
            if (is_readable($file_name))
            {
                var_dump($file_name);
            }
        }
    }
}