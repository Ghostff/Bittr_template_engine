<?php
class Loader extends Filter
{
	protected $template = null;
	protected $Nfile = null;
	protected function load($templatename)
	{
		$this->Nfile = TMPLT_DIR . $templatename . TPL_EX;
		if (!file_exists($this->Nfile)) {
			$this->newError($this->lang('TPL_LD_FAIL', array($templatename, TMPLT_DIR)), static::E_HIGH);
		}
		else {
			$this->template = file_get_contents($this->Nfile);
		}
	}
}