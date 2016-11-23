<?php

namespace Compiler;

class Template
{
    //holds uncompiled template string
    private $lines = array();
    
    //holds attributes
    private $attributes = array();
	
	private $name = null;
    
    
    //opening tag identifier
    private $open = null;
    
    //closing tag identifier
    private $close = null;
    /*
    * Construct
    *
    * return void
    * @param (mixed) string to compile
    */
    public function __construct($template_array, $attributes, $tags, $name)
    {
        $this->attributes = $attributes;
        $this->lines = $template_array;
		$this->name = $name;
        
        //excape all character that can posible be use as a tag
        list($this->open, $this->close) = array_map(function($values)
        {
            return addcslashes($values, '.\+*?[^]($){}|');
            
        }, array_values($tags));
        
    }
    
    
    private function getSyntax()
    {
        $new_String = null;
        
		
		foreach ($this->lines as $line => $strings) {
			
			asType: {
            $req_inc = '/' . $this->open . '\s*(req|inc) \'(.*)\'\s*' . $this->close .'/';
			if (preg_match_all($req_inc, $strings, $matched)) {
					\Sandbox\GetFile::asType($matched, $this->lines, $line, &$this->name);
					goto asType;
				}
			}

		}
        var_dump($this->lines);
    }
    
    /*
    * compiles template
    *
    * return string
    */
    public function compile()
    {
        $this->getSyntax();
    }
}