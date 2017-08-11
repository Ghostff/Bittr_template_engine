<?php

namespace Compiler;

use RuntimeException;

class Render extends Processor
{
    private $template_path = null;
    private $extension = null;

    public function __construct()
    {
        $this->template_path = DS . Helpers::realpath(Config::$path) . DS;
        $this->extension = Config::$extension;
    }

    public function view(array $files, array $data = [], bool $if_exist = false)
    {
        foreach ($files as $file)
        {
            $name = $this->makeName($file);
            if (is_readable($name))
            {
                $this->render($name);
            }
            else
            {
                if ($if_exist)
                {
                    return;
                }
                throw new RuntimeException();
            }
        }
        echo $this->template_path;
    }

    protected function makeName(string $name)
    {
        return $this->template_path . str_replace('.', DS, $name) . '.' .  $this->extension;
    }
}