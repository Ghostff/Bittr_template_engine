<?php

namespace Config;
use Exceptions\BtException;

class Config implements ConfigInterface
{
	/*
	* holds template file path
	*/
	protected static $template_path = null;
	
	/*
	* hold replacement attributes
	*/
	protected static $attributes = null;
	
   /* validates bittr requirements
	* return bool
	*/
	protected static function isReady()
	{
		if (self::$attributes == null) {
			
			$DSEP = DIRECTORY_SEPARATOR;
			$json_file = __DIR__ . $DSEP . '..' . $DSEP
					. '..' . $DSEP . 'Bittr.json';
					
			if (! file_exists($json_file)) {
				throw new BtException('Bittr.json not found');
			}
			else {
				
				$json = file_get_contents($json_file);
				$json = json_decode($json, true);
				$validate = $json['Bittr'];
				
				if (! version_compare(phpversion(), $validate['php'], '>=')) {
					throw new BtException('PHP ' . $validate['php'] . ' or Above is required');
				}
				
				self::$attributes['VERSION'] = $validate['version'];
				self::$attributes['DATE'] = $validate['date'];
				
				//set default template path if no path was exists
				if (self::$template_path == null) {
					$DSEP = DIRECTORY_SEPARATOR;
					self::$template_path = __DIR__ . $DSEP . '..' . $DSEP
						. '..' . $DSEP . '..' . $DSEP . 'Templates' . $DSEP;
				}
			}
		}
	}
	/*
	* set template file path. default: Template
	* return null
	*
	* @param (string) new path
	*/
	public static function setPath($newPath) {
		self::isReady();
		self::$template_path = $newPath;
	}
	
	/*
	* lists all template files in selected template directory
	* return array|string of template names
	*
	* @param (bool) of return type. if true return string of template name(s)
	* else returns array of template name(s)
	*/
	public static function listOut($asString = false)
	{
		self::isReady();
		$templates = glob(self::$template_path . '*.bt');
		return ($asString) ? implode(',', $templates) : $templates;
	}
	
	/*
	* assigns attributes replacement
	* return null
	*
	* @param string of name
	* @param string|array of attribute value
	*/
	public static function setAttribute($name, $value)
	{
		self::isReady();
		if (in_array($name, array('VERSION', 'DATE'))) {
			throw new BtException($name . ' is a reserved keyword');
		}
		self::$attributes[$name] = $value;	
	}
	
	/*
	* list out all attribute name and value
	* return array
	*/
	public static function listAttribute()
	{
		self::isReady();
		return self::$attributes;
	}
}
