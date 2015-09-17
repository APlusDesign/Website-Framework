<?php 
	class activateClass extends WebsiteFramework {
		
		// Don't change __construct
		function __construct($mvc, $seo){
			parent::__construct($mvc, $seo);
			$this->init();
			parent::load_view();
		}

		// Dealing with post data
		public function init(){
			$user = $this->user;
			if (isset($_REQUEST["c"])) {
				$activated = $user->activate($_REQUEST["c"]);
				$this->html = '';
				if ($activated) {
					$this->html = "<p>Your account is now activated</p>";
				} else {
					$this->html = $user->console['errors']['activation'][0];
					$this->_index();
				}
			} else {
				// No access to this page if activate code is not set
				$this->_index();
			}
		}
	}
?>