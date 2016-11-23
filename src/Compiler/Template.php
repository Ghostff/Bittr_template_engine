<?php

namespace Compiler;

class Template
{
    //holds uncompiled template string
    private $lines = array();
	
	public static $name = null;
	
	public static $line_number = 0;
    
    
    //opening tag identifier
    public static $open = null;
    
    //closing tag identifier
    public static $close = null;
    /*
    * Construct
    *
    * return void
    * @param (mixed) string to compile
    */
    public function __construct($template_array, $name)
    {
        $this->lines = $template_array;
		static::$name = $name;
        
    }
    
    
    private function getSyntax()
    {
        $new_String = null;
        
		
		foreach ($this->lines as $line => $strings) {
			
			static::$line_number = $line;
            $req_inc = '/' . static::$open . '\s*(req|inc) \'(.*?)\'\s*' . static::$close .'/';

			if (preg_match_all($req_inc, $strings, $matched)) {
				\Sandbox\GetFile::asType($matched, $this->lines, $line, static::$name);
			}

		}
        return $this->lines;
    }
    
    /*
    * compiles template
    *
    * return string
    */
    public function compile()
    {
        return $this->getSyntax();
    }
}