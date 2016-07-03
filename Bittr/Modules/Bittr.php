<?php

class Bittr extends Compiler
{	
	/*
	*	assign varibales
	*	@param1 varibale name
	*	@param2 value (mxied datatype)
	*/
	public function assign($name, $value)
	{
		$this->attributes[$name] = $value;
	}
	/*
	*	set the path to template files
	*/
	public function setTemplatePath($pathname)
	{
		$this->template_dir = $pathname;
	}


    public function render($template_name, $attributes = null)
    {
		if ($attributes) {
			$this->attributes[] = $attributes;
        }
		$this->template = $this->template_dir . '/' . $template_name;
		$this->compile();
    }
}