<?php
class Bitter extends Compiler
{
    public function set()
    {
		$args = $GLOBALS;
		$counted = func_get_args();
		$args = array_slice($args, -count($counted), count($counted), true);
		$i = 0;
		foreach ($counted as $keys => $values) {
			if (!is_array($values)) {
				foreach ($args as $n_keys => $n_values) {
					 if ($n_values === $values) {
						$this->attributes[$n_keys] = $n_values;
					 }
				}
			}
			else {
				$ky = key($values);
				$this->attributes[$ky] = $values[$ky];
			}
		}
    }
	public function setTemplatePath($pathname)
	{
		$this->template_dir = $pathname;
	}
	public function listTemplateFiles($type = null,$extention = null)
	{
		if ($extention) {
			$files = glob($this->template_dir . DSEP . '*' . $extention);
		}
		else {
			$files = glob($this->template_dir . DSEP . '*' . $extention);
		}
		$new = '';
		foreach ($files as $filpath) {
			if ($type == 'dump') {
				$new .= $this->dump(basename($filpath));
			}
			else {
				$new .= basename($filpath) . '<br />';
			}
		}
		return $new;
	}
    public function render($template_name, $attributes = null)
    {
        $this->checkUpdate(CHECK_UPDATE);
        if ($attributes) {
			if (is_array($attributes)) {
				$this->attributes[] = $attributes;
			}
			else {
				$this->erroHandl($this->lang('CANT_PAS_STR'), $this->lang('ER_LG'));
			}
                    
        }
        if ($this->isValidTemplate($template_name)) {
            $this->attributes['bitter'] = $this->staticAttributes();
            return $this->compile($this->template);    
        }
    }
}