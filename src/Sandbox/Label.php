<?php

namespace Sandbox;

class Label
{
    public static function evaluate($type, &$line_string, $line)
    {
		$is_excape = trim($type[1]);
        if ($is_excape != \Config\Config::$allow_labe_display) {
            $line_string[$line] = null;
        }
		else {
			//remove the (!) at the end of the label
			$new_label = preg_replace('/\s*' . \Config\Config::$allow_labe_display .'(\s*])$/', '$1', $type[0]);
			$line_string[$line] = $new_label;
		}
    }
}
