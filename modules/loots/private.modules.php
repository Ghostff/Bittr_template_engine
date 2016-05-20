<?php
namespace engine;
class template
{
	public $error = array();
	private $dubuger_level;
	private $Newfile;
	private $attributes;
	public $sglvo;//single value open  default( '{{' );
	public $sglvc;//single value close default( '}}' );
	public $dbug_empty_attrs;//debug empyt or un replaced attributes
	public function render($file, $attributes, $debug_level)
	{
		//set defualt dubug level
		$this->dubuger_level = $debug_level;
		//get template file contents
		$this->Newfile =  file_get_contents($file);
		//pupulate attribute 
		$this->attributes = $attributes;
		//check for single value replacement
		$this->SingleVars();
	}
	private function SingleVars()
	{
		//match key name if file
		$pathern = $values = array();
		foreach($this->attributes as $name => $new_values){
			$pathern[] = '/'.$this->sglvo.'\s?$name\s?'.$this->sglvc.'/';
			$values[] = $new_values;
		}
		return preg_replace($pathern, $values, $this->Newfile);
	}
}


?>