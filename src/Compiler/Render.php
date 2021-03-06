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

    public function view(array $files, array $data = [], bool $if_exist = false): string
    {
        $rendered = '';
        foreach ($files as $file)
        {
            $name = $this->makeName($file);
            if (is_readable($name))
            {
                $rendered =  $this->render($name);
            }
            else
            {
                if ($if_exist)
                {
                    $rendered = '';
                }
                $this->exception('Template : "{0}" not found in "{1}"', $file, $name);
            }
        }

        return $rendered;
    }

    protected function makeName(string $name)
    {
        return $this->template_path . str_replace('.', DS, $name) . '.' .  $this->extension;
    }

    protected function exception(): string
    {
        $args = func_get_args();
        $format = array_shift($args);
        if ( ! empty($args))
        {
            foreach ($args as $keys => $replacement)
            {
                $format = str_replace('{' . $keys . '}', $replacement, $format);
            }
        }

        throw new RuntimeException($format);
    }
}