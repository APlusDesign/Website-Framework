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

 
// Error reporting
error_reporting(E_ALL);

// Define Helper Paths
define('BASE_PATH',  __DIR__ . '/'); 
define('INCLUDES_PATH', BASE_PATH . 'views/includes/');
define('APPLICATION_PATH', BASE_PATH . 'application/');
define('CLASS_PATH', APPLICATION_PATH . 'classes/');
define('WEBSITE',  $_SERVER['DOCUMENT_ROOT']); 

// Define Classes
include(CLASS_PATH . 'class.json.php'); 
include(CLASS_PATH . 'class.db.php');
include(CLASS_PATH . 'phpmailer/PHPMailerAutoload.php'); 
include(CLASS_PATH . 'uflex/autoload.php');  
include(CLASS_PATH . 'class.functions.php');
include(CLASS_PATH . 'class.mvc.php');
include(CLASS_PATH . 'class.websiteFramework.php');

// Initiate the Framework
$framework = new mvcClass();

?>