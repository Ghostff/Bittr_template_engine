<?php
class Autoloader
{
	 /**
     * Register Autoloader with SPL autoloader stack.
     *
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
		
		$pathtofile = dirname(__FILE__) . DSEP . $filename . '.php';
		if (!file_exists($pathtofile)) {
			die('Cant find file <b>\'' . $filename . '\'</b> at ' . $pathtofile);
		}
		require $pathtofile;
	}
	 /**
	 * Validate languages
     * Check if selected language file exits in language folder.
     */
	public static function loadLanguage()
	{
		$language =  dirname(__FILE__) . DSEP . '..' . DSEP . 'Languages' . DSEP . DEFAULT_LANG . '.php';
		if (!file_exists($language)) {
			die('Cant find langauge <b>\'' . DEFAULT_LANG . '\'</b> file at ' . $language);
		}
		return $language;
	}
	/**
	 * Load Sandbox
     * required for error handling and SANDBOX_TYPE.
     */
	public static function loadSandbox()
	{
		$sandbox =  dirname(__FILE__) . DSEP . 'Sandbox' . DSEP . 'Controls.php';
		if (!file_exists($sandbox)) {
			die('Failed to load Sandbox from ' . $language);
		}
		return $sandbox;
	}
	
}
