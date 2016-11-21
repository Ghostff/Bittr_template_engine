<?php

namespace Sandbox;

class GetFile
{
    public static function asType($type, &$templat_content)
    {
        $string = null;
        foreach ($type[1] as $key => $value) {

            if ( ! \Compiler\Bittr::$template_path) {
                $file = TEMPLATE_PATH . $type[2][$key];
            }
            else {
                $file = \Compiler\Bittr::$template_path . DIRECTORY_SEPARATOR . $type[2][$key];
            }
            
            
            if ($value == 'req') {
                if (file_exists($file)) {
                    $string = file_get_contents($file);
                    $templat_content = str_replace($type[0][$key], $string, $templat_content);
                }
                else {
                    new \Compiler\Except('file (' . $file . ') was not found');
                }
            }
            elseif ($value == 'inc') {
            
                if (file_exists($file)) {
                    $string = file_get_contents($file);
                    $templat_content = str_replace($type[0][$key], $string, $templat_content);
                }
                else {
                    \Compiler\Bittr::errLog('file (' .$file . ') was not found', 1);
                }
            }
        }
    }
}