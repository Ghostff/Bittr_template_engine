<?php

namespace Compiler;


class Processor
{
    protected $last = null;

    public function tag(string $content): string
    {
        return str_replace(['{[', '[[', ']]', '}]'], ['<?php', '<?=', '?>', '?>'], $content);
    }
}