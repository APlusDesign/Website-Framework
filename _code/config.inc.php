<?php
/*
 For detailed descriptions please see www.website-framework.com/config
*/
$site_name					= 'xxxxxxxxxx';
$site_email					= 'xxxxxxxxxx';
// Do not change this without reading (www.website-framework.com/config)
$site_class					= 'yourSiteName';
// Local environmanet details
$local_path					= 'C:/wamp/www/website-framework-build/';
$local_url					= 'http://local.website-framework-build.com/';
// Google analytics tracking code, analytics is installed by default.
$analytics_tracking_code	= 'UA-XXXXXXXX-X';


/* Top level server switches for local development (true = local) */
// Don't change
$local = ($_SERVER['DOCUMENT_ROOT'] == $local_path ? true : false);
$href = ($dev ? $local_url : 'http://'.$_SERVER['SERVER_NAME'].'/');


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
} else {
	//Live database server
	define('DB_SERVER', "localhost");
	//Live database login name
	define('DB_USER', "xxxxxxxxxx");
	//Live database login password
	define('DB_PASS', "xxxxxxxxxx");
	//Live database name
	define('DB_DATABASE', "xxxxxxxxxx");	
}

// Smart to define your table names also. We only have one currently, ie. users
define('TABLE_USERS', "users");
?>