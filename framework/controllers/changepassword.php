<?php 
    
    $user = $this->user;
    
	$url = $_SERVER['SERVER_NAME'];
    $this->passChanged = false;
    
    //Proccess Password change
    if(count($_POST)){
        
        $pass = array();
        $pass['password'] = $_POST['password'];
        $pass['password2'] = $_POST['password2'];
            
        if(!$user->signed and isset($_POST['c'])){
            //Change password with confirmation hash
            $user->new_pass($_POST['c'],$pass); 
        }else{
            //Change the password of signed in user without a confirmation hash 
            $user->update($pass);           
        }
        
        //If there is not error
        if(!$user->has_error()){
            //A workaround to display a confirmation message in this specific  Example
            $user->error("Password Changed");
            $this->passChanged = true;
        }
    } else if(!$user->signed and !isset($_GET['c'])){
        //echo 'here'; 
        //exit;
        //Redirect
        $this->_index();
    }
?>