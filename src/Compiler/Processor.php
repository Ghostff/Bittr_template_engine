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
            $replace = '';
            foreach (explode('|', $matches[2]) as $file)
            {
                if ($matches[1] == 'inc')
                {
                    $replace .= 'include \'' .  $file. '\'; ';
                }
                elseif ($matches[1] == 'req')
                {
                    $replace .= 'require \'' .  $file. '\'; ';
                }
            }
            return $replace;
        }, $content);

        return $new;
    }
}