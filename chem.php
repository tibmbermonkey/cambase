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
		<? require_once("menu/chem-menu.php"); ?>
		<div id="content">
			<h1>Chemicals</h1>
		<p>
		The chemical section allows you to see all chemicals on the data base, and those that are in stock.  It also shows the content of the metals and can give you an upto date valuation of this.
		</p>
		<p>
		If you have the right user level then you can add chemicals adjust stock levels and perform other stock administration tasks. Just use the links on the left hand side to perfom the relavent task.
		</div>
		<div id='footer'>
			<? include("include/footer.php"); ?>
		</div>
	</div>
</body>
</html>
