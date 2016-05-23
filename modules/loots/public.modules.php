<?php
class bitter extends overload
{
	public $sglvo = null;//single value open  default( '{{' );
	public $sglvc = null;//single value close default( '}}' );
	public $dubuger_level = null;
	public $justUpper = false;
	public $error = array();
	public function render($filename, $attribute = null)
	{
		$this->sglvo = TOPN;
		$this->sglvc = TCLS;
		$this->justUpper = UPER;
		$file = $this->stack($filename, $attribute);
		$rendered = $this->NewEngine($this->template_dir.$filename, $attribute, $this->dubuger_level);
		if (!$this->error) {
			return $rendered;
		}
		else {
			return $this->error;
		}
		
	}
}
