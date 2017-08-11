<?php

namespace Compiler;


abstract class Processor
{
    private $included = [];

    protected abstract function makeName(string $name);
    public abstract function view(array $files, array $data = [], bool $if_exist = false);
    protected abstract function exception();


    protected function render(string $file): string
    {
        $before = file_get_contents($file);
        $before =  preg_replace_callback("/(inc|req) '(.*?)'/", function (array $matches)
        {
            $new = '';
            foreach (explode('|', $matches[2]) as $file)
            {
                if (in_array($file, $this->included))
                {
                    $this->exception('You can\'t include "{0}" multiple times');
                }
                $this->included[] = $file;
                $new .= $this->view([$file], [], ($matches[1] == 'inc'));
            }
            return $new;
        }, $before);

        return $before;

    }
}