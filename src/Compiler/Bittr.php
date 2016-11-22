<?php

namespace Compiler;

class Bittr extends Config
{
    
    protected static $attributes = array();
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
        
        if ( ! static::$template_path) {
            $template_name = TEMPLATE_PATH . $template_name;
        }
        else {
            $template_name = static::$template_name . DIRECTORY_SEPARATOR . $template_name;
        }
        
        $template = file_get_contents($template_name);
        $template =  new Template($template, static::$attributes, static::$tags);
        return $template->compile();
    }
    
    
    /*
    * Logs runtime errors
    *
    * return void
    * @param (string) message to be logged
    * @param (int) log type
    */
    public static function errLog($message, $type = 0)
    {
        if ( ! static::$log) {
            $base_dir = LOG_PATH . date('Y');
        }
        else {
            $base_dir = static::$log . DIRECTORY_SEPARATOR . date('Y');
        }
        
        if ( ! is_dir($base_dir)) {
            mkdir($base_dir);
        }
        $sub_dir = $base_dir . DIRECTORY_SEPARATOR . date('n');
        if ( ! is_dir($sub_dir)) {
            mkdir($sub_dir);
        }
        
        if ($type == 1) {
            $message = 'Warning: ' . $message . PHP_EOL;
        }
        else {
            $message = 'Error: ' . $message . PHP_EOL;
        }
        
        $file = $sub_dir . DIRECTORY_SEPARATOR . date('j') . '.txt';

        file_put_contents($file, $message, FILE_APPEND | LOCK_EX);
    }
}