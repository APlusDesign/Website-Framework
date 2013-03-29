<?php
/*
 For detailed descriptions please see www.website-framework.com/config
*/
$site_name					= 'xxxxxxxxxx';
$site_email					= 'xxxxxxxxxx';
// Do not change this without reading (www.website-framework.com/config)
$site_class					= 'yourSiteName';
// Local environment url (used to determine local environment or not)
$local_url					= 'http://local.website-framework-build.com/';
// Google analytics tracking code, analytics is installed by default.
$analytics_tracking_code	= 'UA-XXXXXXXX-X';


/* Top level server switches for local development */
// Don't change $local and $href
$local = ('http://'.$_SERVER['SERVER_NAME'].'/' == $local_url ? true : false);
$href = ($local ? $local_url : 'http://'.$_SERVER['SERVER_NAME'].'/');


// Database config for both Local and Live versions of your site
if($local) {
	//Local database server
	define('DB_SERVER', "localhost");
	//Local database login name
	define('DB_USER', "root"); 
	//Local database login password
	define('DB_PASS', "");
	//Local database name
	define('DB_DATABASE', "xxxxxxxxxx");
	
	// SMTP settings, if you don't have SMTP you can't send emails
	define('MAIL_HOST', "smtp.gmail.com");
	define('MAIL_PORT', "465");
	define('MAIL_USERNAME', "xxxxxxxxxx");
	define('MAIL_PASSWORD', "xxxxxxxxxx");
	
} else {
	//Live database server
	define('DB_SERVER', "localhost");
	//Live database login name
	define('DB_USER', "xxxxxxxxxx");
	//Live database login password
	define('DB_PASS', "xxxxxxxxxx");
	//Live database name
	define('DB_DATABASE', "xxxxxxxxxx");	
	
	// SMTP settings, if you don't have SMTP you can't send emails
	define('MAIL_HOST', "smtp.localhost.com");
	define('MAIL_PORT', "25");
	define('MAIL_USERNAME', "xxxxxxxxxx");
	define('MAIL_PASSWORD', "xxxxxxxxxx");
}

// Smart to define your table names also. We only have one currently, ie. users
define('TABLE_USERS', "users");
?>