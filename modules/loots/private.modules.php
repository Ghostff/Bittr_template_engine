<?php
namespace engine;

class template
{
	public $error = array();
	private $dubuger_level = null;
	private $Newfile = null;
	private $attributes = null;
	public $sglvo = null;//single value open  default( '{{' );
	public $sglvc = null;//single value close default( '}}' );
	public $justUpper = false;
	public function render($file, $attributes, $debug_level)
	{
		//set defualt dubug level
		$this->dubuger_level = $debug_level;
		//pupulate attribute 
		$this->attributes = $attributes;
		//get template file contents
		$this->Newfile =  $this->SingleVars(file_get_contents($file));
		$this->Newfile =  $this->FEach($this->Newfile);
		return $this->Newfile;
	}
	//single var replacement
	private function SingleVars($file)
	{
		if (count($this->attributes) > 0){
			//match key name if file
			$pathern = $values = array();
			$case_sensitive = '';
			foreach ($this->attributes as $name => $new_values) {
				if ($this->justUpper) {
					$name = strtoupper($name);
					$case_sensitive = 'i';
				}
				$pathern[] = '#\\' . $this->sglvo.'\s?' . $name . '\s?\\' . $this->sglvc . '#' . $case_sensitive;
				$values[] = $new_values;
			}
			return preg_replace($pathern, $values, $file);
		}
	}
	//foreach replacement
	private function FEach($file)
	{
		return $file;
	}
}
