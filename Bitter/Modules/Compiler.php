<?php
class Compiler extends Casts
{
	public function set($attributes)
	{
		$this->newattributes = $attributes;
	}
	public function render($templatename, $attributes = null)
	{
		if (!$attributes) {
			$attributes = $this->newattributes;
		}
		if ($this->er_flag == static::E_HIGH && trim($this->error) == true) {
			return $this->error;
		}
		else {
			if (in_array(SANDBOX_TYPE, array('1', '2')) && trim($this->error) == true) {
				echo $this->error . '<br />';
			}
			///Bitter compile
			echo 'sup';
		}
	}
	
}