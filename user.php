<?php 
    /* Global Include */ 
    include($_SERVER['DOCUMENT_ROOT'] .'/_code/global.php'); 
	
	/* No errors yet */
	$error = false;
	
    /* Base query for the category, orderBy and userId fridigies lists */
    $query = "SELECT u.* FROM users AS u ";
               
	/* Path variables for page and lookup */
	$uri = $_SERVER['PATH_INFO'];
	$uriArr = explode('/', $uri);
    
    // User id
    $isView = isset($uriArr[1]);
    if ($isView) {
    	$view = $uriArr[1];
    }
    // Non numeric user id = instant 404 for security
    if(!is_numeric($view)) {
    	_404();
    } 
    
    // View switch 
	$isSwitch = isset($uriArr[2]);
    if ($isSwitch) {
    	$switch = $uriArr[2];
    }
    
    // Edit page for signed in users eg. /user/1/edit
    if ($isView && $isSwitch && $switch == "edit") {
  		
        if($user->signed) {
            $uid = $view;
        
            // Select the user
            $query .= " WHERE u.user_id = '{$uid}'"; 
            $aUser = $db->fetch_array($query);
            
            // exit if no user to 404
            if($aUser[0]['user_id']) {
                $aUser = $aUser[0];
            } else {
                $error = true;
            }
        } else {
            $error = true;
        }
        
        // Either user was nto signed in or could not retrieve their user details
        if($error) {
        	_index();
        }    
            
        // Page variables
        $u_date 			= date("F j, Y, g:i a", $aUser['reg_date']);
            
   		// Display options
        $display_title	 	= ucwords($aUser['username']);
        $display 			= "edit";
        
    } 
    
    // Single User by ID eg. /user/1/ 
    elseif ($isView) {
    
        $uid = $view;
        
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

    } 
    
    // Couldn't find a view redirect here
    else {
		_404();
	}
    
?>

<?php
// Page Variables
$page_title 	= (isset($display_title)?$display_title:'A generic title');
$page_desc 		= (isset($display_message)?$display_message:'A generic description');
$page_keywords 	= (isset($display_keywords)?$display_keywords:'some, generic, keywords');
$page_path 		= "/user/";
$page_name 		= $display;
include($_SERVER['DOCUMENT_ROOT'] .'/_templates/default/index.php'); 
?>

