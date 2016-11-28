<?php

namespace Sandbox;

class Label
{
    public static function evaluate($type, &$line_string, $line)
    {
        if (trim($type[1]) != \Config\Config::$allow_labe_display) {
            $line_string[$line] = null;
        }
    }
}
