<?php

namespace Compiler;


class Processor
{
    protected $last = null;

    protected function tag(string $content): string
    {
        return $this->gets(str_replace(['{[', '[[', ']]', '}]'], ['<?php', '<?=', '?>', '?>'], $content));
    }

    protected function gets(string $content): string
    {
        $new =  preg_replace_callback('/(inc|req) \'(.*?)\'/', function(array $matches)
        {
            var_dump($matches);
        }, $content);

        return $new;
    }
}