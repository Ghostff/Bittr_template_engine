<?php

namespace Compiler;


class Render
{
    public function view(array $files, array $data = [])
    {
        foreach ($files as $file)
        {
            return $file;
        }
    }
}