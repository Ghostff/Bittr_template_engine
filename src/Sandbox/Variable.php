<?php

namespace Sandbox;

class Variable
{
    private static $json = null;
    
    /*
    * check if array is multidimensional
    *
    * return bool
    * @param array to validate
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
    
    /*
    * check if array is multidimensional
    *
    * return string of evaluated value($string)
    * @param string of Refrences.json key
    * @param string value to evaluate
    */
    private static function refrence($identifier, $string)
    {
        $identifier = ltrim($identifier, '.');
        //check if user did  not type out a full php function name
        if ( ! function_exists($identifier)) {
            //store Refrences json data to prevent multiple file_get_contents and json_decode
            if ( ! static::$json) {
                $json = json_decode(file_get_contents(CONFIG_PATH . 'Refrences.json'), 1);
                static::$json = $json;
            }
            else {
                $json = static::$json;    
            }
            //check identifier points to a function
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

    }
    
    /*
    * evaluates all variable syntax in template file
    *
    * return void
    * @param array of all posible syntaxs
    * @param array of template content (lines)
    * @param int of current line (used to target and modify a specific line in @2param)
    * @param string current template name
    */
    public static function evaluate($type, &$line_string, $line_num, &$file_name)
    {
        $attributes = \Compiler\Bittr::$attributes;
        $string = null;
        
        //if user is trying to define a varibale
        $defining = false;
        foreach ($type[1] as $key => $value)
        {
            
            //check variable exists in attribute || if user is trying to define a variable
            //$type[5][$key] stays empty if user is not defining a varibale and otherwise
            if (isset($attributes[$value]) || (isset($type[5][$key]) && $defining = trim($type[5][$key]) != false)) {
                
                $string = null;
                //if user is defining a new varibale
                if ($defining) {
                    //push the new varibale value to the attributes
                    \Compiler\Bittr::$attributes[$value] = $type[5][$key];
                    //replace the syntax with null from current compile file eg(replace @{ name = '..'; } with ''
                    //to prevent output to browser
                    $line_string[$line_num] = str_replace($type[0][$key], null, $line_string[$line_num]);
                    //since we are setting a variable we want to reexecute the current line incase user tries to oupute
                    //the set variable at the same line eg ( @{ n = 'Foo'} @{ n })
                    return 'reExec';
                }
                elseif ( ! is_array($attributes[$value])) {
                    //if the attribute value is not an array
                    // get the value of the attribute where called varible is the attribute key
                    $string = $attributes[$value];
                    //check if varibale has (.) next to it eg( @{ name.exec })
                    if ((isset($type[2][$key])) && (trim($type[2][$key]) != false)) {
                        //if yes call the function as pass variable name as the first argument
                        $string = static::refrence($type[2][$key], $string);  
                    }
                }
                else {
                    //if variable is an array and has implode ref eg ( @{ name<..> } )
                    if (isset($type[4][$key]) && trim($type[4][$key]) != false) {
                        //if attribute value is not a multidimensional array implode array content with variable implode reg
                        // eg ( @{ name<, > } return implode(', ', name) )
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
                //replace all varible syntax with $string
                $line_string[$line_num] = str_replace($type[0][$key], $string, $line_string[$line_num]);
            }
            else {
                 new \Compiler\Except('Undifined variable ' . $value, 1);    
            }
        }  
    }
}