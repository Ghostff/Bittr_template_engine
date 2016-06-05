<?php
class Compiler extends Casts
{
    private $file_contents = null;
    private $file_lines = null;
    private $not_recursed = true;
    private $last_include = null;

	private function getNestedVar(&$context, $name) 
	{
		$pieces = explode('.', $name);
		foreach ($pieces as $piece) {
			if (!is_array($context) || !array_key_exists(trim($piece), $context)) {
				// error occurred
				return null;
			}
			$context = &$context[$piece];
		}
		return $context;
	}
	private function predifFuncs($fall, $flags)
	{
		$flags = explode('.', $flags);
		if (is_callable(array($this, $flags[0]))) {
			if ($flags[0] != 'dump') {
				$new_flag = $flags;
				array_shift($new_flag);
				$partern = call_user_func(array($this, $flags[0]), $fall, $new_flag);
			}
			else {
				$partern = call_user_func(array($this, $flags[0]), $fall);
			}
			return $partern;
		}
	}
    private function incFallBaclk($character)
    {
        $pathern = '#\\' . STAG . '\s*(inc|req)\s*\'(.*?)\'\s*\\' . ETAG . '#';
        if (preg_match_all($pathern, $character, $matches)) {
            foreach ($matches[0] as $key => $values) {
                 $extension = pathinfo($matches[2][$key], PATHINFO_EXTENSION);
                 if (trim($extension) == false) {
                    $matches[2][$key] .= TPL_EX; 
                 }
                 $template = $this->template_dir . $matches[2][$key];
                 if ($template == $this->last_include) {
                     die($this->erroHandl($this->lang('INC_IN_SELF', array($template)), $this->lang('ER_LG')));
                 }
                 else {
					 //determine if include or require
					 $tag = str_replace(STAG, '', $matches[0][$key]);
					 if (substr(trim($tag), 0 , 3) == 'req') {
						 if (!file_exists($template)) {
							$this->erroHandl($this->lang('INC_N_EXT', array($matches[2][$key], $template)), $this->lang('ER_LG'));
						 }
					 }
					 @$character = str_replace($values, file_get_contents($template), $character); 
					 @$this->last_include = $template;
                 }
            }
            $character = $this->incFallBaclk($character);
        }
        return $character;
    }
    private function singlvar()
    {
        if (count($this->attributes) > 0) {
			$pathern = '#\\' . STAG . '\s*(.*?)\s*\\' . ETAG . '#';
			preg_match_all($pathern, $this->file_contents, $matches);
			$pathern = $replaces = $funcs = '';
			foreach($matches[1] as $key => $values) {	
				if (strpos($values, '.')) {	
					if (strpos($values, '|')) {
						$funcs  = strstr($values, '|');
						$values = strstr($values, '|', true);
					}
					
					$array = strstr($values, '.', true);
					if (array_key_exists($array, $this->attributes)) {
						foreach ($this->attributes[$array] as $nw_keys => $new_values) {
							if (is_array($new_values)) {
								//more itte
								$ptr = str_replace($array . '.', '', $values);
								$handled = $this->getNestedVar($new_values, $ptr);
							}
							else {
								$handled = $new_values;
							}
							if (($funcs) == true) {
								$handled = $this->predifFuncs($handled, str_replace('|', '', $funcs));
							}
							if (empty($handled)) {
								continue;
							}
							$pathern[] = $matches[0][$key];
							$replaces[] = $handled;
						}
					}
				}
				else {
					if (strpos($values, '|')) {
						$funcs  = strstr($values, '|');
						$values = strstr($values, '|', true);
					}
					if (array_key_exists($values, $this->attributes)) {
						$handled = $this->attributes[$values];
						if (trim($funcs) == true) {
							$handled = $this->predifFuncs($handled, str_replace('|', '', $funcs));
						}
						$pathern[] = $matches[0][$key];
						$replaces[] = $handled;
					}
				}
				
			}
			//echo $this->dump($pathern, $replaces);
			$this->file_contents = str_replace($pathern, $replaces, $this->file_contents);
        }
    }
    private function fileInclude($filename)
    {
        $this->file_contents = $this->incFallBaclk($this->file_contents);
    }


	
    protected function compile($file_name)
    {
        $this->file_lines = file($file_name);
        $this->file_contents = file_get_contents($file_name);
        $this->fileInclude($file_name);
		
		
		$this->singlvar();
        return $this->file_contents;
        
    }
    
}