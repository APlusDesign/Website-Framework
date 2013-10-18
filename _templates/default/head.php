<title><?php echo $page_title;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="description" content="<?php echo $page_desc;?>">
<meta name="keywords" content="<?php echo $page_keywords;?>">
<meta name="author" content="<?php echo $site_name;?>">
<meta property="og:title" content="<?php echo $page_title;?>">
<meta property="og:type" content="xxxxxxxxxx">
<meta property="og:url" content="<?php echo $href; ?>">
<meta property="og:image" content="xxxxxxxxxx">
<meta property="og:site_name" content="<?php echo $site_name;?>">
<meta property="og:description" content="<?php echo $page_desc;?>">
<meta property="fb:admins" content="672006741">
<link type="text/css" rel="stylesheet" href="/css/default/style.css">
<link type="text/css" rel="stylesheet" href="/css/_plugins/fancybox/jquery.fancybox.css">
<link type="image/png" rel="icon" href="/favicon.png">
<base href="<?php echo $href; ?>">
<script src="/js/_plugins/head.js" type="text/javascript"></script>
<script src="/js/init.js" type="text/javascript"></script>
<!--[if lt IE 9]>
<link type="text/css" rel="stylesheet" href="/css/default/ie.css" />
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<?php
// Page specific javascript
if(isset($specialEvents)) {
	echo '<script>';
	foreach ($specialEvents as $value) {
		echo $value;
	}
	echo '</script>';
}
?>
