<?php

namespace Compiler;


abstract class Processor
{

    protected abstract function makeName(string $name);
    public abstract function view(array $files, array $data = [], bool $if_exist = false);

    protected function render(string $file): string
    {
        $before = file_get_contents($file);
        $before =  preg_replace_callback("/(inc|req) '(.*?)'/", function (array $matches)
        {
            $files = explode('|', $matches[2]);
            var_dump($files);
            return $this->view($files, [], ($matches[1] == 'inc'));
        }, $before);

        return $before;

    }
}