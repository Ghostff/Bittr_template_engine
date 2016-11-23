<?php

namespace Sandbox;

class Variable
{
	/*
	* check if array is multidimensional
	*
	*/
	private static function isMultidimensional($array)
	{
		foreach ($array as $val) {
			if (is_array($val)) {
				return true;	
			}
		}
		return false;
	}
	
	private static function refrence($identifier, $string)
	{
		$json = file_get_contents(CONFIG_PATH . 'Refrences.json');
		$function = json_decode($json);
		
		var_dump($json, $function);
	}
	
	public static function evaluate($type, &$line_string, $line_num, &$file_name)
	{
		$attributes = \Compiler\Bittr::$attributes;
		$string = null;

        foreach ($type[1] as $key => $value)
		{
			if (isset($attributes[$value])) {
				
				$string = null;
				if ( ! is_array($attributes[$value])) {
					$string = $attributes[$value];
					if (isset($type[3][$key])) {
						$string = static::refrence($type[3][$key], $string);	
					}
				}
				else {
					if (isset($type[4][$key])) {
						
						if ( ! self::isMultidimensional($attributes[$value])) {
							$string = implode($type[4][$key], $attributes[$value]);
						}
						else {
							$string = 'Multidimensional Array';
							new \Compiler\Except('You can\'t explicitly convert a Multidimensional Array to a string', 1);
						}
					}
					else {
						$string = 'Array';
						new \Compiler\Except('You can\'t access array as a string', 1);
					}
				}
				$line_string[$line_num] = str_replace($type[0][$key], $string, $line_string[$line_num]);
			}
			else {
				 new \Compiler\Except('Undifined variable ' . $value, 1);	
			}
		}
		
		
		
	}
}