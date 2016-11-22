<?php

use Compiler\Bittr as Bittr;

//Remove on production
const DEVELOPMENT_ENV = true;

require 'src' . DIRECTORY_SEPARATOR . 'init.php';

Bittr::setAttribute('name', 'FooBar');

var_dump( Bittr::listAttribute() );

//var_dump( Bittr::compile('new') );