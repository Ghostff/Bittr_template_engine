<?php

namespace Compiler;

class Variable extends Payload
{
    public function __construct(&$thiz)
    {
        $this->otag = $thiz->otag;
        $this->ctag = $thiz->ctag;
        
        $thiz->rendered = $this->variable($thiz->rendered, $thiz->attributes);
    }
}