<?php

use Regex\Compiler;
use Exceptions\BtException;

class Bittr extends Config\Config
{
	/*
	* hold templates file contents
	*/
	protected static $template = null;
	
	/*
	* store specified templates lines in template property
	* return null
	*
	* @param string of template name
	*/
	public static function compile($templateName)
	{
		$template = self::$template_path . $templateName;
		$template = rtrim($template, '.bt') . '.bt';
		if (file_exists($template)) {
			
			self::$template = file($template);
			return new Compiler(self::$template, self::$template_path, $template,
				self::$attributes
			);
		}
		else {
			throw new BtException($template . ' Does not exist');
		}
	}
}