<?php
namespace Sandbox;

class Debug extends \Loader
{
	private $new_file = null;
	protected function sandbox()
	{
		if (SANDBOX) {
			$this->new_file = file($this->Nfile);
			foreach($this->new_file as $lnumber => $lwords){
				echo $lnumber.':  '.$lwords.'<br>';
			}
			
		}
	}
}