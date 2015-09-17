<?php
/*******************************************
 Simple set up
*/

class mvcClass {

	// MVC control
	var $mvc = array (
		"route" 			=> "",
		"controller" 		=> "",
		"view" 				=> "",
		"template" 			=> ""	
	);

	// Seo control
	var $seo = array (
		"page_title" 		=> "",
		"page_desc" 		=> "",
		"page_keywords" 	=> ""	
	);


	/**
	Constructing the MVC output
	**/
	public function init() {
		$this->load_controller();
	}


	/**
	Includes a controller and instantiates controller class if it exists
	@include controller by name 
	@scope private
	**/
	private function load_controller() {
		$controller = $this->mvc['controller'];
		// If a controller is specified load it.
		if($controller) {
			$controller_path = BASE_PATH . 'controllers/' . $controller . '.php';
			if(file_exists($controller_path)) {
				include_once $controller_path;
			} else {
				die('The controller <strong>' . $controller . '.php</strong> could not be found at <pre>' . $controller_path . '</pre>');
			}
		} else {
			$controller = 'default';
			include_once BASE_PATH . 'controllers/default.php';
		}
		// Your controller is a class that extends the frameworkClass
		$this->controller = null;
		$classname = $controller.'Class';
		if (class_exists($classname)) {
		   $this->controller = new $classname($this->mvc, $this->seo);
		}
	}


}
?>