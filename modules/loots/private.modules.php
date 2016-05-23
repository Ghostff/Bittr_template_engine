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
		$this->Newfile =  file_get_contents($file);
		$this->Newfile =  $this->FEach($this->Newfile);
		$this->Newfile =  $this->SingleVars($this->Newfile);
		return $this->Newfile;
	}
	//single var replacement
	private function SingleVars($file)
	{
		if (count($this->attributes) > 0) {
			$pathern = $values = array();
			$case_sensitive = 'i';
			foreach ($this->attributes as $name => $new_values) {
				if ($this->justUpper) {
					$name = strtoupper($name);
					$case_sensitive = '';
				}
				if (is_array($new_values)){
					foreach ($new_values as $new_ky => $vals) {
						if ($this->justUpper) {
							$new_ky = strtoupper($new_ky);
						}
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
		if (count($this->attributes) > 0) {
			$for = $key = $value = '';
			preg_match_all("/\|FOR (.*?)\|ENDFOR\|/s", $file, $output);
			$output = array_filter($output);
			if (!empty($output)) {
				preg_match('/\|FOR (.*?)\|(.*?)\|ENDFOR\|/s', $output[0][0], $body);
				$query = preg_split("/\s+/s", $body[1]);
				if (!in_array($query[0], array('AS', 'TO'))) {
					$for = strtolower($query[0]);
				}
				else {
					$this->ErrorInfo($this->lang('INVL_FEAHC'));
				}
				if (in_array('TO', $query)) {
					if (!in_array($query[2], array('AS', 'TO'))) {
						$key = strtolower($query[2]);
					}
					else {
						$this->ErrorInfo($this->lang('INVL_FEAHC'));
					}
					if (!in_array($query[4], array('AS', 'TO'))) {
						$value = strtolower($query[4]);
					}
					else {
						$this->ErrorInfo($this->lang('INVL_FEAHC'));
					}
				}
				else {
					if (!in_array($query[2], array('AS', 'TO'))) {
						$value = strtolower($query[2]);
					}
					else {
						$this->ErrorInfo($this->lang('INVL_FEAHC'));
					}
				}
				if (empty($key)) {
				}
				else {
					$new_replace = '';
					foreach($this->attributes[$for] as $n_key => $n_value){
						if ($this->justUpper) {
							$key = strtoupper($key);
							$value = strtoupper($value);
							$case_sensitive = '';
						}
						$pathern[] = '#\\' . $this->sglvo.'\s*' . $key . '\s*\\' . $this->sglvc . '#' . $case_sensitive;
						$values[] = $n_key;
						$pathern[] = '#\\' . $this->sglvo.'\s*' . $value . '\s*\\' . $this->sglvc . '#' . $case_sensitive;
						$values[] = $n_value;
						$new_replace .= preg_replace($pathern, $values, trim($body[2]));
						unset($pathern, $values);
					}
					return str_replace($body[0], $new_replace, $file);
				}
			}
			else {
				$this->ErrorInfo($this->lang('INVL_FEAHC'));
			}
		}
		
	}
}
