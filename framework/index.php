<?php

// For Support visit http://website-framework.com
// ---------------------------------------------------------------------------
// 	  Website Framework - Free and easy way to deploy super fast websites on the spot
//    Copyright (C) 2011  Simon Ilett
//
//    This program is free software: you can redistribute it and/or modify
//    it under the terms of the GNU General Public License as published by
//    the Free Software Foundation, either version 3 of the License, or
//    (at your option) any later version.
//
//    This program is distributed in the hope that it will be useful,
//    but WITHOUT ANY WARRANTY; without even the implied warranty of
//    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//    GNU General Public License for more details.
//
//    You should have received a copy of the GNU General Public License
//    along with this program.  If not, see http://www.gnu.org/licenses/gpl-3.0.html.
// ---------------------------------------------------------------------------

/*
 Use this file as your top level global include for classes, libraries 
*/
 
// Error reporting
// error_reporting(0);

// Paths
define('BASE_PATH',  __DIR__ . '/'); 
define('APPLICATION_PATH', BASE_PATH . 'application/');
define('CLASS_PATH', APPLICATION_PATH . 'classes/');
define('WEBSITE',  $_SERVER['DOCUMENT_ROOT']); 

// Classes

include(CLASS_PATH . 'class.json.php'); 
include(CLASS_PATH . 'class.database.php');
include(CLASS_PATH . 'phpmailer/PHPMailerAutoload.php'); 
include(CLASS_PATH . 'uflex/autoload.php');  
include(CLASS_PATH . 'class.websiteFramework.php');

// Start the Framework
$framework = new websiteFramework();

?>