<?php 
// Include globals 
include($_SERVER['DOCUMENT_ROOT'] .'/_code/global.php'); 

// Define VIEW data & meta
$page_title = "404 - Page not found";
$page_desc = "404 - Page not found";
$page_keywords = "";
$page_path = "/404/";
$page_name = "404";

// Define which template to use
include($_SERVER['DOCUMENT_ROOT'] .'/_templates/default/index.php'); 
?>