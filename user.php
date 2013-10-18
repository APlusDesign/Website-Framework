<?php include($_SERVER['DOCUMENT_ROOT'] .'/_code/global.php'); ?>
<?php 
    
    //print_r($_REQUEST);
    //exit;

    /* Not MVC - just do procedurally for now. */

	/* No errors yet */
	$error = false;
	
    /* Base query for the category, orderBy and userId fridigies lists */
    $query = "SELECT u.* FROM users AS u ";
               
	/* Path variables for page and lookup */
	
    $uid   = $_REQUEST['id'];
    
    
    // Non numeric user id = instant 404 for security
    if(!is_numeric($uid)) {
    	_404();
    } 
    
	// Select the user
    $query .= " WHERE u.user_id = '{$uid}'"; 
   
    $aUser = $db->fetch_array($query);
   
    // exit if no user to 404
    if($aUser[0]['user_id']) {
    	$aUser = $aUser[0];
    } else {
    	_404();
    }
    
    // Display options
    $display_title	 	= ucwords($aUser['username']);
    $display 			= "profile";
    
    // View data
    $u_date = date("F j, Y, g:i a", $aUser['reg_date']);

    
?>
<?php
    // Define VIEW data
    $page_title     = (isset($display_title)?$display_title:'A generic title');
    $page_desc      = (isset($display_message)?$display_message:'A generic description');
    $page_keywords  = (isset($display_keywords)?$display_keywords:'some, generic, keywords');
    $page_path      = "/user/";
    $page_name      = $display;
    $template       = "default";
?>
<?php include($_SERVER['DOCUMENT_ROOT'] .'/_templates/'.$template.'/index.php'); ?>