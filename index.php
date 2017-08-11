<?php

require 'src' . DIRECTORY_SEPARATOR . 'init.php';

var_dump( (new Compiler\Render())->view(['inc']));