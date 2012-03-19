<?php
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CAMBASE</title>
<link href="cambase.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div id="container">
		<h1>CAMBASE</h1>
		<script language="JavaScript" type="text/javascript" src="menu.js"></script>

		<div id="content">
	
		<h1>Change Password</h1>

<?php
	if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
		echo '<ul class="err">';
		foreach($_SESSION['ERRMSG_ARR'] as $msg) {
			echo '<li>',$msg,'</li>'; 
		}
		echo '</ul>';
		unset($_SESSION['ERRMSG_ARR']);
	}
?>
<form id="loginForm" name="loginForm" method="post" action="changepass-exec.php">
  <table width="300" border="0" align="center" cellpadding="2" cellspacing="0">
    <tr>
      <th>Current Password </th>
      <td><input name="opassword" type="password" class="textfield" id="opassword" /></td>
    </tr>
    <tr>
      <th>New Password </th>
      <td><input name="password" type="password" class="textfield" id="password" /></td>
    </tr>
    <tr>
      <th width="124">Confrim New Password</th>
      <td width="168"><input name="cpassword" type="password" class="textfield" id="cpassword" /></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Change Password" /></td>
    </tr>
  </table>
</form>
</div>
		<div id='footer'>
			<? include("include/footer.php"); ?>
		</div>
	</div>
</body>
</html>
