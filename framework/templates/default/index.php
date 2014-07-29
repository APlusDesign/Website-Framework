<!DOCTYPE HTML>
<html lang="en">
<head>
<?php include(BASE_PATH .'/templates/default/head.php'); ?>
</head> 
<body class="<?php echo $this->mvc['view']; ?>">
	<?php echo ($this->isLocal() ? "<div id='local-root'></div>" : ""); ?>
	<div class="wrapper">
	<?php include(BASE_PATH .'/templates/default/header.php'); ?>
	<?php $this->get_view(); ?>
	</div>
	<?php include(BASE_PATH .'/templates/default/aside.php'); ?>
	<?php include(BASE_PATH .'/templates/default/footer.php'); ?>
</body> 
</html>