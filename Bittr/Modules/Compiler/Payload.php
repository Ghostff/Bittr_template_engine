<?php

namespace Compiler;

class Payload
{
    protected $file_content = null;
    protected $otag = null;
    protected $ctag = null;
    
    private $used_keys = array();
    
    
    protected function uniqkey()
    {
        $rand = mt_rand();
        if (!in_array($rand, $this->used_keys)) {
            $this->used_keys[] = $rand;
            return $rand;
        }
        else {
            return $this->uniqKey();
        }
    }
    
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
    
    protected function variable($attribute, $nexted, $tag = null)
    {
        if (is_array($attribute)) {
            $attribute = implode('', $attribute);
        }

        $pathern = '#\\' . $this->otag . '\s*(.+)s*\\' . $this->ctag . '#';
        preg_match_all($pathern, $attribute, $matches);
        
        foreach ($matches[1] as $key => $values) {
            
            $values = trim($values);
            
            @list($next, $func) = explode('|', $values);
            $compiled = $this->getNestedVar($nexted, $next);    
            
            if ($compiled) {
                if (@$func && substr($func, 0, 4) == 'dump') {
                    //$compiled = new Functions\Dump($compiled);    
                }
                
                if (is_array($compiled)) {
                    if ($tag) {
                        $compiled = $this->getNestedVar($compiled, $tag);    
                    }
                    else {
                        $compiled = 'Array';
                    }
                }
                $attribute = str_replace($matches[0][$key], $compiled, $attribute);
            }
                    
        }
        
        return $attribute;
    }
    
    protected function includeRequire($template, &$file, $directory)
    {
        foreach ($file as $curent_line => $file_line) {
            $pathern = '#\\' . $this->otag . '\s*(inc|req)\s*\'(.*?)\'\s*\\' . $this->ctag . '#';
            preg_match($pathern, $file_line, $matches);
            if ($matches) {
                
                $file_exist = false;
                $filename = $matches[2];
                if (file_exists($filename)){
                    $file_exist = true;
                    $filename = file($filename);
                }
                elseif (file_exists($directory . '/' . $filename)) {
                    $file_exist = true;
                    $filename = file($directory . '/' . $filename);
                }
                else {
                    if ($matches[1] == 'req') {
                        die('the file "' . $filename . '" does not exist.
                            [Also "' . $directory . '/' . $filename .'" Does not exist
                            either]'
                        );
                    }
                }
                if ($file_exist) {
                    unset($file[$curent_line]);
                    $file = array_merge($filename, $file);
                }
                
            }
        }
        
    }
    
    protected function forloop($matched, $attributes, $file = null)
    {
        foreach($matched as $keyed => $val) {
            $val[1] = trim($val[1]);
            $val[2] = trim($val[2]);
            
            $new_content = '';
            if (array_key_exists($val[2], $attributes)) {
                if (array_key_exists('cont', $val)) {
                    $content = $val['cont'];
                    $new_attribute[$val[1]] = $attributes[$val[2]];
                    foreach ($attributes[$val[2]] as $kys => $vals) {
                        
                        $pathern = '#\\' . $this->otag . '\s*key\s*\\' . $this->ctag . '#';
                        $tampered = preg_replace($pathern, $kys, $content);
                        $new_content .= $this->variable($tampered, $new_attribute, $kys);
                        
                    }
                }
            }
            
            for ($i = $val['frm']; $i <= $val['to']; $i++) {
                if ($i == $val['frm']) {
                    $file[$i] = $new_content;
                }
                else{
                    unset($file[$i]);
                }
            }
        }
        return implode('', $file);
    }
}