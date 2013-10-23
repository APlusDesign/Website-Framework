<?php


/*******************************************
 FRAMEWORK CONFIG - 
 	(Change these)
 		For detailed descriptions please see (www.website-framework.com/config)
*/

/****
	site_name 		- String
	eg. 			- (Website Framework) 
*/
$this->site_name			= 'xxxxxxxxxx';

/****
	site_email 		- String
	eg. 			- (admin@websiteframework.com) 
	What			- The email address which you want contact messages and other site info mailed to.
	Note 			- It has to be a valid email for the user registration and contact forms to work
*/
$this->site_email			= 'xxxxxxxxxx';

/****
	local_url 		- String
	eg. 			- (http://mvc.website-framework.com/) 
	Note 			- Arguably the frameworks most inportant config option. If you are developing on a local environment put the full local URL of the site
						This way you can define different database and mail options below for the different environments!
*/
$this->local_url			= 'http://build.website-framework.com/';




/*******************************************
 SEO template variables - 
 	(Change these)
 		Define some default SEO data, these can be used in your templates as defaults until you overide them.
 		 eg. Look in website/index.php to see an example of using different values, it's pretty basic :)
*/
$this->seo = array (
	"page_title" 			=> "xxxxxxxxxx",
	"page_desc"				=> "xxxxxxxxxx",
	"page_keywords" 		=> "xxxxxxxxxx"
);




/*******************************************
 Environment variables - 
 	(Don't change these)
 		For detailed descriptions please see (www.website-framework.com/config#environment)
*/
 		
// Switch to determine development environment - Live or Local (true:false)
$this->local 	= ('http://'.$_SERVER['SERVER_NAME'].'/' == $this->local_url ? true : false);
// Websites top level URL ie. (http://www.website-framework.com/ OR http://local.website-framework.com/)
$this->href 	= ($this->local ? $this->local_url : 'http://'.$_SERVER['SERVER_NAME'].'/');





/*******************************************
 Database & MAIL config for both Local and Live versions of your site - 
 	(Change these to your server setttings)
 		For detailed descriptions please see (www.website-framework.com/config#database)
 		For detailed descriptions please see (www.website-framework.com/config#mail)
*/
if($this->local) {
	// Local database server details, see (www.website-framework.com/config)
	define('DB_SERVER', 		"127.0.0.1");  		
	define('DB_USER', 			"root"); 			 	
	define('DB_PASS', 			"");
	define('DB_DATABASE', 		"xxxxxxxxxx");
	
	// MAIL settings, you can actually just use your gmail for emailing
	define('MAIL_HOST', 		"smtp.gmail.com");
	define('MAIL_PORT', 		"465");
	define('MAIL_USERNAME', 	"xxxxxxxxxx@gmail.com");
	define('MAIL_PASSWORD', 	"xxxxxxxxxx");
} else {
	// Live database server details, see (www.website-framework.com/config)
	define('DB_SERVER', 		"xxxxxxxxxx");
	define('DB_USER', 			"xxxxxxxxxx");
	define('DB_PASS', 			"xxxxxxxxxx");
	define('DB_DATABASE', 		"xxxxxxxxxx");	
	
	// MAIL settings, if you don't know your servers MAIL settings use the same one you use for local
	define('MAIL_HOST', 		"mail.yourdomain.com");   
	define('MAIL_PORT', 		"465");
	define('MAIL_USERNAME', 	"xxxxxxxxxx");
	define('MAIL_PASSWORD', 	"xxxxxxxxxx");
}

?>