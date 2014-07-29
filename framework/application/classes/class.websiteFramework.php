<?php
/*******************************************
 Holds onto all your data and other class references like db, user, mail

 Methods
*/

class WebsiteFramework extends Functions {

	// Global site variables
	var $site_name			= null;
	var $site_email			= null;
	var $local_url			= null;
	var $local				= null;
	var $href				= null;

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
	Constructing the class with references to 
	@$this->db 		- the database object
	@$this->user 	- the user object
	@$this->mail 	- the mail object (Optional)
	@$this->href    - the url object
	**/
	function __construct(){


		/*******************************************
		 Server config - 
			(Change these dependant on your server setup)
		*/
		include(APPLICATION_PATH . 'config.inc.php');
		

		/********************************************************************
			Defining the global server settings
		*/
		if (!defined('DB_SERVER')) 		define('DB_SERVER', 		$database_host);
		if (!defined('DB_DATABASE')) 	define('DB_DATABASE', 		$database_name);
		if (!defined('DB_USER')) 		define('DB_USER', 			$database_user);
		if (!defined('DB_PASS')) 		define('DB_PASS', 			$database_password);
		if (!defined('MAIL_HOST')) 		define('MAIL_HOST', 		$mail_host);
		if (!defined('MAIL_PORT')) 		define('MAIL_PORT', 		$mail_port);
		if (!defined('MAIL_USERNAME')) 	define('MAIL_USERNAME', 	$mail_username);
		if (!defined('MAIL_PASSWORD')) 	define('MAIL_PASSWORD', 	$mail_password);

		
		/*******************************************
		 Create the database object - (always available but not connected till you need it)
			, open connection to database when needed. ie in you controller. $this->db->connect();
				obj: $this->db;
		*/
		$this->db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
		

		/*******************************************
		 Create the user object - (always available)
				obj: $this->user;
		*/
		$user = new ptejada\uFlex\User();
		//Add database credentials
		$user->config->database->host 		= DB_SERVER;
		$user->config->database->user 		= DB_USER;
		$user->config->database->password 	= DB_PASS;
		$user->config->database->name 		= DB_DATABASE;
		$this->user = $user->start();


		/*******************************************
		 Create a global mail object - (Better to call when needed as opposed to being global)
			(Return phpmailer object)
				obj: $this->mail;
		*/
		// $this->mail = $this->createMailObj();


		/*******************************************
		 Environment variables - 
			(Don't change these)
				For detailed descriptions please see (www.website-framework.com/config#environment)
		*/
		// Websites top level URL ie. (http://www.website-framework.com/ OR http://local.website-framework.com/)
		$this->href 	= ($this->local ? $this->local_url : 'http://'.$_SERVER['SERVER_NAME']);


		// echo "<pre>". print_r($this) . "</pre>";
		// exit;
	}
	

	/**
	Constructing the MVC output
	**/
	public function init() {
		$this->load_controller();
		$this->load_view();
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
		// Your controller can be a class or procedural, I personally don't care.
		$classname = $controller.'Class';
		if (class_exists($classname)) {
		   $this->controller = new $classname();
		}
	}


	/**
	Wraps a view file include in a template or prints a naked view
	@include template by name & path
	@scope private
	**/
	private function load_view() { 
		$template = $this->mvc['template'];
		// If we are given a template, use it
		if($template) {
			$template_path 	= BASE_PATH . 'templates/' . $template . '/index.php';
			if(file_exists($template_path)) {
				include_once $template_path;
			} else {
				die('The template <strong>' . $template . '.php</strong> could not be found at <pre>' . $template_path . '</pre>');
			}
		} else {
			// If no template you can print a naked view if one is specified, or if empty print nothing.
			$this->get_view();
		}
	}


	/**
	Includes a view file or leaves empty for an ajax response
	@include view file name
	@scope private
	**/
	private function get_view() {
		$view = $this->mvc['view'];
		// If we are given a view load it
		if($view) {
			$viewPath = BASE_PATH . 'views' . $this->mvc['route'] . $view . '.php'; 
			if(file_exists($viewPath)) {
				// Allow output of a view with-out a template (rarely needed, but good to have).
				include_once  $viewPath;
			} else {
				die('The view <strong>' . $view . '.php</strong> could not be found at <pre>' . $viewPath . '</pre>');
			} 
		} 
		// else : view was deliberately left empty for AJAX, so no error messages or content!
	}


	/**
	Return true for local environment
	@return bool
	@scope public
	**/
	public function isLocal(){
		return ('http://'.$_SERVER['SERVER_NAME'] == $this->local_url ? true : false);
	}


	/**
	Return phpmailer object with database config options set
	@return $mail object
	@scope public
	**/
	public function createMailObj(){
		$mail = new PHPMailer;
		$mail->isSMTP();							// Set mailer to use SMTP
		$mail->SMTPAuth 	= true;					// Enable SMTP authentication
		$mail->Host 		= MAIL_HOST;			// Specify main and backup server
		$mail->Username 	= MAIL_USERNAME;		// SMTP username
		$mail->Password 	= MAIL_PASSWORD;		// SMTP password
		$mail->Port 		= MAIL_PORT;  			// SMTP port
		$mail->SMTPSecure 	= 'ssl';				// Enable encryption
		return $mail;
	}
	
}
?>