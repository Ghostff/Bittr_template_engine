<?php

namespace Compiler;

class Settings
{
    protected static $ext = '.bt';
    
    protected static $path = 'Templates';
    
    protected static $tags = array(
      'open' => '@{',
      'close' => '}'
    );
    
    
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
    public static function setPath($path)
    {
        static::$path = $path;
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
}