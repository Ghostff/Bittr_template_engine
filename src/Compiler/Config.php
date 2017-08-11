<?php

namespace Compiler;


class Config
{

    public static $path = __DIR__ . '/../../Templates/';

    public static $extension = 'bt';

    public static function setPath(string $path)
    {
        self::$path = $path;
    }

    public static function setExtension(string $extension)
    {
        self::$extension = $extension;
    }
}