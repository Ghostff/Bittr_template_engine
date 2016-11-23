<?php

namespace Config;

class Config
{
    protected static $ext = '.bt';
    
    public static $template_path = null;
    
    protected static $tags = array(
      'open' => '@{',
      'close' => '}'
    );
	
	public static $statement = array(
		'if'        => 'if',
		'else if'	=> 'eif',
		'else'		=> 'else',
		'endif'		=> 'enf'
	);
    
    protected static $log = null;
    
    public static $time_zone = 'UTC';
    
    /*
    * Sets a template file extension
    *
    * return void
    * @param (string) extension name
    */
    public static function setExtension($extension)
    {
        static::$ext = $extension;
    }
    
    /*
    * Sets a template path
    *
    * return void
    * @param (string) template path
    */
    public static function setTemplatePath($path)
    {
        static::$template_path = $path;
    }
    
    /*
    * Sets a template tag identifier
    *
    * return void
    * @param (string) opening tag identifier
    * @pram (string) closing tag identifier
    */ 
    public static function setTags($open = null, $close = null)
    {
        if ($open != null) {
            static::$tags['open'] = $open;
        }
        
        if ($close != null) {
            static::$tags['close'] = $close;
        }
    }
    
    /*
    * Sets log Directory
    *
    * return void
    * @param (string) directory name
    */
    public static function setLogDir($path)
    {
        static::$log = $path;
    }
    
    /*
    * Sets default timezone 
    *
    * return void
    * @param (string) timezone
    */
    public static function setTimeZone($time_zone)
    {
        static::$time_zone = $time_zone;
    }
    
    /*
    * lists all the template files 
    *
    * return array
    * @param (bool) list file with bittr extension only
    */
    public static function listOut($with_extension = false)
    {
        if ( ! static::$template_path) {
            $dir = TEMPLATE_PATH;
        }
        else {
            $dir = static::$template_name . DIRECTORY_SEPARATOR;
        }
        
        if ( ! $with_extension) {
            return array_map(function($names)
            {
                $path_parts = pathinfo($names);
                return $path_parts['basename'];
            }, glob($dir . '/*'));
        }
        else {
            return array_map(function($names)
            {
                $path_parts = pathinfo($names);
                return $path_parts['basename'];
            }, glob($dir . '/*' . static::$ext));
        }
    }
    
    /*
    * list all defined attributes 
    *
    * return array
    */
    public static function listAttribute()
    {
        return static::$attributes;
    }
}