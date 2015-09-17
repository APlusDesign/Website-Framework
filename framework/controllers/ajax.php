<?php
/*******************************************
	Ajax Controller
	------------------------

	It might look scary but it basically handles all the requests for the user login/registration and contact system,
*/

class ajaxClass extends WebsiteFramework {
	
	function __construct($mvc, $seo){
		parent::__construct($mvc, $seo);
		$this->init();
		parent::load_view();
	}	


	// Do stuff before the view gets loaded
	public function init(){
		
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
				// Security check to make sure these pages were called using ajax
				// Comment this out if you want to use them as non ajax forms
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
			Some calls just return a json object, they will have an identifier named flag to determine output, but have no view & no template!

		*/
			$flag = 'default';

			if (isset($_REQUEST["flag"])) {
				$flag = $_REQUEST["flag"];
			} 
			
			// Redundancy 
			$error = false;
			
			// results will Return as JSON array
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
							$mail->Body    = "Thanks for registering with us ".$data['Username']." \r\n\n Click the confirmation link below to activate your account.\r\n\n" . 'http://'.$url."/user/activate?c=" . $registered; 
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
				
				

				/* Site contact email form */
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
						
						// PDO for the wins
						$dbh = db::con();
						$stmt = $dbh->prepare("INSERT INTO contact (name, email, message) VALUES (?, ?, ?)");
						$stmt->bindParam(1, $name, PDO::PARAM_STR);
						$stmt->bindParam(2, $email, PDO::PARAM_STR);
						$stmt->bindParam(3, $message, PDO::PARAM_STR);
						$stmt->execute();
						

						if(!$this->isLocal()) {
							// Create PHPMailer object
							$mail = $this->createMailObj();

							$mail->From = $email;
							$mail->FromName = $name;
							$mail->AddAddress($this->site_email, "Website Framework Demo");
							$mail->AddReplyTo($email, "Reply To");
							$mail->Sender = $email;
							$mail->Subject 		= "$name has contacted " . $this->site_name;
							$mail->Body    		= "From: $name\n\n E-Mail: $email\n\n Message: $message\n\n "; 
							$mail->Send();
							$mail->ClearAddresses();
							
							// Email 2: Send a verification response to user if valid email
							$mail->From 		= $this->site_email;
							$mail->FromName 	= $this->site_name . ' (Do not reply)';
							$mail->AddAddress($email);  
							$mail->Subject 		= $this->site_name." - Contact Confirmation"; 
							$mail->Body    		= "Thanks for contacting $name\n\n We will be in contact with you shortly\n\n\n Your Message to '".$this->site_name."': $message"; 
							$mail->Send();
						}
						$results['html'] = '<div class="window-content"><h3><span>Thanks</span> for contacting '.$this->site_name.'.</h2> <br> <p> We will respond to your enquiry shortly.</p></div>';
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
	}	
}
?>