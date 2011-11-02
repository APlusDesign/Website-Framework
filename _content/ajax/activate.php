<?php
	/* Using database class */
	include($_SERVER['DOCUMENT_ROOT'] .'/_code/global.php');

	if (isset($_REQUEST["c"])) {
		$activated = $user->activate($_REQUEST["c"]);
		if ($activated) {
			echo "<p>Your account is now activated</p>";
		} else {
			echo $user->console['errors']['activation'][0];
		}
	} else {
		header( 'Location: http://local.fridigy.com ' ) ;
	}
	exit;
?>