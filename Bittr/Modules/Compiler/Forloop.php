<?php

namespace Compiler;

class Forloop extends Payload
{
    private $last_matched = array();
    
    
    private function loopToLast(&$array, $new_val, $key)
    {
        if (is_array($array) && array_key_exists('sub', $array)) {
            $this->loopToLast($array['sub'], $new_val, $key);
        }
        else {
            $array[$key] = $new_val;
        }
    }
    
    public function __construct(&$thiz)
    {
        $this->otag = $thiz->otag;
        $this->ctag = $thiz->ctag;
        
        $spathern = '#\\' . $this->otag . '\s*for (.+) in (.+)\s*\\' . $this->ctag . '#';
        $epathern = '#\\' . $this->otag . '\s*\/for\s*\\' . $this->ctag . '#';
        
        $loop_count = $last_key = 0;
        foreach ($thiz->file_lines as $line_num => $lines) {
            if (preg_match($spathern, $lines, $matches)) {
                if ($loop_count > 0) {
                    $this->loopToLast($this->last_matched[$last_key], $matches, 'sub');
                }
                else {
                    $last_key = $this->uniqkey();
                    $this->last_matched[$last_key] = $matches;
                    $this->loopToLast($this->last_matched[$last_key], $line_num, 'frm');
                }
                $loop_count += 1;
                continue;
            }
            if (preg_match($epathern, $lines, $matched)) {
                $this->loopToLast($this->last_matched[$last_key], $line_num, 'to');
                $this->loopToLast($this->last_matched[$last_key], $matched[0], 'end');
                $loop_count -= 1;
                continue;
            }
            if ($loop_count > 0) {
                $this->loopToLast($this->last_matched[$last_key], trim($lines), 'cont');
            }
        }
        $thiz->rendered = $this->forloop($this->last_matched,
                          $thiz->attributes, $thiz->file_lines);
    }
}