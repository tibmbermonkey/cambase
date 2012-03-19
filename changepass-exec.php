<?php
	//Start session
	session_start();
	
	//Include database connection details
	require_once('config.php');
	
	
	//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	//Connect to mysql server
	$link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
	if(!$link) {
		die('Failed to connect to server: ' . mysql_error());
	}
	
	//Select database
	$db = mysql_select_db(DB_DATABASE);
	if(!$db) {
		die("Unable to select database");
	}
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	
	//Sanitize the POST values
	$opassword = clean($_POST['opassword']);
	$password = clean($_POST['password']);
	$cpassword = clean($_POST['cpassword']);
	
	//Input Validations
	if($opassword == '') {
		$errmsg_arr[] = 'Old Password Missing';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
	if($cpassword == '') {
		$errmsg_arr[] = 'Confirm password missing';
		$errflag = true;
	}
	if( strcmp($password, $cpassword) != 0 ) {
		$errmsg_arr[] = 'Passwords do not match';
		$errflag = true;
	}
	
	//Check old password
		$userid = $_SESSION['SESS_MEMBER_ID'];
		$qry = "SELECT * FROM members WHERE member_id='$userid'";
		$result = mysql_query($qry);
		while($query_data = mysql_fetch_row($result)) {
			$current_pass = $query_data[4];
			if ($current_pass == md5($opassword)) {
			}
			else {
				$errmsg_arr[] = 'Current Password Wrong';
				$errflag = true;
			}
		}
	
	
	//If there are input validations, redirect back to the registration form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: change-password.php");
		exit();
	}

	//Create INSERT query
	$qry = "UPDATE members SET passwd='".md5($password)."' WHERE member_id='$userid'";
	$result = @mysql_query($qry);
	
	//Check whether the query was successful or not
	if($result) {
		header("location: changepass-success.php");
		exit();
	}else {
		die("Query failed");
	}
?>
