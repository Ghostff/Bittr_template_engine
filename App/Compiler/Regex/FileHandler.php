<?php

namespace Regex;

class FileHandler
{
	public static function req($fileName, $path, &$required)
	{
		if (file_exists($path . $fileName)) {
			$required[] = $path . $fileName;
			return file($path . $fileName);
		}
		else {
			throw new Exceptions\BtException(
				'req file: ' . $fileName . ' Does not exist'
			);
		}
	}
	
	public static function inc($fileName, $path, &$required)
	{
		if (file_exists($path . $fileName)) {
			$required[] = $path . $fileName;
			return file($path . $fileName);
		}
	}
}
