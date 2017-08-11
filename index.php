<?php

require 'src' . DIRECTORY_SEPARATOR . 'init.php';

(new Compiler\Render())->view(['inc']);