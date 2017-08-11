<?php

namespace Compiler;

use RuntimeException;

class Render extends Processor
{
    private $path = null;
    private $extension = null;
    private $cache_path = null;

    private $imported = [];

    public function __construct()
    {
        $this->path = DS . Helpers::realpath(Config::$path) . DS;
        $this->extension = Config::$extension;
        $this->cache_path = __DIR__ . '/../Cache/';
    }

    public function view(array $files, array $data = [], bool $view_if_exist = false): void
    {
        $found_files = [];
        foreach ($files as $file)
        {
            $file_name = preg_replace('/\.' . $this->extension .'$/', '', $this->path . $file) . '.' . $this->extension;
            if (is_readable($file_name))
            {
                $this->evaluate($file_name);
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

    private function name(string $name): string
    {
        return crc32($name);
    }

    private function isCached(string $name): bool
    {
        $time = filemtime($name);
        $name = $this->name($name);
        $name_with_path = $this->cache_path . $name;
        foreach (glob($name_with_path . "_[0-9]*") as $filename)
        {
            $_ = explode('_', basename($filename));
            var_dump($_[1] . ' '. $time);
            if ($_[1] == $time)
            {
                return true;
            }
            else
            {
                unlink($filename);
                return false;
            }
        }
        return false;
    }

    private function save(string $name, string $content): void
    {
        $time = filemtime($name);
        file_put_contents($this->cache_path . $this->name($name) . '_' . $time, $content);
    }

    private function evaluate(string $name)
    {
        if ($this->isCached($name))
        {
        }
        else
        {
            $this->save($name, $this->tag(file_get_contents($name)));
        }
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