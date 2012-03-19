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
		<h1>CAMBASE</h1><center>
		<!-- <img src="img/ceimig.jpg"></center> -->
		<script language="JavaScript" type="text/javascript" src="menu.js"></script>

		<div id="content">
			<h1>
				CAMBASE - Home Page
			</h1>
			<p>
			Chem DB is a full chemical stock control DB, it can manage stock control, give valuations of stock on your site, track batch numbers to end product.
			<? include("noticeboard/noticeboard.php"); ?>
			</p>
		</div>
		<div id='footer'>
			<? include("include/footer.php"); ?>
		</div>
	</div>
	
</body>
</html>
