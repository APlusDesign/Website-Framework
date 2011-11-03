<?php
	include($_SERVER['DOCUMENT_ROOT'] .'/_code/global.php'); 
	$url = $_SERVER['SERVER_NAME'];
	$passChanged = false;
	
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
			$passChanged = true;
		}
	}else if(!$user->signed and !isset($_GET['c'])){
		//Redirect
		_index();
	}
	
?>
<html>
<head>
	<title>Change Password</title>
</head>

<body>
	<h1>Change Password</h1>
	<hr>
	<div class="report">
		<ul>
		<?php
			if(count($_POST) and $user->has_error()){
				foreach($user->error() as $i=>$x){
					echo "<li>$x</li>";
				}
			}
		?>
		</ul>
	</div>
	<?php if(!$passChanged) { ?>
    <form method="post" action="/_content/ajax/change_password">
    	<input name="c" type="hidden" value="<?php echo $_GET['c'] ;?>">    
        <label>New Password:</label><span class="required">*</span>
        <input name="password" type="password" autocomplete="off">        
        <label>Retype New Password:</label><span class="required">*</span>
        <input name="password2" type="password" autocomplete="off">      
        <input value="Change" type="submit">
    </form>
    <?php } else { ?>
    	<a href="/">Return to <?php echo $url; ?></a>
    <?php } ?>
</body>
</html>