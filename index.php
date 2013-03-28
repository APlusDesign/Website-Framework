<?php 
// Include globals 
include($_SERVER['DOCUMENT_ROOT'] .'/_code/global.php'); 

// Define VIEW data & meta
$page_title = "Website framework . PHP . HTML5 . CSS3 . jQuery";
$page_desc = "Website framework . Free and easy way to deploy super fast websites on the spot";
$page_keywords = "website, framework, php, html5, css3, jquery";
$page_path = "/";
$page_name = "home";

// Define which template to use
include($_SERVER['DOCUMENT_ROOT'] .'/_templates/default/index.php'); 
?>