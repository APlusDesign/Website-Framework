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
 Use this file as your top level global include for classes, libraries and adding to the registry 
*/
// Boot strap
error_reporting(E_ALL ^ E_STRICT);
 
// Classes and libraries
require_once($_SERVER['DOCUMENT_ROOT'] . '/_code/config.inc.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/_code/class.registry.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/_code/class.json.php'); 
require_once($_SERVER['DOCUMENT_ROOT'] . '/_code/class.database.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/_code/class.uFlex.php'); 
require_once($_SERVER['DOCUMENT_ROOT'] . '/_code/class.'.$site_class.'.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/_code/functions.php'); 

// Database object + connection
//$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE); 
$db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$db->connect();
registry::add('db', $db);

// User object 
$user = new uFlex();
$user->db['host'] = DB_SERVER;
$user->db['user'] = DB_USER;
$user->db['pass'] = DB_PASS;
$user->db['name'] = DB_DATABASE;
registry::add('user', $user);

// Your sites very own class object 
$siteClass = new $site_class();
registry::add($site_class, $siteClass);

?>