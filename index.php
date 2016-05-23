<?php
require_once('modules/controls.php');
$template = new bitter();
$template->dubuger_level = 1;

$datas = array('name' => 'chrys', 'title' => 'hey');

echo $template->render('test.html', $datas);

?>