Website Framework
===================

Website Framework is a free HTML5 website template allowing for rapid development of web projects.


###Documentation/API

http://www.website-framework.com/




###Installation in 8 easy steps

1. Unzip the Website Framework package into the new website space you are creating (e.g. c:\wamp\www\mysite).

2. Set up a new localhost record for this website. (You should know how to do this by now)

3. Connect to your localhost server and create a database for your website, (as well as a MySQL user who has all privileges). For more detailed descriptions on creating a database please see. (http://www.youtube.com/watch?v=nBz2lG_jm-A)

4. Open your phpMyAdmin and run the MySQL below to create a table in the database you just created 


		CREATE TABLE IF NOT EXISTS `users` (
		`user_id` int(7) NOT NULL AUTO_INCREMENT,
		`username` varchar(15) NOT NULL,
		`password` varchar(35) NOT NULL,
		`email` varchar(35) NOT NULL,
		`activated` int(1) NOT NULL DEFAULT '0',
		`confirmation` varchar(35) NOT NULL,
		`reg_date` int(11) NOT NULL,
		`last_login` int(11) NOT NULL DEFAULT '0',
		`group_id` int(2) NOT NULL DEFAULT '1',
		PRIMARY KEY (`user_id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=latin1;


5. Open '/_code/config.inc.php' in a text editor and fill in the fields marked XXXXXXXXX with your site details, including your database settings. More detailed instruction can be found here (www.website-framwork.com/config). 

6. Double check you've configured your localhost correctly ('Configuring WAMPP or your local server'), (www.website-framwork.com/configure-wamp)

7. Browse to your new website (e.g. http://local.mysite.com/)

8. Enjoy!


Guess that is actually only 7 steps ;)




###Configuring WAMPP or (xampp, nginx) to run with website-framework 

1. PHP EXTENSIONS

	You'll need to activate the 'php_openssl' extension


2. APACHE MODULES
	
	You'll need to activate the 'rewrite_module'

	You should activate the 'headers_module'
	You should activate the 'expires_module'
	You should activate the 'deflate_module'