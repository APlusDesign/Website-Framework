Website Framework
===================

Website Framework is a free HTML5 website template allowing for rapid development of web projects.



###Documentation/API

http://www.website-framework.com/




###Installation in 8 easy steps

Lets assume I'm using WAMP and I want my new website to appear at 'http://local.mysite.com/'


1. Unzip the Website Framework package into a new website space (e.g. c:\wamp\www\mysite)

2. Set up a new website as you normally would with a new vhosts record, there is an example below. Point the root to the '\website\' folder in (\wamp\www\mysite)

3. Create a database for this website. For more detailed descriptions on creating a database please see. (http://www.youtube.com/watch?v=nBz2lG_jm-A), the easy way is to run this sql query, replace 'MyDatabaseName' with your site name

		CREATE DATABASE IF NOT EXISTS MyDatabaseName;


4. Run the MySQL below to create a table in the database you just created 


		-- v1.1
		CREATE TABLE IF NOT EXISTS `users` (
		  `ID` INT(7) UNSIGNED NOT NULL AUTO_INCREMENT,
		  `Username` VARCHAR(15) NOT NULL,
		  `Password` VARCHAR (40) NOT NULL,
		  `Email` VARCHAR (100) NOT NULL,
		  `Activated` TINYINT(1)  UNSIGNED NOT NULL DEFAULT '0',
		  `Confirmation` CHAR(40) NOT NULL,
		  `RegDate` INT(11) UNSIGNED NOT NULL,
		  `LastLogin` INT(11) UNSIGNED NOT NULL DEFAULT '0',
		  `GroupID` INT(2) UNSIGNED NOT NULL DEFAULT '1',
		  PRIMARY KEY (`ID`)
		) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

		-- v1.0
		CREATE TABLE IF NOT EXISTS `contact` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `name` text,
		  `email` text,
		  `phone` text,
		  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
		  `message` text,
		  PRIMARY KEY (`id`)		
		) ENGINE=InnoDB DEFAULT CHARSET=latin1;


5. Open '/framework/application/config.inc.php' edit the fields marked 'XXXXXXXXX' with your site details, including your database and mail settings. More detailed explanations can be found here (www.website-framwork.com/config) 

6. Double check you've configured your site correctly, no seriously!  

7. Browse to your new website (e.g. http://local.mysite.com/)

8. Enjoy!


Guess that is actually only 7 steps ;)





###Configuring WAMPP or (xampp, nginx) to run with website-framework 


1. Set a record in your hosts file

		127.0.0.1 				local.mysite.com


2. Simple VHOSTS record (httpd-vhosts.conf)

		<VirtualHost *:80>
			DocumentRoot  "D:/wamp/www/mysite/website"
			ServerName mysite.com
			ServerAlias local.mysite.com
			<Directory "D:/wamp/www/mysite/website">
				Options Indexes FollowSymLinks MultiViews
				AllowOverride All
				Order allow,deny
				Allow from all
			</Directory>
		</VirtualHost>


3. APACHE MODULES
	
	You'll need to activate the 'rewrite_module'


	You should activate the 'headers_module'

	You should activate the 'expires_module'

	You should activate the 'deflate_module'



4. PHP EXTENSIONS

	You'll need to activate the 'php_openssl' extension




