<!DOCTYPE HTML>
<html lang="en">
<head>
<?php include_once($_SERVER['DOCUMENT_ROOT'] .'/_templates/default/head.php'); ?>
</head> 
<body class="<?php echo $page_name; ?>">
	<div id="wrapper">
		<?php include_once($_SERVER['DOCUMENT_ROOT'] .'/_templates/default/header.php'); ?>
		<?php include_once($_SERVER['DOCUMENT_ROOT'] .'/_content'.$page_path.$page_name.'.php'); ?>
	</div>
	<?php include_once($_SERVER['DOCUMENT_ROOT'] .'/_templates/default/footer.php'); ?>
	<?php include_once($_SERVER['DOCUMENT_ROOT'] .'/_templates/default/aside.php'); ?>
</body> 
</html>