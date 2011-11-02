<title><?php echo $page_title;?></title> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="<?php echo $page_desc;?>" /> 
<meta name="keywords" content="<?php echo $page_keywords;?>" /> 
<meta name="author" content="Website Framework">
<link type="text/css" rel="stylesheet" href="/css/style.css" /> 
<link type="image/png" rel="icon" href="/favicon.ico" /> 
<?php echo '<base href="'.$href.'" />'; ?>

<script id="loader" src="/js/head.js" type="text/javascript"></script>
<script>
// Optional : Change all instances of siteObj to an alias for your own site
var siteObj = {} || null;
//  Asynchronous loading of scripts
head.js(
	'/js/jquery.js',
	'/js/jquery.fancybox-1.3.4.pack.js',
	'/js/scripts.js',
	'http://www.google-analytics.com/ga.js'
);
head.ready(function() {
	// Base url for all ajax calls
  	siteObj.BASE_URL = document.getElementsByTagName('base')[0].href;
	// User login, register, logout, contact controls
	siteObj.controls = userControls();
	<?php  
	// Page specific javascript
	if(isset($specialEvents)) { 
		foreach ($specialEvents as $value) {
			echo $value;
		}
	}
	?>
// Google Analytics
	var tracker=_gat._getTracker ("<?php echo $analytics_tracking_code; ?>");
	tracker._trackPageview ();
});
</script> 
<!--[if lt IE 9]>
<link type="text/css" rel="stylesheet" href="/css/ie.css" />
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
