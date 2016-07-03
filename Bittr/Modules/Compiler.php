<?php

class Compiler extends Cast
{
    public $file_lines = null;
	public $rendered = null;
	
	public $template_dir = null;
	public $template = null;

	
	private function recredundancy()
	{
		$pathern1 = '#\\' . $this->otag . '\s*(inc|req)\s*\'(.*?)\'\s*\\' . $this->ctag . '#';
		$pathern2 = '#\\' . $this->otag . '\s*for (.+) in (.+)\s*\\' . $this->ctag . '#';
		$pathern3 = '#\\' . $this->otag . '\s*(.+)s*\\' . $this->ctag . '#';
		
		$file_content = file_get_contents($this->template);
		
		if (preg_match($pathern1, $file_content)) {
			new \Compiler\IncReq($this);	
		}
		if (preg_match($pathern2, $file_content)) {
			new \Compiler\Forloop($this);	
		}
		if (preg_match($pathern3, $file_content)) {
			new \Compiler\Variable($this);	
		}
		echo $this->rendered;
	}
	
    public function compile()
    {
		$this->file_lines = file($this->template);
		$this->recredundancy();
		
    }
    
}