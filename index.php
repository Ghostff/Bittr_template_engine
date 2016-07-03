<?php
require_once 'Bittr' . DIRECTORY_SEPARATOR . '/init.php';
$bittr = new Bittr();
$bittr->setTemplatePath(__DIR__ . '/Bittr/Templates');

/*$m['user'] = array(
					array('fname' => 'chrys', 'lname' => array('named' => 'chiderah')), 
				    array('fname' => 'chiderah', 'lname' => 'uwgu')
			);


$bittr->set($fname = 'chrys', $lname = 'ugwu', $title = 'Bitter Template Engine', $m);
$bittr->assign('name', 'chidex');*/
$bittr->assign('users', array('a' => 'aba', 'i' => 'imo', 'j' => 'jigawa'));



$bittr->render('test.bt');

