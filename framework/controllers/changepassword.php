<?php 
	
	$user = $this->user;
	
	$url = $_SERVER['SERVER_NAME'];
	$this->passChanged = false;
	

	//Proccess Password change
	if(count($_POST)){

		$this->passChanged = false;
		$hash = $_POST['c'];
		$pass = array();
		$pass['Password'] = $_POST['password'];
		$pass['Password2'] = $_POST['password2'];

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

		if (!count($user->log->getFormErrors())) {
			$this->passChanged = true;
		}
		
		// Log the user out
		$user->logout();
		
		/*
		echo "<pre>";
		print_r($user->log->getErrors());
		echo "</pre>";
		echo "<pre>";
		print_r($user->log->getFormErrors());
		echo "</pre>";  
		*/
		

	} else if(!$user->isSigned() and !isset($_GET['c'])){
		//Redirect
		$this->_index();
	}
?>