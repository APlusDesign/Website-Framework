<?php
	/**
		Classname is the name of the file + the string Class
		ie.
			filename = default.php
			so classname = default+Class
							= defaultClass 
	*/

	// Controllers don't really have to do anything special, but they do need to exist
	class defaultClass extends WebsiteFramework {
		
		// Demo variable	
		var $someVariable = 'Hello World';

		// Don't change __construct
		function __construct($mvc, $seo){
			parent::__construct($mvc, $seo);
			$this->init();
			parent::load_view();
		}

		// Do stuff before the view gets loaded
		public function init(){
			$this->someOtherVariable = 'Some Value';
		}

		// Demo function
		public function helloWorld2(){
			echo "HelloWorld";
		}
	}
?>