<?php

namespace Sandbox;

class Variable
{
    private static $json = null;
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
        $identifier = ltrim($identifier, '.');
        
        if ( ! function_exists($identifier)) {
            
            if ( ! static::$json) {
                $json = json_decode(file_get_contents(CONFIG_PATH . 'Refrences.json'), 1);
                static::$json = $json;
            }
            else {
                $json = static::$json;    
            }

            if (array_key_exists($identifier, $json)) {
                $call_function = $json[$identifier];
                return $call_function($string);
            }
            else {
                new \Compiler\Except('Function (' . $identifier . ') not defined');
            }
            
        }
        else {
            return $identifier($string);    
        }
        
        
        
        //var_dump(static::$json);
    }
    
    public static function evaluate($type, &$line_string, $line_num, &$file_name)
    {
        $attributes = \Compiler\Bittr::$attributes;
        $string = null;
        
        //if user is trying to define a varibale
        $defining = false;
        
        foreach ($type[1] as $key => $value)
        {
            if (isset($attributes[$value]) || (isset($type[5][$key]) && $defining = trim($type[5][$key]) != false)) {
                
                $string = null;
                if ($defining) {
                    \Compiler\Bittr::$attributes[$value] = $type[5][$key];
                    $line_string[$line_num] = str_replace($type[0][$key], null, $line_string[$line_num]);
                    return 'reExec';
                }
                elseif ( ! is_array($attributes[$value])) {
                    $string = $attributes[$value];
                    if ((isset($type[2][$key])) && (trim($type[2][$key]) != false)) {
                        $string = static::refrence($type[2][$key], $string);    
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