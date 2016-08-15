<?php

namespace Regex;
use Exceptions\BtException;

class Compiler
{
	private $file_lines = null;
	private $line_replacements = null;
	private $template_path = null;
	
	/*
	* hold inlcude and required template names to 
	* prevent including|requiring the same template
	* multiple times
	*/
	private $inc_req = array();
	
	private function FileHandler($fileLines, $workingTemplate)
	{
		var_dump($workingTemplate, $this->inc_req);
		foreach ($fileLines as $line_number => $line_value) {
				
				if (preg_match('/(req|inc)\s*[\'|"](.*?)[\'|"]/', $line_value, $matches)) {
					
					//var_dump($this->inc_req);
					//var_dump($workingTemplate.'--');
				
					if (! in_array($workingTemplate, $this->inc_req)) {
						$this->inc_req[] = $workingTemplate;
						
						$template = trim($matches[2]);
						$function = trim($matches[1]);
						$replacement = $matches[0];
						
						$new_replacment = FileHandler::req(
								$template,
								$this->template_path,
								$this->inc_req
						);
						$this->__construct(
							$new_replacment,
							$this->template_path,
							$this->template_path . $template
						);
					}
					else {
						$workingTemplate = str_replace($this->template_path, '', $workingTemplate);
						throw new BtException($workingTemplate . ' has already been included, aborting! ');
					}
					
				}
			
			
		}
		//var_dump($this->file_lines);
	}
	
	public function __construct($pathern, $templatePath, $workingTemplate, $replacements = null)
	{
		$this->file_lines = $pathern;
		$this->line_replacements = $replacements;
		$this->template_path = $templatePath;
		$this->FileHandler($pathern, $workingTemplate);
		
		//var_dump($pathern, $replacements);
	}
}