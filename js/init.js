/*******************
 Website Object
*/ 
var websiteFramework = {} || null;


/*******************
 Asynchronous loading of scripts
*/   
head.js(
	'//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js',
	'//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.pack.js',
	'/js/default/scripts.js'
);


/*******************
 Google Analytics
*/
// replace below 'UA-XXXXXXXX-X' with your analytics tracking code
var id = 'UA-XXXXXXXX-X';
// Load analytics if it's not UA-XXXXXXXX-X
if(id != 'UA-XXXXXXXX-X') {
	head.js({
	   	analytics: "http://www.google-analytics.com/ga.js"
	});
	head.ready("analytics", function() {
		var tracker=_gat._getTracker(id);
		tracker._trackPageview();
	});
}


/*******************
 document.ready - Do stuff :)
*/  
head.ready(function() {
	// Base url for all your ajax calls
  	websiteFramework.BASE_URL = document.getElementsByTagName('base')[0].href;
	// User login, register, logout, contact controls
	websiteFramework.controls = userControls();
	// View the website object
	console.log(websiteFramework)
});


