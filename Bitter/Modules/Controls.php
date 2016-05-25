<?php
class Controls extends Sandbox\Controls
{
	public function __construct()
	{
		//get latest version
		$latestversion = $this->getVersion();
		//get version of biter you are currently using
		$workingversion = static::VERSION;
		//check if working version is the latest
		if (SANDBOX && CHECK_UPDATE && $latestversion !== $workingversion) {
			//find diffrents between using script and latest
			$versiondiffrent = ($latestversion - $workingversion) * 10;
			if ($versiondiffrent < 4) {
				$this->newError($this->lang('UDATED_V_NL', array('#', $latestversion)), static::E_LOW);
			}
			else {
				$this->newError($this->lang('UDATED_V_L'), static::E_HIGH);
			}
		}
		else {
			
		}
		//check for new version of bitter
		
	}
	
}