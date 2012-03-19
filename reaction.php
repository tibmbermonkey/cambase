<?php
	require_once('auth.php');
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
			<h1>Reaction</h1>
		<p>
		The reactions area allows you to log a new reaction, edit current reactions and recorded chemical usage against a reaction.
		</p>
		</div>
		<div id='footer'>
			<? include("include/footer.php"); ?>
		</div>
	</div>
</body>
</html>
