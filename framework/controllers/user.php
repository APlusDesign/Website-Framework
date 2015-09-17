<?php 
	// A class to deal with the profile page for a user 
	class userClass extends WebsiteFramework {

		// Don't change __construct
		function __construct($mvc, $seo){
			parent::__construct($mvc, $seo);
			$this->init();
			parent::load_view();
		}

		public function init(){
			// User is signed in
			if($this->user->isSigned()) {
				$username 	= $this->user->Username;
				$date 		= $this->user->RegDate;
				// Set Some View data
				$this->username			= ucwords($username);
				$this->display_title	= $this->username . '\'s profile page';
				$this->u_date			= gmdate("F j, Y, g:i a", $date);
			} else {
				// Redirect to home page
				$this->_index();
			}
		}
	}
	
?>