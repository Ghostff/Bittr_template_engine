<?php
require_once 'Bitter' . DIRECTORY_SEPARATOR . '/init.php';
$bitter = new Bitter();
$m = array('FNAME' => 'uwgu', 'LNAME' => 'chrys');
$c = array('CLASS' => 'cosc', 'SCH' => 'hccs', array('TD' => array('M' => 'SUP')));
$m[] = $c;
$g = array('USER' => array('TYPE' => array('NAME' => 'chiderah')));
$m[] = $g;
$bitter->set( $m );
echo $bitter->render('test');

