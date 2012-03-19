<?php
	//Start session
	session_start();
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == '')) {
		header("location: access-denied.php?originalurl=http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']);
		exit();
	}
?>
<head>
<link rel="icon" 
      type="image/ico" 
      href="img/ceimig.ico">
</head>
