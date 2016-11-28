<?php

namespace Compiler;
use \Config\Config;

class Template
{
    //holds uncompiled template string
    private $lines = array();
    
    public static $name = null;
    
    public static $line_number = 0;
    
    
    //opening tag identifier
    public static $open = null;
    
    //closing tag identifier
    public static $close = null;
    /*
    * Construct
    *
    * return void
    * @param (mixed) string to compile
    */
    public function __construct($template_array, $name)
    {
        $this->lines = $template_array;
        static::$name = $name;
        
        $this->req_ptn = '/' . static::$open . '\s*(req|inc) \'(.*?)\'\s*' . static::$close .'/';
        $this->var_ptn = '/' . static::$open . '\s*(\w+)([\.\w]*|(\s*<(.*?)>)*|\s*=\s*\'(.*?)\')\s*' . static::$close .'/';
        
        $this->if_ptn = '/' . static::$open . '\s*' . Config::$statement['if'] . ' (\w+)(<>)*\s*' . static::$close .'/';
        $this->endif_ptn = '/' . static::$open . '\s*' . Config::$statement['endif'] . '\s*' . static::$close . '/';
		
		$this->lb_ptn = '/\[\s*label: \'.*?\'\s*(.*)\]/';
        
    }
    
    private function checkfileSystem($strings, &$line_content, $line)
    {
        if (preg_match_all($this->req_ptn, $strings, $matched)) {
            \Sandbox\GetFile::evaluate($matched, $line_content, $line, static::$name);
        }
    }
    
    private function checkVaribales($strings, &$line_content, $line)
    {
        reExec: {
            if (preg_match_all($this->var_ptn, $strings, $matched)) {
                $varible = \Sandbox\Variable::evaluate($matched, $line_content, $line, static::$name);
                if ($varible == 'reExec') {
                    $strings = $line_content[$line];
                    goto reExec;    
                }
            }
        }
    }
    
    private function checkStatement($strings, &$line_content, $line, &$if_attribute, &$is_if_body, &$if_count)
    {
        if (preg_match($this->if_ptn, $strings, $matched)) {
            if ($if_count > 0) {
                $if_attribute[] = array($line, $matched[0]);
            }
            else {
                $if_attribute[] = array($line, $matched);
            }
            $if_count++;
            $is_if_body = true;
            return true;
        }
        elseif (preg_match($this->endif_ptn, $strings, $matched)) {
            if ($if_count == 1) {
                $if_attribute[] = array($line, $matched);
                $is_if_body = false;
                \Sandbox\Statement::evaluate($if_attribute, $line_content);
            }
            else {
                $if_attribute[] = array($line, $matched[0]);
            }
            $if_count--;
            return true;
            
        }
        elseif ($is_if_body) {
            $if_attribute[] = array($line, $strings);
            return true;
        }
        return false;
    }
    
	private function checkLabel($strings, &$line_content, $line)
	{
		if (preg_match($this->lb_ptn, $strings, $matched)) {
			\Sandbox\Label::evaluate($matched, $line_content, $line);
		}
	}
    
    private function getSyntax($line_content, $line_number = null)
    {
        $new_String = null;
        
        $if_attribute = array();
        $is_if_body = false;
        $if_count = 0;

        foreach ($line_content as $line => $strings) {
            
            static::$line_number = ($line_number) ? $line_number : $line;
			$this->checkLabel($strings, $line_content, $line);
            if ($this->checkStatement($strings, $line_content, $line, $if_attribute, $is_if_body, $if_count)) {
                continue;
            }
            $this->checkfileSystem($strings, $line_content, $line);
            $this->checkVaribales($strings, $line_content, $line);

        }
        return $line_content;
    }
    
    /*
    * compiles template
    *
    * return string
    */
    public function compile()
    {
        return $this->getSyntax($this->lines);
    }
}