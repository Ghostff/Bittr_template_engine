<?php

namespace Sandbox;

class GetFile
{
    public static function evaluate($type, &$line_string, $line_num, &$file_name)
    {
        $string = null;
        foreach ($type[1] as $key => $value) {
            
            //check if template path was changed. use new defined path if changed
            if ( ! \Compiler\Bittr::$template_path) {
                $file = TEMPLATE_PATH . $type[2][$key];
            }
            else {
                $file = \Compiler\Bittr::$template_path . DIRECTORY_SEPARATOR . $type[2][$key];
            }
            
            //if file is required
            if ($value == 'req')
            {
                if (file_exists($file)) {
                    //get required file (array of file lines)
                    $line_cont = file($file, FILE_IGNORE_NEW_LINES);
                    //compile the new required file
                    $template =  new \Compiler\Template($line_cont, $file);
                    $string = implode(PHP_EOL, $template->compile());
                    //replace eg { @{ req ... } with the new file content
                    $line_string[$line_num] = str_replace($type[0][$key], $string, $line_string[$line_num]);

                }
                else {
                    new \Compiler\Except('file (' . $file . ') was not found');
                }
            }
            elseif ($value == 'inc')
            {
                if (file_exists($file)) {
                    //get included file
                    $line_cont = file($file, FILE_IGNORE_NEW_LINES);
                    //compile the new included file
                    $template =  new \Compiler\Template($line_cont, $file);
                    $string = implode(PHP_EOL, $template->compile());
                    //replace eg { @{ inc ... } with the new file content
                    $line_string[$line_num] = str_replace($type[0][$key], $string, $line_string[$line_num]);

                }
                else {
                    new \Compiler\Except('file (' .$file . ') was not found', 1);
                }
            }
        }
    }
}