<?php

namespace Config;

interface ConfigInterface
{
	public static function setPath($newPath);
	public static function listOut($asString = false);
	
	public static function setAttribute($name, $value);
	public static function listAttribute();
}
