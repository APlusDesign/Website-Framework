<?php
	/*******************************************
		Ajax Controller
		------------------------

		It might look scary but it basically handles all the requests for the user login/registration system,

	*/


	// Local version of user object
	$user = $this->user;

	// Local version of mail object
	$mail = $this->mail;

	// Local version of database object
	$db = $this->db;


	
	/*******************************************
		Calls with views
		------------------------
		Some calls to this controller will have an identifier named type to determine a view

	*/
	if (isset($_REQUEST['type'])) {
		
		
		$this->mvc['view'] = $_REQUEST['type'];

		// Methods
		switch ($this->mvc['view']) {
			
			case 'activate':
				if (isset($_REQUEST["c"])) {
					$activated = $user->activate($_REQUEST["c"]);
					if ($activated) {
						echo "<p>Your account is now activated</p>";
					} else {
						echo $user->console['errors']['activation'][0];
					}
				} else {
					header( 'Location: ' . $this->href) ;
				}
			break;

			// Security check to make sure these pages were called using ajax
			case 'contact':
			case 'login':
			case 'register':
			case 'logout':
				if(!isset($_REQUEST['ajax'])) {
					$this->_404();
				} 
			break;

		}	


	} else {

		/*******************************************
			Calls without views
			------------------------
			Some calls just return a json object, they will have an identifier named flag to determine output, but don't have a view!

		*/

		if (isset($_REQUEST["flag"])) {
			$flag = $_REQUEST["flag"];
		} else {
			$flag = 'default';
		}
		
		// Redundancy 
		$error = false;
		
		// Return JSON array
		$results = array();
		
		// Methods
		switch ($flag) {
		
			/* Login */
			case 'login':
				$username 	= $this->check_input($_REQUEST['username']);
				$password 	= $this->check_input($_REQUEST['password']);

				$auto 		= (isset($_REQUEST['auto']) ? $_REQUEST['auto'] : 0 );  
				
				$user->login($username,$password,$auto);

				/*
				echo $user->isSigned();
				echo "<pre>";
				print_r($user->log->getErrors());
				echo "</pre>";
				exit;
				*/

				if($username) {
					if($user->isSigned()){
						$html = "<div class='responses'>";
						$html .= "<p>Thanks for Logging in.</p>";
						$html .= "</div>";
						$results = array (    
							'html'  		=> $html,
							'url'			=> $_SERVER['SERVER_NAME'],
							'updates'		=> array (  
												'current-user' => $user 
												)
						);  
					} else {
						$error = true;
					}
				} else {
					$error = true;
					$user->log->error(7);
				}
				
			break;
			
			
			/* Logout, end sessions, clear cookies */
			case 'logout':
				// Log the user out
				$user->logout();
				// Redirect to index
				$this->_index();
			break;
			
			
			/* Registration, activation email */
			case 'register':
				
				$url = $_SERVER['SERVER_NAME'];	
		
				$data = array (    
					'Username'  	=> $this->check_input($_REQUEST['username']),
					'Password'		=> $this->check_input($_REQUEST['password']),
					'Password2'  	=> $this->check_input($_REQUEST['password2']),
					'Email'  		=> $this->check_input($_REQUEST['email']),
					'GroupID'  		=> 2 // default
				);
				
				$registered = $user->register($data,true);

				if($registered){
					if(isset($data['Email'])) {
						$mail->From = $this->site_email;
						$mail->FromName = $this->site_name . ' (Do not reply)';
						$mail->AddAddress($data['Email']);  
						$mail->Subject = $this->site_name . " - Account Registration";
						$mail->Body    = "Thanks for registering with us ".$data['Username']." \r\n\n Click the confirmation link below to activate your account.\r\n\n" . 'http://'.$url."/ajax?type=activate&c=" . $registered; 
						$mail->Send();
					}
					
					// Redirect to a thank you page
					//_redirect("http://".$_SERVER['HTTP_HOST']."/_content/ajax/registered", 'Thanks for registering');

					// Or use an ajax response and redirect.. This approach is not recommended
					$results = array (    
						'html'  		=> '<h3>Registered</h3><p>Thanks for registering</p><p>We have sent you a confirmation email</p>'
					);
					/**/
				}else{
					$error = true;	
				}

			break;
			

			
			
			/* forgotten password */
			case 'forgot':
				
				$url 	= $_SERVER['SERVER_NAME'];
				$email 	= null;

				if (isset($_REQUEST['email'])) {
					$email = $_REQUEST['email'];
				} 

				$data = $user->resetPassword($email);

				if($data){
					// Hash succesfully generated

					// Send a verification response to user if valid email
					if($email) {
						$mail->From = $this->site_email;
						$mail->FromName = $this->site_name . ' (Do not reply)';
						$mail->AddAddress($email);  
						$mail->Subject = $this->site_name . " - Password Reset";
						$mail->Body    = "Hi " . $user->Username . ", you have requested a password change. You may change your password by following this link.\r\n" . 'http://'.$url."/user/changepassword?c=" . $data->Confirmation; 
						$mail->Send();
					}
					
					$results = array (    
						'html'  		=> '<h3>Password Reset</h3> <p>please check your email.</p>'
					);	
					
				} else {
					$error = true;	
				} 
				
				
			break;
			
			



			/* Contact, store record, verification */
			case 'contact':

				$name 			= $this->check_input($_REQUEST['name']);
				$email 			= $this->check_input($_REQUEST['email']);
				// $phone 			= $this->check_input($_REQUEST['phone']);
				$message 		= $this->check_input($_REQUEST['message']);
				
				// Validations
				$errorStr 		= array();
				if(strlen($name) < 3) {
					$errorStr[] = "Name is not long enough";
				}
				if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/",$email)) {
					$errorStr[] = "Email is not a valid address";
				}
				if(strlen($message) < 10) {
					$errorStr[] = "Message is not long enough";
				}

				// Everything ok or has error
				if(count($errorStr)) {
					$results['errors'] = $errorStr;
				} else {
					
					// Insert email to a table called 'contact' if you desire
					//$db->query("INSERT INTO contact (name, phone, email, message) VALUES('$name', '$phone', '$email', '$message')"); 
					//$db->close();
					
					$mail->From 		= $email;
					$mail->FromName 	= $this->site_name . ' (Website)';
					$mail->AddAddress($this->site_email);  
					$mail->Subject 		= "$name has contacted " . $this->site_name;
					$mail->Body    		= "From: $name\n\n E-Mail: $email\n\n Message: $message\n\n "; 
					$mail->Send();
					$mail->ClearAddresses();
					
					// Send a verification response to user if valid email
					$mail->From 		= $this->site_email;
					$mail->FromName 	= $this->site_name . ' (Do not reply)';
					$mail->AddAddress($email);  
					$mail->Subject 		= $this->site_name." - Contact Confirmation"; 
					$mail->Body    		= "Thanks for contacting us $name\n\n We will be in contact with you shortly\n\n\n Your Message to '".$this->site_name."': $message"; 
					$mail->Send();
						
					$results['html'] = '<h3>Thanks for contacting '.$this->site_name.'</h3> <br> <p>Hi, '.$name.' we will respond to your enquiry shortly</p>';  
				}
				
			break;
			
			
			default:
				$results = array (    
					'errors' => 'You broke something O_o'
				);	
				
		}
		
		// Printing the errors if defaults fail...
		if($error) {
			$results = array (    
				'errors' => $user->log->getErrors()
			); 
		} 
		
		// Returning all results via JSON (as it always should be :)
		echo json_encode($results);


	}


?>