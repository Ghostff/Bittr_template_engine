<?php
require_once 'Bittr' . DIRECTORY_SEPARATOR . '/init.php';
$bittr = new Bittr();
$bittr->setTemplatePath(__DIR__ . '/Bittr/Templates');

$bittr->assign('users', array('a' => 'aba', 'i' => 'imo', 'j' => 'jigawa'));



$bittr->render('test.bt');

