<?php
require_once('modules/controls.php');
$template = new bitter();
$template->dubuger_level = 1;

$datas = array('name' => 'chrys', 'title' => 'template engine', 'user' => array('fname' => 'chrys', 'mname' => 'chiderah', 'ugwu'));

echo $template->render('test.html', $datas);

?>