<?php
/**
 Add Custom functions here
**/
class Functions 
{

	/**
	Some general helper functions
	**/


	/**
	User Input security
	@return str
	@scope public
	**/
	/* Input security */
	public function check_input($str){
		$str = strip_tags($str);
		$str = trim($str);
		$str = stripslashes($str);
		$str = htmlspecialchars($str);
		// $str = mysql_real_escape_string($str);
		return $str;
	}

	/**
	Outputs the welcome text
	@return html
	@scope public
	**/
	public function helloWorld(){
		$html = "Hello World";
		return $html;
	}


	/**
	Some general redirect functions
	**/
	
	/* Anytime you need to redirect to your 404 */
	public function _404(){
		$newplace="http://".$_SERVER['HTTP_HOST']."/404";
		header("HTTP/1.0 404 Not Found");
		header("Location: $newplace");
		header("Connection: close");
		exit();
	}
	
	/* Anytime you need to redirect to your index */
	public function _index(){
		$newplace="http://".$_SERVER['HTTP_HOST']."/";
		header("HTTP/1.0");
		header("Location: $newplace");
		header("Connection: close");
		exit();
	}
	
	/* Anytime you need to redirect to your admin */
	public function _admin(){
		$newplace="http://".$_SERVER['HTTP_HOST']."/user/admin";
		header("HTTP/1.0");
		header("Location: $newplace");
		header("Connection: close");
		exit();
	}

	/* redirect anywhere */
	public function _redirect($url, $title){
		header("HTTP/1.0 $title");
		header("Location: $url");
		header("Connection: close");
		exit();
	}
}
?>