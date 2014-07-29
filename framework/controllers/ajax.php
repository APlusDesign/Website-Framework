<?php
	/*******************************************
		Ajax Controller
		------------------------

		It might look scary but it basically handles all the requests for the user login/registration and contact system,
	*/


	// Local version of user object
	$user = $this->user;


	
	/*******************************************
		Calls with views
		------------------------
		Some calls to this controller will have an identifier named view, 
		this allows you to return views that are not wrapped in a template
		
	*/
	if (isset($_REQUEST['view'])) {
		
		
		$this->mvc['view'] = $_REQUEST['view'];

		
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
				// Comment this out if you want non ajax forms
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
		
		// Flag methods
		switch ($flag) {
		
			/* Login */
			case 'login':
				$username 	= $this->check_input($_REQUEST['username']);
				$password 	= $this->check_input($_REQUEST['password']);
				$auto 		= (isset($_REQUEST['auto']) ? $_REQUEST['auto'] : 0 );  
				
				$user->login($username,$password,$auto);

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
			break;
			
			
			/* Registration, activation email */
			case 'register':
				
				$url = $_SERVER['SERVER_NAME'];	
		
				$data = array (    
					'Username'  	=> $this->check_input($_REQUEST['username']),
					'Password'		=> $this->check_input($_REQUEST['password']),
					'Password2'  	=> $this->check_input($_REQUEST['password2']),
					'Email'  		=> $this->check_input($_REQUEST['email']),
					'GroupID'  		=> 1 
				);
				
				$registered = $user->register($data,true);

				if($registered){
					if(isset($data['Email'])) {
						$mail = $this->createMailObj();
						$mail->From = $this->site_email;
						$mail->FromName = $this->site_name . ' (Do not reply)';
						$mail->AddAddress($data['Email']);  
						$mail->Subject = $this->site_name . " - Account Registration";
						$mail->Body    = "Thanks for registering with us ".$data['Username']." \r\n\n Click the confirmation link below to activate your account.\r\n\n" . 'http://'.$url."/ajax?view=activate&c=" . $registered; 
						$mail->Send();
					}
					
					// Redirect to a thank you page
					//$this->_redirect("http://".$_SERVER['HTTP_HOST']."/_content/ajax/registered", 'Thanks for registering');

					// Or use an ajax response and redirect.. This approach is not recommended
					$results = array (    
						'html'  		=> '<h3>Registered</h3><p>Thanks for registering</p><p>We have sent you a confirmation email</p>'
					);
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
						$mail = $this->createMailObj();
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
				$message 		= $this->check_input($_REQUEST['message']);
				
				// Validations
				$errorStr 		= array();
				if(strlen($name) < 3) {
					$errorStr['name'] = "Name is not long enough";
				}
				if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/",$email)) {
					$errorStr['email'] = "Email is not a valid address";
				}
				if(strlen($message) < 10) {
					$errorStr['message'] = "Message is not long enough";
				}

				// Everything ok or has error
				if(count($errorStr)) {
					$results['errors'] = $errorStr;
				} else {
					
					// Insert email to a table called 'contact' if you desire
					//$db = $this->db;
					//$db->connect();
					//$db->query("INSERT INTO contact (name, email, message) VALUES('$name', '$email', '$message')"); 
					//$db->close();

					// Create PHPMailer object
					$mail = $this->createMailObj();

					// Email 1: send contact to $this->site_email;
					$mail->From 		= $email;
					$mail->FromName 	= $this->site_name . ' (Website)';
					$mail->AddAddress($this->site_email);  
					$mail->Subject 		= "$name has contacted " . $this->site_name;
					$mail->Body    		= "From: $name\n\n E-Mail: $email\n\n Message: $message\n\n "; 
					$mail->Send();
					$mail->ClearAddresses();
					
					// Email 2: Send a verification response to user if valid email
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