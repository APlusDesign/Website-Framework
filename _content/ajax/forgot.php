<?php
	
	include($_SERVER['DOCUMENT_ROOT'] .'/_code/global.php'); 

	//Proccess Update
	if(count($_POST)){
		$res = $user->pass_reset($_POST['email']);
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
			
			//Redirect
			//_index();
			//If there is not error
			if(!$user->has_error()){
				//A workaround to display a confirmation message in this specific  Example
				$user->error("Password Reset, please check your email");
			}
		}
	}
	
?>
<div id="pre-window-wrap">
    <h3>Forgotten your password?</h3>
    <div class="user-form">
        <form id="forgot" method="post" action="/_ajax/switch.php?flag=forgot">
            <div id="forgot-email" class="input-wrap">
                <label>Email: </label>
                <input name="email" type="text" value="">
            </div>
            <div class="forgot-action">
            	<input type="submit" value="Reset">
            </div>
        </form>
    </div>
</div>
