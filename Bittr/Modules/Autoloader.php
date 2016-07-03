<?php
class Autoloader
{
	 /**
     * Register Autoloader with SPL autoloader stack.
     * @return void
     */
	public static function start() {
		spl_autoload_register('Autoloader::loadClassFiles');
	}
	 /**
     * If a file exists, require it from the file system.
     *
     * @param string $file The file to require.
     * @return bool True if the file exists, false if not.
     */
	public static function loadClassFiles($filename) {
		$pathtofile = dirname(__FILE__) . DIRECTORY_SEPARATOR . $filename . '.php';
		require $pathtofile;
	}
	
}
