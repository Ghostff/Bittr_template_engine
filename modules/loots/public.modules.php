<?php
class bitter extends overload
{
	public function render($filename, $attribute = null)
	{
		$file = $this->stack($filename, $attribute);
		if(!$this->error){
			$engine = new engine\template();
			$engine->sglvo = TOPN;
			$engine->sglvc = TCLS;
			$engine->dbug_empty_attrs = DBG_EMPYT_ATRS;
			$engine->render($file, $attribute, $this->dubuger_level);
		}
	}
}
?>