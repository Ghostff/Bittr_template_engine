<?php
class Compiler extends Casts
{
	private $file_contents = null;
	private $file_lines = null;
	private $sensitive = null;
	private $not_recursed = true;
	private $last_include = null;
	private function singleFallback($new_values, &$pathern, &$replace)
	{
		if (is_array($new_values)) {
			$recurse = null;
			$itterate = '';
			if ($this->not_recursed && is_int($pathern)) {
				$pathern = '';
			}
			else {
				$itterate = '\s*\.\s*';
			}
			$temp_key = '';
			foreach ($new_values as $new_ky => $n_vals) {
				$recurse = $n_vals;
				$pathern .=  $itterate . $new_ky;
				$replace = $n_vals;
				$temp_key = $new_ky;
			}
			$this->not_recursed = false;
			$this->singleFallback($recurse, $pathern, $replace);
		}
		$this->not_recursed = true;
	}
	private function singleCallback($name, $new_values)
	{
		if (is_int($name)){
			foreach ($new_values as $ptr => $lptr) {
				$this->attributes[$ptr] = $lptr;
				$this->singleCallback($ptr, $lptr);
			}
			unset($this->attributes[$name]);
		}
	}
	private function incFallBaclk($character)
	{
		$pathern = '#\\' . STAG . '\s*(INC|INCLUDE)\s*\'(.*?)\'\s*\\' . ETAG . '#' . $this->sensitive;
		if (preg_match_all($pathern, $character, $matches)) {
			foreach ($matches[0] as $key => $values) {
				 $extension = pathinfo($matches[2][$key], PATHINFO_EXTENSION);
				 if (trim($extension) == false) {
					$matches[2][$key] .= TPL_EX; 
				 }
				 $template = TMPLT_DIR . $matches[2][$key];
				 if ($template == $this->last_include) {
					 die($this->erroHandl($this->lang('INC_IN_SELF', array($template)), $this->lang('ER_LG')));
				 }
				 else {
					 if (!file_exists($template)) {
						$this->erroHandl($this->lang('INC_N_EXT', array($matches[2], '')), $this->lang('ER_LG'));
					 }
					 else {
						$character = str_replace($values, file_get_contents($template), $character); 
						$this->last_include = $template;
					 }
				 }
			}
			$character = $this->incFallBaclk($character);
		}
		return $character;
	}
	private function singlvar()
	{
		if (count($this->attributes) > 0) {
			$replaces = $pathern = $replace = '';
			foreach ($this->attributes as $name => $new_values) {
				$this->singleCallback($name, $new_values);
			}
			foreach ($this->attributes as $name => $new_values) {
				$this->singleCallback($name, $new_values);
				$n_pathern = $name;
				$n_replace = $new_values;
				$this->singleFallback($new_values, $n_pathern, $n_replace);
				$pathern[] = '#\\' . STAG . '\s*' . $n_pathern . '\s*\\' . ETAG . '#' . $this->sensitive;
				$replace[] = $n_replace;
			}
			return preg_replace($pathern, $replace, $this->file_contents);
		}
	}
	private function fileInclude($filename)
	{
		$this->file_contents = $this->incFallBaclk($this->file_contents);

	}
	protected function compile($file_name)
	{
		$this->file_lines = file($file_name);
		$this->file_contents = file_get_contents($file_name);
		$this->sensitive = (CAP_REC) ? '' : 'i';
		$rendered = $this->fileInclude($file_name);
		$rendered .= $this->singlvar();
		return $rendered;
		
	}
	
}