<?php
class Bitter extends Compiler
{
	public function set($attributes)
	{
		$this->attributes = $attributes;
	}
	public function render($template_name, $attributes = null)
	{
		$this->checkUpdate(CHECK_UPDATE);
		if ($attributes) {
			$this->attributes[] = $attributes;		
		}
		if ($this->isValidTemplate($template_name)) {
			$this->attributes[] = $this->staticAttributes();
			return $this->compile($this->template);	
		}
	}
}