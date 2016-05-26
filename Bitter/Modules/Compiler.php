<?php
class Compiler extends Casts
{
	protected $newattributes;
	/*	Set Attributes
	*	All alternative to second parameter render
	*	set attributes that will be passed into template
	* 	this becomes redundant if second parameter of render is not null
	*	@param  attributes (array) 
			eg array('name' => 'chrys') ...
    */
	public function set($attributes)
	{
		$this->newattributes = $attributes;
	}
	/*	Renders passed attributes into template file
	* 	@param template name (string) without extension 
	*	@param attributes (array) 
			eg array('name' => 'chrys') ...
    */
	public function render($templatename, $attributes = null)
	{
		if (!$attributes) {
			$attributes = $this->newattributes;
		}
		return $this->run(['load' => array($templatename),
						   'sandbox' => array(null),
						   'caches' => array(),
						  ],
						 $attributes);
	}
	
}