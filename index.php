<?php
require_once('modules/controls.php');
$template = new bitter();
$template->dubuger_level = 3;

$datas = array('name' => 'chrys', 'email' => 'frankchris@hotmail.com');


if(!$template->error)
	echo $template->render('test.html', $datas);
else
	echo $template->error;

?>