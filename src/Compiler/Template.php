<?php

namespace Compiler;

class Template
{
    //holds uncompiled template string
    private $string = null;
    
    //holds attributes
    private $attributes = array();
    
    
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
    public function __construct($template_string, $attributes, $tags)
    {
        $this->attributes = $attributes;
        $this->string = $template_string;
        
        list($this->open, $this->close) = array_values($tags);
    }
    
    
    private function getSyntax()
    {
        
        var_dump('/' . $this->open . '\s*(req|inc)\s*\'(.*)\'\s*\\' . $this->close .'/');   
        if (preg_match('/' . $this->open . '\s*(req|inc)\s*\'(.*)\'\s*\\' . $this->close .'/', $this->string, $matched)) {
            var_dump($matched);
        }
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