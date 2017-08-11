<?php

namespace Compiler;


class Helpers
{
    public static function realpath(string $path)
    {
        $path = str_replace(['/', '\\'], DS, $path);
        $parts = array_filter(explode(DS, $path), 'strlen');
        $absolutes = [];
        foreach ($parts as $part)
        {
            if ('.' == $part)
            {
                continue;
            }
            if ('..' == $part)
            {
                array_pop($absolutes);
            }
            else
            {
                $absolutes[] = $part;
            }
        }
        return implode(DS, $absolutes);
    }
}