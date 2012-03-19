<?php
	require_once('auth.php');
	include("include/access.php");
	include("include/functions.php");
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
		<? require_once("menu/reaction-menu.php"); ?>
		<div id="content">
	
		<h1>Reactions - View All Assigned To You</h1>
		<p>
		<? $userid = $_GET['userid']; ?>
		<? display_all_reactions($userid); ?>
		</p>
		</div>
		<div id='footer'>
			<? include("include/footer.php"); ?>
		</div>
	</div>
</body>
</html>
