<?php

namespace Compiler;


class Config
{

    public static $path = __DIR__ . '../../';

    public function setPath(string $path)
    {
        self::$path = $path;
    }
}