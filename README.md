Website Framework
==========

Website Framework is a free & efficient HTML5 web site template with a powerful built-in PHP framework, allowing for rapid development of any type of web project.


###Documentation

http://www.website-framework.com/



###Installation in 7 easy steps

1. Download and unzip the Website Framework package, if you haven't already.

2. Create a database for Website Framework on your web server, as well as a MySQL user who has all privileges for accessing and modifying it. For more detailed descriptions on creating a database please see. (http://www.youtube.com/watch?v=nBz2lG_jm-A)

3. In your phpMyAdmin run the MySQL below 


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


4. Open '_code/config.inc.php' in a text editor and fill in the fields marked with XXXXXXXXX including your database details. More detailed instruction can be found here (www.website-framwork.com/config) 

5. Upload the Website Framework files into the root directory of your web server (e.g. http://example.com/)

6. Browse to http://example.com/

7. Enjoy!


Guess that is actually only 6 steps ;)