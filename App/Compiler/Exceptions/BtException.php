<?php

namespace Exceptions;

class BtException extends \Exception
{
	
	function exception_handler($exception) {
		
		$message = $this->getMessage();
		$file = $this->getFile();
		$line = $this->getLine();
		$trace_array = $this->getTrace();
		$trace_string = $this->getTraceAsString();
		
		echo '<pre>Mesage: ' . $message . '<br>Line: ' . $line . '<br>File: ' . $file . '<pre>';
	}

	public function __construct($message = null, $code = 0)
	{
		set_exception_handler(array($this, 'exception_handler'));
		if (!$message) {
            throw new $this('Unknown '. get_class($this));
        }
        parent::__construct($message, $code);
		
	}
}
