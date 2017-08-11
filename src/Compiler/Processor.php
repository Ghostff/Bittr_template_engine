<?php

namespace Compiler;


abstract class Processor
{

    protected abstract function makeName(string $name);

    protected function render(string $file)
    {
        $before = file_get_contents($file);
        preg_replace_callback("/(inc|req) '(.*?)'/", function (array $matches)
        {
            var_dump($matches);
        }, $before);

    }
}