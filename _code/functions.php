<?php
	/* Helper functions */
	
	/* Input security */
	function check_input($data){
		$data = strip_tags($data);
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	/* Anytime you need to redirect to your 404 */
	function _404(){
		$newplace="http://".$_SERVER['HTTP_HOST']."/404";
		header("HTTP/1.0 404 Not Found");
		header("Location: $newplace");
		header("Connection: close");
		exit();
	}
	
	/* Anytime you need to redirect to your index */
	function _index(){
		$newplace="http://".$_SERVER['HTTP_HOST']."/";
		header("HTTP/1.0");
		header("Location: $newplace");
		header("Connection: close");
		exit();
	}
	
	/* redirect anywhere */
	function _redirect($url, $title){
		header("HTTP/1.0 $title");
		header("Location: $url");
		header("Connection: close");
		exit();
	}
	
?>