<?php

namespace Sandbox;

class Statement
{
    public static function evaluate($type, &$line_string)
    {
		$attributes = \Compiler\Bittr::$attributes;
		
        $stement = $type[0][1][1];
		$begin = $type[0][0];
		$end = end($type);
		
		$end = end($type);
		for ($i = $begin; $i <= $end[0]; $i++) {
			unset($line_string[$i]);	
		}
		
		if (array_key_exists($stement, $attributes)) {
			
			$new_if = $type;
			array_shift($new_if);
			array_pop($new_if);
			$incr = 1;
			
			$new_string = array();
			foreach ($new_if as $key => $values) {
				$new_string[$values[0]] = $values[1];
			}
			
			$template =  new \Compiler\Template($new_string, \Compiler\Template::$name);
			$new_string = array_map('trim', $template->compile());
			$line_string += $new_string;
			ksort($line_string);	
			
		}
    }
}