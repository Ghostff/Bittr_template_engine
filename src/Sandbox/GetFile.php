<?php

namespace Sandbox;

class GetFile
{
	//$matched, $this->lines, $line, &$this->name
    public static function evaluate($type, &$line_string, $line_num, &$file_name)
    {
        $string = null;
        foreach ($type[1] as $key => $value) {
			
			if ( ! \Compiler\Bittr::$template_path) {
                $file = TEMPLATE_PATH . $type[2][$key];
            }
            else {
                $file = \Compiler\Bittr::$template_path . DIRECTORY_SEPARATOR . $type[2][$key];
            }
			
			if ($value == 'req')
			{
                if (file_exists($file)) {
					
                    $line_cont = file($file, FILE_IGNORE_NEW_LINES);
        			$template =  new \Compiler\Template($line_cont, $file);
					
					$string = null;
					if (is_array($template->compile())) {
						$string = implode(PHP_EOL, $template->compile());
					}
					$line_string[$line_num] = str_replace($type[0][$key], $string, $line_string[$line_num]);

				}
                else {
                    new \Compiler\Except('file (' . $file . ') was not found');
                }
			}
			elseif ($value == 'inc')
			{
				if (file_exists($file)) {
					
                    $line_cont = file($file, FILE_IGNORE_NEW_LINES);
        			$template =  new \Compiler\Template($line_cont, $file);
					
					$string = null;
					if (is_array($template->compile())) {
						$string = implode(PHP_EOL, $template->compile());
					}
					$line_string[$line_num] = str_replace($type[0][$key], $string, $line_string[$line_num]);
					
                }
                else {
                    new \Compiler\Except('file (' .$file . ') was not found', 1);
                }
			}
		}
	}
}