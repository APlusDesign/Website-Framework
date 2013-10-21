<?php
	/*******************************************
		Ajax Controller
		------------------------

		It might look scary but it basically handles all the requests for the user login/registration system,

	*/


	// Local version of user
	$user = $this->user;

	// Local version of mail
	$mail = $this->mail;


	
	if (isset($_REQUEST['type'])) {
		
		/*******************************************
			Calls with views
			------------------------
			Some calls to this controller will have an identifier named type to determine a view

		*/
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
				$username 	= $_REQUEST['username'];
				$password 	= $_REQUEST['password'];
				$auto 		= (isset($_REQUEST['auto']) ? $_REQUEST['auto'] : 0 );  
				$user->login($username,$password,$auto);
				if($user->signed){
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
				}else{
					$error = true;
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
					'username'  	=> $_REQUEST['username'],
					'password'		=> $_REQUEST['password'],
					'password2'  	=> $_REQUEST['password2'],
					'email'  		=> $_REQUEST['email']
				);
				
				$reg = $user->register($data,true);
				if($reg){
					if(isset($data['email'])) {
						
						$mail->FromName = 'Website Framework';
						$mail->AddAddress($data['email']);  

						$mail->Subject = $this->site_name . " - Account Activation";
						$mail->Body    = "Thanks for registering with us ".$data['username'].", All you have to do is click the confirmation link below to activate your account.\r\n" . 'http://'.$url."/ajax/type/activate/c/" . $reg; 
						
						$mail->Send();
						
					}
					
					// Redirect to a thank you page
					//_redirect("http://".$_SERVER['HTTP_HOST']."/_content/ajax/registered", 'Thanks for registering');

					// Or use an ajax response and redirect.. This approach is not recommended
					$results = array (    
						'html'  		=> '<p>Thanks for registering</p><p>We have sent you an email just to verify you as real human</p>'
					);  
					/**/
			    }else{
			        $error = true;	
			    }
			break;
			
			
			/* forgotten password */
			case 'forgot':
				
				if($_REQUEST['email']){
					$res = $user->pass_reset($_REQUEST['email']);
					$url = $_SERVER['SERVER_NAME'];
					
					if($res){
						//Hash succesfully generated
						//You would send an email to $res['email'] with the URL+HASH $res['hash'] to enter the new password
						//In this demo we will just redirect the user directly
						
						if(isset($res['email'])) {
							
							$mail->FromName = 'Website Framework';
							$mail->AddAddress($res['email']);  

							$mail->Subject = $this->site_name . " - Password Reset";
							$mail->Body    = "Hi " . $res['username']. " please click the link below and enter a new password.\r\n" . 'http://'.$url."/user/changepassword?c=" . $res['hash']; 
							
							$mail->Send();
							
						}
							
						//$url = "change_password.php?c=" . $res['hash'];
						
						
						//If there is not error
						if(!$user->has_error()){
							//A workaround to display a confirmation message in this specific  Example
							$results['html'] = '<h2>Password Reset</h2> <p>please check your email</p>';  
						}
						
					} else {
						$error = true;	
					} 
				} else {
					$error = true;	
					unset($user->console['errors']);
					$user->error("Please enter an email address");
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
					$errorStr[] = "That name is too short";
				}
				if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/",$email)) {
					$errorStr[] = "That email is not valid";
				}
				if(strlen($message) < 10) {
					$errorStr[] = "That Message is too short";
				}
				if(count($errorStr)) {
					$results['errors'] = $errorStr;
				} else {
					
					// Format data
					$name_field = stripcslashes($name); 
					$email_field = stripcslashes($email); 
					$email_message = stripcslashes($message);
					
					
					// Insert email to a table called 'contact' if you desire
					/*
					$db = registry::get('db');
					$db->query("INSERT INTO contact (name, phone, email, message) VALUES('$name', '$phone', '$email', '$message')"); 
					$db->close();
					*/
					 
					$mail->FromName = 'Website Framework';
					$mail->AddAddress($this->site_email);  
					$mail->Subject = "$name_field has contacted " . $this->site_name;
					$mail->Body    = "From: $name_field\n\n E-Mail: $email_field\n\n Message: $email_message\n\n "; 
					$mail->Send();
					
					
					// Send a verification response to user if valid email
					if($email_field!='') {
						
						$mail->FromName = 'Website Framework (Do not reply)';
						$mail->AddAddress($email_field);  
						$mail->Subject = $this->site_name." - Contact Confirmation"; 
						$mail->Body    = "Thanks for contacting us $name_field\n\n We will be in contact with you shortly\n\n\n Your Message to '".$this->site_name."': $email_message"; 
						$mail->Send();
						
					}  
					
					$results['html'] = '<h2>Thanks for contacting us</h2> <p>We will respond shortly</p>';  
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
				'errors' => $user->error()
			); 
		} 
		
		// Returning all results via JSON (as it always should be :)
		echo json_encode($results);


	}


?>