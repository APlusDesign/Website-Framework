<?php
	/**
		Classname is the name of the file + the string Class
		ie.
			filename = default.php
			so classname = default+Class
							= defaultClass 
	*/
	class defaultClass extends WebsiteFramework {
		// See controllers don't really have to do anything special
		var $demo = 'Hello World';

		function __construct(){
			parent::__construct();
			$this->init();
		}

		// Runs when this controller is used for a page
		public function init(){
			
		}

		// Demo function
		public function helloWorld2(){
			return $this->helloWorld();
		}
	}
?>