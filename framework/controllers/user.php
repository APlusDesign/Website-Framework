<?php 


	// User is signed in

	if($this->user->isSigned() && !isset($_REQUEST['id'])) {

		$type       = 'private';

	} else {

		// Viewing a public profile
		$query = "SELECT u.* FROM Users AS u ";
				   
		/* ID for public user lookup */
		$uid = $_REQUEST['id'];
		
		// Non numeric user id = instant 404 for security
		if(!$uid || !is_numeric($uid)) {
			$this->_index();
		} 
		
		// Select the user
		$query .= " WHERE u.ID = '{$uid}'"; 
		$tmp = $this->db->fetch_array($query);
		

		// exit if no user to 404
		if(count($tmp)) {
			$user = $tmp[0];
		} else {
			$this->_404();
		}

		$type       = 'public';
	}

	$username 	= $this->user->Username;
	$date       = $this->user->RegDate;
	
	// View data
	$this->type   			= $type;
	$this->username 		= ucwords($username);
	$this->display_title    = $this->username . '\'s '. $this->type .' profile page';
	$this->u_date   		= date("F j, Y, g:i a", $date);
?>