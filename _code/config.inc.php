<?php

/*******************************************
 CONFIG - 
 		For detailed descriptions please see (www.website-framework.com/config)
*/
$site_name					= 'xxxxxxxxxx';
$site_email					= 'xxxxxxxxxx';
$site_class					= 'xxxxxxxxxx';
$local_url					= 'http://build.website-framework.com/';



/*******************************************
 Environment variables - 
 		For detailed descriptions please see (www.website-framework.com/config#environment)
*/

// Switch to determine development environment - Live or Local?
$local 		= ('http://'.$_SERVER['SERVER_NAME'].'/' == $local_url ? true : false);
// Websites top level URL ie. (http://www.website-framework.com/ OR http://local.website-framework.com/)
$href 		= ($local ? $local_url : 'http://'.$_SERVER['SERVER_NAME'].'/');



/*******************************************
 Database & MAIL config for both Local and Live versions of your site - 
 		For detailed descriptions please see (www.website-framework.com/config#database)
 		For detailed descriptions please see (www.website-framework.com/config#mail)
*/
if($local) {
	// Local database server details, see (www.website-framework.com/config)
	define('DB_SERVER', 		"127.0.0.1");  		
	define('DB_USER', 			"root"); 			 	
	define('DB_PASS', 			"");
	define('DB_DATABASE', 		"xxxxxxxxxx");
	
	// MAIL settings, you can actually just use your gmail for emailing
	define('MAIL_HOST', 		"smtp.gmail.com");
	define('MAIL_PORT', 		"465");
	define('MAIL_USERNAME', 	"xxxxxxxxxx");
	define('MAIL_PASSWORD', 	"xxxxxxxxxx");
} else {
	// Live database server details, see (www.website-framework.com/config)
	define('DB_SERVER', 		"xxxxxxxxxx");
	define('DB_USER', 			"xxxxxxxxxx");
	define('DB_PASS', 			"xxxxxxxxxx");
	define('DB_DATABASE', 		"xxxxxxxxxx");	
	
	// MAIL settings, if you don't know your servers MAIL settings use the same one you use for local
	define('MAIL_HOST', 		"xxxxxxxxxx");
	define('MAIL_PORT', 		"xxxxxxxxxx");
	define('MAIL_USERNAME', 	"xxxxxxxxxx");
	define('MAIL_PASSWORD', 	"xxxxxxxxxx");
}

// Smart to define your table names also. We only have one currently, ie. users
define('TABLE_USERS', "users");
?>