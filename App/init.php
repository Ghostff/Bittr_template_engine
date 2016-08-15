<?php

class ClassLoader
{
	private static function load($className)
	{
		$class_name = str_replace('\\', DIRECTORY_SEPARATOR, $className);
		$class_name = 'Compiler' . DIRECTORY_SEPARATOR . $class_name . '.php';
		$class_name = __DIR__ . DIRECTORY_SEPARATOR . $class_name;
		if (is_readable($class_name)) {
			require $class_name;
			return;
		}
	}
	
	
	public static function register()
	{
		spl_autoload_register('ClassLoader::load');
	}
}

ClassLoader::register();

