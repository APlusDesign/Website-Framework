<?php
/*
 For detailed descriptions please see www.website-framework.com/config
*/

// Site definitions
$site_name					= 'Website framework BUILD';
$site_email					= 'admin@website-framework-build.com';
$site_class					= 'example';

// Local environmanet details
$local_path					= 'C:/wamp/www/website-framework-build/';
$local_url					= 'http://local.wf-build.com/';

// Analytics tracking code
$analytics_tracking_code	= 'UA-XXXXXXXX-X';


/* Top level server switches for local development (true = local) */
$dev = ($_SERVER['DOCUMENT_ROOT'] == $local_path ? true : false);
$href = ($dev ? $local_url : 'http://'.$_SERVER['SERVER_NAME'].'/');


// Database config
if($dev) {
	//local database server
	define('DB_SERVER', "localhost");
	//local database login name
	define('DB_USER', "root"); 
	//local database login password
	define('DB_PASS', "");
	//local database name
	define('DB_DATABASE', "website-framework-build");
} else {
	//Live database server
	define('DB_SERVER', "localhost");
	//Live database login name
	define('DB_USER', "XXXXXXXXXX");
	//Live database login password
	define('DB_PASS', "XXXXXXXXXX");
	//Live database name
	define('DB_DATABASE', "XXXXXXXXXX");	
}


// Smart to define your table names also we only have one, ie. users
define('TABLE_USERS', "users");


?>