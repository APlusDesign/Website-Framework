<?php
/*******************************************
 Holds onto all your data and other class references like db, user, mail

 Methods
*/

class websiteFramework {

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
	@$this->mail 	- the mail object
	**/
	function __construct(){
		include(APPLICATION_PATH . 'config.inc.php');

		// Database object + connection
		$this->db = $db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
		$db->connect();

		// User object 
		$this->user = $user = new uFlex();
		$user->db['host'] = DB_SERVER;
		$user->db['user'] = DB_USER;
		$user->db['pass'] = DB_PASS;
		$user->db['name'] = DB_DATABASE;

		// Mail object
		$this->mail = $mail = new PHPMailer;
		$mail->isSMTP();                            // Set mailer to use SMTP
		$mail->SMTPAuth = true;                     // Enable SMTP authentication
		$mail->Host = MAIL_HOST;  					// Specify main and backup server
		$mail->Username = MAIL_USERNAME;            // SMTP username
		$mail->Password = MAIL_PASSWORD;            // SMTP password
		$mail->Port = MAIL_PORT;  					// SMTP port
		$mail->SMTPSecure = 'ssl';                  // Enable encryption

		// echo "<pre>";
		// print_r($this);
		// echo "</pre>";
		// exit;
	}
	
	// Loads the controller, template and view
	public function init() {
		$this->load_controller();
		$this->load_view();
	}

	// Loads a controller, or includes one rather
	public function load_controller() {
		$name = $this->mvc['controller'];
		$controller_path = BASE_PATH . 'controllers/' . $name . '.php';
		if($name!='') {
			if(file_exists($controller_path)) {
				include_once $controller_path;
			} else {
				die('The controller <strong>' . $name . '.php</strong> could not be found at <pre>' . $controller_path . '</pre>');
			}
		} else {
			include_once BASE_PATH . 'controllers/default.php';
		}
	}

	// Loads a view with a template, or just a view!
	public function load_view() { 
		$name = $this->mvc['template'];
		$template_path = BASE_PATH . 'templates/' . $name . '/index.php';
		if($this->mvc['view']) {
			if($name!='') {
				if(file_exists($template_path)) {
					include_once $template_path;
				} else {
					die('The template <strong>' . $name . '.php</strong> could not be found at <pre>' . $template_path . '</pre>');
				}
			} else {
				// This lets us skip including a template, good for ajax calls
				include_once  BASE_PATH . 'views/'.$this->mvc['route'].$this->mvc['view'].'.php';
			}
		} 		
	}


	/**
	Outputs the welcome text
	@return html
	@scope public
	**/
	public function helloWorld(){
		$html = "<p>Hello World</p>\n\t";
		return $html;
	}



	/**
	Some general helper functions
	**/

	/* Input security */
	public function check_input($data){
		$data = strip_tags($data);
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	/* Anytime you need to redirect to your 404 */
	public function _404(){
		$newplace="http://".$_SERVER['HTTP_HOST']."/404";
		header("HTTP/1.0 404 Not Found");
		header("Location: $newplace");
		header("Connection: close");
		exit();
	}
	
	/* Anytime you need to redirect to your index */
	public function _index(){
		$newplace="http://".$_SERVER['HTTP_HOST']."/";
		header("HTTP/1.0");
		header("Location: $newplace");
		header("Connection: close");
		exit();
	}
	
	/* redirect anywhere */
	public function _redirect($url, $title){
		header("HTTP/1.0 $title");
		header("Location: $url");
		header("Connection: close");
		exit();
	}
	
}
?>