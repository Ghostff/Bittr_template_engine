<?php
/*
*	Bitter tag open
*	compiles any code that starts with '[ (STAG) ' and ends with '] (ETAG)'
* 	you can replace with any special character if the default dosnt work out so well
*/
define('STAG', '{{');
define('ETAG', '}}');


/*
*	Bitter Sandbox
*	Allow bitter to debug code at runtime recomended*.
*/
define('SANDBOX', true);
/*
*	Bitter Sandbox debuging type
*	Tells Bitter how to handle occured errors
*		@param 1 Display in browser (for Development)
*		@param 2 Display in browser and log to file (For Development)
*		@param 3 Log to file 
*	Note: SANDBOX must be true to recognize SANDBOX_TYPE 
*/
define('SANDBOX_TYPE', 1);
/*
* 	Default template name
*/
define('NAME', 'bittr');
/*
* 	Set up default language
* 	Your Error will be displayed or log according to your selected language
*		@param 'EN' all displayed or logged errors will be in English
*
*	Avaliable Languages
*	'EN' English
*/
define('DEFAULT_LANG', 'EN');
/*
* 	Set a platform defined directory separator 
*/
define('DSEP', DIRECTORY_SEPARATOR);
/*
*	Bitter path
*/
define('ROOT', dirname(__FILE__). DSEP );
/*
* 	let Bitter automatically check for update
*/
define('CHECK_UPDATE', true);
/*
* 	Set date with UTC time zone
*/
date_default_timezone_set('UTC');
define('DATE', date(DATE_RFC2822));
/*
* 	Template directory
*	put all your template file in this(Templates) directory *** if none is specified in setTemplatePath
*	change to diffrent name if you want your template on diffrent directory
*/
define('TMPLT_DIR', ROOT . 'Templates' . DSEP);
/*
* 	Template format
*	A format or extension Bitter will recognize as a template file
*	default tpl
*/
define('TPL_EX', '.bt');
/*
* 	assigned value overiding
*	this prevent the assignment of values with same name
*	default false set to true if you want the new name
*	to overide the existing
*/
define('OVERIDE', false);

