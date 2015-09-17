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
$this->site_name			= 'Website Name';

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
$this->local_url			= 'http://build.website-framework.com';







/*******************************************
 SEO template variables - 
 	(Change these)
 		Define some default SEO data, these can be used in your templates as defaults until you overide them.
 		 eg. Look in website/index.php to see an example of using different values, it's pretty basic :)
*/
$this->defaultSeo = array (
	"page_title" 			=> "xxxxxxxxxx",
	"page_desc"				=> "xxxxxxxxxx",
	"page_keywords" 		=> "xxxxxxxxxx"
);





/*******************************************
 DATABASE CONFIG
 	(Change these to your server setttings)
 		For detailed descriptions please see (www.website-framework.com/config#database)
*/

// DATABASE server settings
$database_host 			= "127.0.0.1";
$database_name 			= "xxxxxxxxxx";
$database_user 			= "xxxxxxxxxx";
$database_password 		= "xxxxxxxxxx";





/*******************************************
 MAIL CONFIG
 	(Change these to your server setttings)
 		For detailed descriptions please see (www.website-framework.com/config#mail)
*/

// MAIL server settings 
$mail_port 				= "465";
$mail_host 				= "xxxxxxxxxx";
$mail_username 			= "xxxxxxxxxx";
$mail_password 			= "xxxxxxxxxx";





/********************************************************************
	Local server settings 
		- isLocal()
			returns bool
				true = local server
*/
if($this->isLocal()) {
	// Overide database settings for local server
	$database_user 			= "root";
	$database_password 		= "";
} 



/********************************************************************
	End config
*/
?>
