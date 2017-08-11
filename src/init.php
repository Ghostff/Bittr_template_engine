<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class ClassLoader
{
    private static function load($class_name)
    {
        $class_name = str_replace('\\', DIRECTORY_SEPARATOR, $class_name)  . '.php';
        $file_name = __DIR__  . DIRECTORY_SEPARATOR . $class_name;

        if (is_readable($file_name)) {
            return require $file_name;
        }
    }
    
    
    public static function register()
    {
        spl_autoload_register('ClassLoader::load');
    }
}

ClassLoader::register();