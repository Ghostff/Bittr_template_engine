<?php
namespace Sandbox;

class Controls extends \Loader
{
	private function toFileAndOutput($errormessage, $flag, $pathtonewdir)
	{
		$this->makeDir($pathtonewdir);
		$this->er_flag = $flag;
		$this->error = $errormessage;
		$filename = $pathtonewdir . DSEP . $flag . '.log';
		$filedata = '[' . $flag . '][' . DATE . ']: ' . $errormessage . PHP_EOL;
		$this->newFile($filename, $filedata);
	}
	private function toFile($errormessage, $flag, $pathtonewdir)
	{
		$this->makeDir($pathtonewdir);
		$filename = $pathtonewdir . DSEP . $flag . '.log';
		$filedata = '[' . $flag . '][' . DATE . ']: ' . $errormessage . PHP_EOL;
		$this->newFile($filename, $filedata);
	}
	private function toOutput($errormessage, $flag)
	{
		$this->er_flag = $flag;
		$this->error = $errormessage;
	}
	protected function newError($errormessage, $flag = null)
	{
		$pathtonewdir =  dirname(__FILE__) . DSEP . '..' . DSEP . '..' . DSEP . 'Logs';
		//output error to browser
		if (SANDBOX_TYPE == 1) {
			if ($flag == static::E_LOW) {
				$this->toOutput($errormessage, $flag);
			}
			elseif ($flag == static::E_HIGH) {
				$this->toOutput($errormessage, $flag);
			}
			else {
				die($this->lang('INVAL_E_FLAG'));
			}
		}
		//log and output error to browser
		elseif (SANDBOX_TYPE == 2) {
			if ($flag == static::E_LOW) {
				$this->toFileAndOutput($errormessage, $flag, $pathtonewdir);
			}
			elseif ($flag == static::E_HIGH) {
				$this->toFileAndOutput($errormessage, $flag, $pathtonewdir);
			}
			else {
				die($this->lang('INVAL_E_FLAG'));
			}
		}
		//log error to a file
		elseif (SANDBOX_TYPE == 3) {
			if ($flag == static::E_LOW) {
				$this->toFile($errormessage, $flag, $pathtonewdir);
			}
			elseif ($flag == static::E_HIGH) {
				$this->toFile($errormessage, $flag, $pathtonewdir);
			}
			else {
				die($this->lang('INVAL_E_FLAG'));
			}
		}
		else {
			die($this->lang('INVAL_SBOX', array(SANDBOX_TYPE)));
		}
	}
}