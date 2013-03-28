<!DOCTYPE HTML>
<html>
<head>
<?php include_once($_SERVER['DOCUMENT_ROOT'] .'/_templates/default/head.php'); ?>
</head> 
<body class="<?php echo $page_name; ?>">
<?php include_once($_SERVER['DOCUMENT_ROOT'] .'/_templates/default/header.php'); ?>
	<div id="wrapper">
	<?php include_once($_SERVER['DOCUMENT_ROOT'] .'/_content'.$page_path.$page_name.'.php'); ?>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] .'/_templates/default/aside.php'); ?>
	</div>
<?php include_once($_SERVER['DOCUMENT_ROOT'] .'/_templates/default/footer.php'); ?>
</body> 
</html>