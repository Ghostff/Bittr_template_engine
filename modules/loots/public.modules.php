<?php
final class bitter extends overload
{
	public function render($filename, $attribute = null)
	{
		$file = $this->stack($filename, $attribute);
		if (!$this->error) {
			$engine = new engine\template();
			$engine->sglvo = TOPN;
			$engine->sglvc = TCLS;
			$engine->justUpper = UPER;
			$engine->dbug_empty_attrs = DBG_EMPYT_ATRS;
			return $engine->render($file, $attribute, $this->dubuger_level);
		} else {
			return $this->error;
		}
	}
}
