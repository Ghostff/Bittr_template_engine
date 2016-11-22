<?php

use Compiler\Bittr as Bittr;

require 'src' . DIRECTORY_SEPARATOR . 'init.php';

//Remove on production
const DEVELOPMENT_ENV = true;

Bittr::setAttribute('name', 'FooBar');

var_dump(Bittr::compile('new'));