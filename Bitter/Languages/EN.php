<?php
/*
%m(0-9)% - Dymamic markers which are replaced at run time by the relevant index.
*/
$lang = array();
//file errors
$lang = array_merge($lang,array(
	'FILE_N_EXT' 		=> 'The template \'%m1%\' does not exist. specified path: \'%m2%\'',
	'INVL_DBG_LVL' 		=> 'invalid debuger level(\'%m1%\')',
	'INVL_FEAHC' 		=> 'Invalid query on foreach ',
	));

//file errors
$lang = array_merge($lang,array(
	'UDATED_V_NL' 		=> 'A new version of Bitter is out <a href="%m1%">Download v%m2%.zip </a>',
	'UDATED_V_L' 		=> 'This version of Bitter is outdated',
	'INVAL_E_FLAG' 		=> 'Invalid flag: \'%m1%\' used at \'%m2%\' and was found on Casts.php',
	'INVAL_SBOX' 		=> 'Invalid SANDBOX_TYPE \'%m1%\'',
	));
