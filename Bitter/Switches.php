<?php

/*
*	Bitter tag open
*	compiles any code that starts with '[ (STAG) ' and ends with '] (ETAG)'
* 	you can replace with any special character if the default dosnt work out so well
*/
define('STAG', '[');
define('ETAG', ']');

/*
*	Capital letters recongnition (ONLY)
*	Bitter only compliles the tags with Capital letters
*		eg
*			[BITTER] works
*			[Bitter] or [bitter] donst work
* 	set to false if you want Bitter to ignore cases and compile
*/
define('CAP_REC', true);

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
define('SANDBOX_TYPE', 2);
/*
* 	Default template name
*/
define('NAME', 'bitter');
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
* 	let Bitter automatically check for update
*/
define('CHECK_UPDATE', true);
/*
* 	Set date with UTC time zone
*/
date_default_timezone_set('UTC');
define('DATE', date(DATE_RFC2822));


