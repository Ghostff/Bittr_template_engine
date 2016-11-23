<?php

namespace Compiler;
use \Config\Config;

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
				\Sandbox\GetFile::evaluate($matched, $this->lines, $line, static::$name);
			}
			
			$statement = '/' . static::$open . '\s*' . Config::$statement['if'];
			$statement .= ' (\w+)\s*' . static::$close;
			$statement .= '(.*?)' . static::$open . '\s*' . Config::$statement['endif'];
			$statement .= '\s*' . static::$close . '/';
			var_dump($statement);
			if (preg_match_all($statement, $strings, $matched)) {
				\Sandbox\Statement::evaluate($matched, $this->lines, $line, static::$name);
			}
			
			
			$var_type = '/' . static::$open . '\s*(\w+)([\.\w]*|(\s*<(.*?)>)*)\s*' . static::$close .'/'; 
			if (preg_match_all($var_type, $strings, $matched)) {
				//\Sandbox\Variable::evaluate($matched, $this->lines, $line, static::$name);
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