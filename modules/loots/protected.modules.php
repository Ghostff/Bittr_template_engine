<?php
class overload extends engine\template
{
	protected $template_dir;//where template files are stored (default: /templates)
	//error log handler
	protected function Log($error)
	{
		if ($this->dubuger_level > 3) {
			//invalid dubuger_level level
			return  $this->lang('INVL_DBG_LVL', array($this->dubuger_level));
		}
		else {
			//debug levels
			if ($this->dubuger_level == 1) {
				//debug level 1 (for development  dont use in production). outputs error to browser
				return $error;
			}
			elseif ($this->dubuger_level == 2) {
				//debug level 2 (for production) log error in file
				$this->infile(LOG.'/error_log.log', '['.DATE.'] '.$error.PHP_EOL);
				exit;
			}
			elseif ($this->dubuger_level == 3) {
				//debug level 3 (for development  dont use in production). outputs error to browser and log outputed error
				$this->infile(LOG.'/error_log.log', '['.DATE.'] '.$error.PHP_EOL);
				return '['.DATE.'] '.$error;
			}
		}
	}
	//error handler
	public function ErrorInfo($occured_error)
	{
		//prevent overwriting of errors
		if (empty($this->error) || $this->dubuger_level == 2) {
		    $this->error = $this->Log($occured_error);
		}
	}
	protected function stack($filename, $attribute)
	{
		if (!$this->template_dir) {
			//setting defualt directory for template files if non is selectedd
			$this->template_dir = TEMPLATE_DIR;
		}
		//make log folder if debug level is set to 2
		if (($this->dubuger_level == 2 || $this->dubuger_level == 3) && !is_dir(LOG)) {
			mkdir(LOG);
		}
		//check if file exists
		if ($this->dubuger_level && !file_exists($this->template_dir.$filename)) {
			//get specified file name and directory for accurate log
			return $this->ErrorInfo($this->lang('FILE_N_EXT', array($filename, $this->template_dir.$filename)));
		}
	}
	//file writing handler
	protected function infile($filename, $error_msg)
	{
		file_put_contents($filename, $error_msg, FILE_APPEND | LOCK_EX);
	}
	//language handler
	protected function lang($key, $markers = NULL)
	{
		global $lang;
		//Ensure language key exists
		if (!array_key_exists($key, $lang)) {
			return $this->ErrorInfo('No language key(' . $key . ') found');
		}
		else{
			if ($markers == NULL) {
				$string = $lang[$key];
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
}
