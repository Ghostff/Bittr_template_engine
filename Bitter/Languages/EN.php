<?php
/*
%m(0-9)% - Dymamic markers which are replaced at run time by the relevant index.
*/
$lang = array();
//file errors
$lang = array_merge($lang,array(
	'FILE_N_EXT' 		=> 'The template \'%m1%\' does not exist. specified path: \'%m2%\'',
	'INC_N_EXT' 		=> 'Include \'%m1%\' failed. No such file or directory in \'%m2%\'',
	'INVL_DBG_LVL' 		=> 'invalid debuger level(\'%m1%\')',
	'INC_IN_SELF' 		=> 'You cant include \'%m1%\' in itself',
	'CANT_MK_DIR' 		=> 'Bitter couldnt create the folder \'%m1%\'',
	'CANT_MK_DIR' 		=> 'Bitter couldnt create the folder \'%m1%\'',
	));

//file errors
$lang = array_merge($lang,array(
	'UDATED_V_NL' 		=> 'A new version \'%m1%\' of Bitter is out',
	'UDATED_V_L' 		=> 'This version of Bitter is outdated',
	'INVAL_E_FLAG' 		=> 'Invalid flag: \'%m1%\' used at \'%m2%\' and was found on Casts.php',
	'INVAL_SBOX' 		=> 'Invalid SANDBOX_TYPE \'%m1%\'',
	));

$lang = array_merge($lang,array(
	'ER_LG' 		=> 'error_log',
	'V_LOG' 		=> 'version_log',
	));
