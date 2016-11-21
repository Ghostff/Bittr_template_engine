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
        
        //excape all character that can posible be use as a tag
        list($this->open, $this->close) = array_map(function($values)
        {
            return addcslashes($values, '.\+*?[^]($){}|');
            
        }, array_values($tags));
        
    }
    
    
    private function getSyntax()
    {
        $new_String = null;
        
        asType: {
            $req_inc = '/' . $this->open . '\s*(req|inc) \'(.*)\'\s*' . $this->close .'/';
            if (preg_match_all($req_inc, $this->string, $matched)) {
                \Sandbox\GetFile::asType($matched, $this->string);
                goto asType;
            }
        }
        var_dump($this->string);
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