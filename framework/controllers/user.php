<?php 
	
	class userClass extends WebsiteFramework {

		function __construct(){
			parent::__construct();
			$this->init();
		}

		public function init(){
			// User is signed in
			if($this->user->isSigned() && !isset($_REQUEST['id'])) {
				// Show the data for logged in user
				$type		= 'private';
				$username 	= $this->user->Username;
				$date 		= $this->user->RegDate;

			} else {
				// Viewing a public profile

				/* ID for public user lookup */
				$uid = (isset($_REQUEST['id']) ? $_REQUEST['id'] : '');
				
				// Non numeric user id = instant 404 for security
				if(!$uid || !is_numeric($uid)) {
					$this->_index();
				} 
				
				// Select the user
				$this->db->connect();
				$query = "SELECT u.* FROM Users AS u ";
				$query .= " WHERE u.ID = '{$uid}'"; 
				$tmp = $this->db->fetch_array($query);
				
				// exit if no user to 404
				if(count($tmp)) {
					$user = $tmp[0];
				} else {
					$this->_404();
				}

				$type       = 'public';
				$username 	= $user['Username'];
				$date 		= $user['RegDate'];
			}

			// View data
			$this->type 			= $type;
			$this->username			= ucwords($username);
			$this->display_title	= $this->username . '\'s '. $this->type .' profile page';
			$this->u_date			= gmdate("F j, Y, g:i a", $date);
		}
	}
	

	

	
	
	
?>