<?php

namespace Compiler;

class Bittr extends Settings
{
    
    private static $attributes = array();
    /*
    * Sets a template attribute
    *
    * return void
    * @param (string) attribute identifier
    * @param (mixed) of attributes
    */
    public static function setAttribute($name, $attribute)
    {
        if ( ! $name || ! is_string($name)) {
            throw new \Exception('name must be a string');
        }
        static::$attributes[$name] = $attribute;
    }
    
    /*
    * compiles template data
    *
    * return string
    * @param (string) template name without extnesion
    */
    public static function compile($template_name)
    {
        $template_name = rtrim($template_name, static::$ext) . static::$ext;
        $template = file_get_contents(static::$path . DIRECTORY_SEPARATOR . $template_name);
        $template =  new Template($template, static::$attributes, static::$tags);
        return $template->compile();
    }
}