<?php
class Filter extends Bcompiler
{
	private $output = null;
	
	private function filterError($function, $params)
	{
		if (!is_callable(array($this, $function))) {
			$this->newError($this->lang('FUNC_N_EXITS', array($function, 'Compiler::render')), static::E_HIGH);
		}
		else {
			$this->output = call_user_func_array(array($this, $function), $params);	
		}
		if ($this->er_flag == static::E_HIGH && trim($this->error) == true) {
			return $this->error;
		}
		else {
			if (in_array(SANDBOX_TYPE, array('1', '2')) && trim($this->error) == true) {
				$this->output =  $this->error . '<br />' . $this->output;
			}
			return $this->output;
		}
		
	}
	protected function run($modules, $attributes)
	{
		$attributes['BITTER'] = array('V' => VERSION, 'D' => RELEASE_DATE,
									  'VERSION' => VERSION, 'DATE' => RELEASE_DATE
									  );
		foreach ($modules as  $key => $params) {
			$this->output = $this->filterError($key, $params);
		}
		$this->newattributes = $attributes;
		return $this->output;
		//return $this->filterError($modules, count($modules));
	}
}