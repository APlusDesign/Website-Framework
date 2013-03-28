<?php
/**
Basic example class

Methods
**/

class yourSiteName {
	
	/**
	Constructing the class with references to 
	@$this->db - the database object
	@$this->user - the user object
	**/
	function __construct(){
		$this->db = registry::get('db');
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