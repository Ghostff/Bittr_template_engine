<?php

use Compiler\Bittr as Bittr;

require 'src' . DIRECTORY_SEPARATOR . 'init.php';

//Bittr::setPath('App');
//Bittr::listOut(true);
//Bittr::setAttribute('name', 'hey chrys');
//Bittr::listAttribute();

Bittr::setAttribute('name', 'hey chrys');

var_dump( Bittr::compile('new') );