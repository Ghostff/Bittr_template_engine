<?php
class Functions extends Bitter
{
	//language handler
	protected function lang($key, $markers = null)
	{
		
		global $lang;
		//Ensure language key exists
		if (!array_key_exists($key, $lang)) {
			return $this->ErrorInfo('No language key(' . $key . ') found');
		}
		else{
			if ($markers == NULL) {
				return $lang[$key];
			}
			else{
				//Replace any dyamic markers
				$string = $lang[$key];
				$iteration = 1;
				foreach ($markers as $marker) {
					$string = str_replace("%m" . $iteration . "%", $marker, $string);
					$iteration++;
				}
				return $string;
			}
		}
	}
	//make and write to a file
	protected function newFile($pathandname, $write)
	{
		file_put_contents($pathandname, $write, FILE_APPEND | LOCK_EX);
	}
	//make dir
	protected function makeDir($pathandname)
	{
		//check if directory does not exit
		if (!is_dir($pathandname)) {
			mkdir($pathandname);
		}
		else {
			return;
		}
	}
}