<?php

namespace Compiler;

class IncReq extends Payload
{
    public function __construct(&$thiz)
    {
        $this->otag = $thiz->otag;
        $this->ctag = $thiz->ctag;

        $thiz->rendered = $this->includeRequire($thiz->template,
                          $thiz->file_lines, $thiz->template_dir);
    }
}