<?php

namespace Sandbox;

class Statement
{
    public static function evaluate($type, &$line_string)
    {
        $attributes = \Compiler\Bittr::$attributes;

        //get statement identifier
        $stement = $type[0][1][1];
        //get the line number of where statement began @{ if (identifer) }
        $begin = $type[0][0];
        //get the line number og the end of statemen @{ enf }
        $end = end($type);

		
		$exec_if = false;
		//check if statment is trying to validate an array
		if (isset($type[0][1][2]) && ($type[0][1][2] == \Config\Config::$is_arr)) {
			//get isArray statment identifie
			$is_arr = $type[0][1][2];
			if (is_array($attributes[$stement])) {
				$exec_if = true;
			}
		}
		elseif (array_key_exists($stement, $attributes)) {
			$exec_if = true;	
		}
        
        //prevent the statement from displaying:
        //clear out the line that contains the current statemne from @{ if .. to enf } from line buffer
        for ($i = $begin; $i <= $end[0]; $i++) {
            unset($line_string[$i]);    
        }
		
		
        //check if key exists in attribute
        if ($exec_if) {
            
            $new_if = $type;
            //remove the first(@{ if .. }) and last (@{ enf }) array element which mean all left will be the body of the statement 
            array_shift($new_if);
            array_pop($new_if);
            
            $new_string = array();
            //set the line number of the statement body to the key of each statement body array
            //more like we want it to seem like we are trying to compile with a new file
            foreach ($new_if as $key => $values) {
                $new_string[$values[0]] = $values[1];
            }
			
            //compile the new string
            $template =  new \Compiler\Template($new_string, \Compiler\Template::$name);
            $new_string = array_map('trim', $template->compile());
            //push back the compiled string to line buffer, since they keys has been unset, at line 21, we want to push back the key
            //thus setting the new keys to the content of compiled statment
            $line_string += $new_string;
            //in most casses the key will be added to the last of the line buffer, making the compiled statement to fall at the last line 
            //when outputed.
            ksort($line_string);
            //puts they key back to the original line before statement compilation
            
        }
    }
}