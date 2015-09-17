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
		$str = htmlentities($str);
		return $str;
	}

	/**
	Return include as html
	**/
	public function returnIncludeAsHtml($includePath) {
		ob_start();
		include(BASE_PATH .$includePath);
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}

	/**
	Helps collect and print tags & categories in the blog
	**/
	public function pre($arr, $exit=0) {
		echo "<pre>";
		print_r($arr);
		echo "<pre>";
		if($exit) {
			exit;
		}
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


	/**
	Testing output
	@scope public
	**/
	public function helloWorld1(){
		echo "HelloWorld";
	}
	
}
?>