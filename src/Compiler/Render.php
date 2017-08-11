<?php

namespace Compiler;

use RuntimeException;

class Render
{
    private $path = null;
    private $extension = null;

    public function __construct()
    {
        $this->path = DS . Helpers::realpath(Config::$path) . DS;
        $this->extension = Config::$extension;
    }

    public function view(array $files, array $data = [], bool $view_if_exist = false): void
    {
        $found_files = [];
        foreach ($files as $file)
        {
            $file_name = preg_replace('/\.' . $this->extension .'$/', '', $this->path . $file) . '.' . $this->extension;
            if (is_readable($file_name))
            {
                $found_files[] = $file_name;
            }
            else
            {
                if ($view_if_exist)
                {
                    continue;
                }
                $this->exception('Template: "{0}" was not found in "{1}"', $file . '.' . $this->extension, $this->path);
            }
        }

        $this->extractData($found_files, $data);
    }

    private function extractData(array $files_27832dbd892hd299e9hd2, array $passed_89e78287eh5hd82187_data): void
    {
        extract($passed_89e78287eh5hd82187_data, EXTR_REFS | EXTR_OVERWRITE);
        foreach ($files_27832dbd892hd299e9hd2 as $file3887_8328es3983f89892_name)
        {
            include $file3887_8328es3983f89892_name;
        }
    }

    private function exception(): string
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