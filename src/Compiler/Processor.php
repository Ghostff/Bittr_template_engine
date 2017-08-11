<?php

namespace Compiler;


abstract class Processor
{

    protected abstract function makeName(string $name);
    public abstract function view(array $files, array $data = [], bool $if_exist = false);

    protected function render(string $file)
    {
        $before = file_get_contents($file);
        preg_replace_callback("/(inc|req) '(.*?)'/", function (array $matches)
        {
            $files = explode('|', $matches[3]);
            $this->view($files);
            var_dump($files);
        }, $before);

    }
}