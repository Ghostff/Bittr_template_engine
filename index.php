<?php

require 'src' . DIRECTORY_SEPARATOR . 'init.php';

echo (new Compiler\Render())->view(['inc']);