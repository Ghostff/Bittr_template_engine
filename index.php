<?php
require_once 'Bitter' . DIRECTORY_SEPARATOR . '/init.php';
$bitter = new Bitter();

$m['user'] = array(
					array('fname' => 'chrys', 'lname' => array('named' => 'chiderah')), 
				    array('fname' => 'chiderah', 'lname' => 'uwgu')
			);


$bitter->set($fname = 'chrys', $lname = 'ugwu', $m, $title = 'Bitter Template Engine');

echo $bitter->render('test');

