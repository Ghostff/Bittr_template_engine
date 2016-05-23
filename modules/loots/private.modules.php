<?php
namespace engine;

class template
{
	private $Newfile = null;
	private $attributes = null;
	public function NewEngine($file, $attributes, $debug_level)
	{
		//set defualt dubug level
		$this->dubuger_level = $debug_level;
		//pupulate attribute 
		$this->attributes = $attributes;
		//get template file contents
		$this->Newfile =  $this->SingleVars(file_get_contents($file));
		//$this->Newfile =  $this->FEach($this->Newfile);
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
				if (is_array($new_values)){
					foreach ($new_values as $new_ky => $vals) {
						$pathern[] = '#\\' . $this->sglvo.'\s*' . $name . '\s*.\s*' . $new_ky . '\s*\\' . $this->sglvc . '#' . $case_sensitive;
						$values[] = $vals;
					}
				}
				else {
					$pathern[] = '#\\' . $this->sglvo.'\s*' . $name . '\s*\\' . $this->sglvc . '#' . $case_sensitive;
					$values[] = $new_values;
				}
			}
			//var_dump($pathern);
			return preg_replace($pathern, $values, $file);
		}
	}
	//foreach replacement
	private function FEach($file)
	{
		if (count($this->attributes) > 0){
			$for = $key = $value = '';
			preg_match_all("/\|FOR(.*?)\|ENDFOR\|/s", $file, $output);
			$query =  explode('|', $output[0][0]);
			$query = preg_split("/\s+/s", $query[1]);
			if (!in_array($query[1], array('FOR', 'AS', 'TO'))) {
				$for = $query[1];
			}
			else {
				$this->ErrorInfo($this->lang('INVL_FEAHC'));
			}
			if (in_array('TO', $query)) {
				if (!in_array($query[3], array('FOR', 'AS', 'TO'))) {
					$key = $query[3];
				}
				else {
					$this->ErrorInfo($this->lang('INVL_FEAHC'));
				}
				if (!in_array($query[5], array('FOR', 'AS', 'TO'))) {
					$value = $query[5];
				}
				else {
					$this->ErrorInfo($this->lang('INVL_FEAHC'));
				}
			}
			else {
				if (!in_array($query[3], array('FOR', 'AS', 'TO'))) {
					$value = $query[3];
				}
				else {
					$this->ErrorInfo($this->lang('INVL_FEAHC'));
				}
			}
			//$for = (!in_array($query[1], array('for', 'as', 'key'))? $query[1]

		}
		var_dump($for, $key, $value);
		
	}
}
