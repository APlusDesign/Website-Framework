<!DOCTYPE HTML>
<html lang="en">
<head>
<?php include(BASE_PATH .'/templates/default/head.php'); ?>
</head> 
<body class="<?php echo $this->mvc['view']; ?>">
	<div class="wrapper">
	<?php include(BASE_PATH .'/templates/default/header.php'); ?>
	<?php include(BASE_PATH .'/views'.$this->mvc['route'].$this->mvc['view'].'.php'); ?>
	
	</div>
	<?php include(BASE_PATH .'/templates/default/footer.php'); ?>
	<?php include(BASE_PATH .'/templates/default/aside.php'); ?>
</body> 
</html>