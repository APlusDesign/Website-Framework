<?php
/*******************************************
 Basic example class, please rename to something useful and make sure you read the config on 
 (www.website-framework.com/config)

 Methods
*/

class xxxxxxxxxx {
	
	/**
	Constructing the class with references to 
	@$this->db - the database object
	@$this->user - the user object
	**/
	function __construct(){
		$this->db 	= registry::get('db');
		$this->user = registry::get('user');
	}
	
	/**
	Outputs the welcome text
	@return html
	@scope public
	**/
	public function helloWorld(){
		$html = "<p>Hello World</p>\n\t";
		return $html;
	}
	
}
?>