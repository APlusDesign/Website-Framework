<?php
/**
 * db class used for connecting to databse with pdo
 * 
 */
  
class db {
	
	private static $con=null;
	 
	private function __construct() {
		 
	}
	 
	public static function con() {

		if( !self::$con) {
 			
 			// Connection values
			self::$con = new PDO("mysql:host=".DB_SERVER."; dbname=".DB_DATABASE, DB_USER, DB_PASS);
			 
			self::$con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			//which tells PDO to disable emulated prepared statements and use real prepared statements. This makes sure the statement and the values aren't parsed by PHP before sending it to the MySQL server (giving a possible attacker no chance to inject malicious SQL).
 
			self::$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			 
		}
		 
		return self::$con;
	}
	 
	private function __clone() {
		 
	}
}
?>