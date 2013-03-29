<?php

	// Our global object 
	include($_SERVER['DOCUMENT_ROOT'] .'/_code/global.php');
	
	// Ajax calls will have an identifier named flag to determine method
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
			_index();
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
					
					$to 		= $data['email']; 
					$subject 	= $site_name . " - Account Activation"; 
					$headers 	= 'From: '.$site_name.' <'.$site_email.'>' . "\r\n";
					$body 		= "Thanks for registering with us ".$data['username'].", All you have to do is click the confirmation link below to activate your account."; 
					$makeURL 	= 'http://'.$url."/_content/ajax/activate?c=" . $reg; 
					$body 		.= "\r\n".$makeURL;
					$send		= mail($to, $subject, $body, $headers); 
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
						$to 		= $res['email']; 
						$subject 	= $site_name . " - Password Reset"; 
						$headers 	= 'From: '.$site_name.' <'.$site_email.'>' . "\r\n";
						$body 		= "Hi " . $res['username']. " please click the link below and enter a new password."; 
						$makeURL 	= 'http://'.$url."/_content/ajax/change_password?c=" . $res['hash']; 
						$body 		.= "\r\n".$makeURL;
						$send		= mail($to, $subject, $body, $headers); 
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
			
			// Redirect to index
			//_index();
		break;
		
		
		/* Contact, store record, verification */
		case 'contact':
			$name 			= check_input($_REQUEST['name']);
			$email 			= check_input($_REQUEST['email']);
			$message 		= check_input($_REQUEST['message']);
			
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
				 
				// Send email to client
				$to = $site_email; 
				$subject = "$name_field has contacted " . $site_name;
				$from = "From: ".$site_name." contact <".$site_email."> \r\n";
				$body = "From: $name_field\n\n E-Mail: $email_field\n\n Message: $email_message\n\n "; 
				$send=mail($to, $subject, $body, $from); 
				
				// Send a verification response to user if valid email
				if($email_field!='') {
					$to = $email_field; 
					$subject = $site_name." - Contact Confirmation"; 
					$headers = 'From: Do not reply at  <'.$site_email.'>' . "\r\n";
					$body = "Thanks for contacting us $name_field\n\n We will be in contact with you shortly\n\n\n Your Message to '".$site_name."': $email_message"; 
					$send=mail($to, $subject, $body, $headers); 
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
	

?>