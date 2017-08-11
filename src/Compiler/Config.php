<?php

namespace Compiler;


class Config
{

    public static $path = __DIR__ . '/../../Templates/';

    public function setPath(string $path)
    {
        self::$path = $path;
    }
}