<?php 

	class changepasswordClass extends WebsiteFramework {
		
		function __construct(){
			parent::__construct();
			$this->init();
		}

		// Dealing with post data
		public function init(){
			
			// Make a controller copy of $user since it won't report anything back
			$user = $this->user;
			$this->passChanged = (isset($_GET['passchanged']) ? $_GET['passchanged'] : false);
			
			// Is this user allowed here
			if(!$user->isSigned() and !isset($_GET['c']) and !$this->passChanged){
				//Redirect
				functions::_index();
			}
			if($user->isSigned() and ($this->passChanged || isset($_GET['c']))) {
				$this->_redirect("http://".$_SERVER['HTTP_HOST']."/user/profile");
			}


			//Proccess Password change
			if(count($_POST)){

				// Set some session variables
				$pass = array();
				$_SESSION['pass']				= $pass;
				$_SESSION['pass']['Password'] 	= $_POST['password'];
				$_SESSION['pass']['Password2'] 	= $_POST['password2'];
				$_SESSION['hash'] 				= $_POST['c'];
				// Ensures session is written before redirect.
				session_write_close();

				if($_SESSION['hash']) {
					$this->_redirect("http://".$_SERVER['HTTP_HOST']."/user/changepassword?c=".$_SESSION['hash']);
				} else {
					$this->_redirect("http://".$_SERVER['HTTP_HOST']."/user/changepassword");
				}
				

			} else if (isset($_SESSION['pass'])){
				
				$hash = $_SESSION['hash'];
				$pass = $_SESSION['pass'];

				if (!$user->isSigned() and $hash) {
					//Change Password with confirmation hash
					$user->newPassword(
						$hash,
						$pass
					);
				} else {
					//Change the Password of signed in user without a confirmation hash
					$user->update(
						$pass
					);
				}

				// If password was changed
				if (!count($user->log->getFormErrors())) {
					session_unset();
					session_destroy();
					// Log the user out
					$user->logout();
					$this->_redirect("http://".$_SERVER['HTTP_HOST']."/user/changepassword?passchanged=1");
				} 

			}
		}
	}

	
?>