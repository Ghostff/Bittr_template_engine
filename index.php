<?php
require_once 'Bitter' . DIRECTORY_SEPARATOR . '/init.php';
$bitter = new Compiler();
echo $bitter->render('index.html');