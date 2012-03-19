<head>
<link rel="StyleSheet" href="../cambase.css" type="text/css">
</head>
<?php
	include("access.php");
	include("functions.php");
?>
<table width="100%" background="images/fzm-seamless.corkboard.texture-01-[500x500].jpg">
	<tr>
		<td colspan ="2" width="100%" valign="top">
			<div align="center">
				<table class="notice">
					<tr>
						<td>
							<img src="images/pin-3.png" border="0">
						</td>
						<td>
							<div align="center">
								<h1>CAMBASE - Notice Board</h1>
							</div>
						</td>
						<td>
							<img src="images/pin-3.png" border="0">
						</td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<div align="center">
					<br>
					<table border="0" class="null" width="100%">
					</table>
					<table class="notice">
						<tr>
							<td>
								<img src="images/pin-4.png" border="0">
							</td>
							<td>
								<div align="center">
								<h1>Issues</h1>
								Known bugs in CAMBASE<br><br>
								1) Links in footer not working<br>
        							<br>For a full list and to report a bug, <a href="bugs.php">click here</a>	
								</div>
							</td>
							<td>
								<img src="images/pin-4.png" border="0">
							</td>
						</tr>
					</table>
					<br>
						<div class="notice3">
							<img src="images/pin-2.png" border="0" align="left">
							<img src="images/pin-2.png" border="0" align="right">
       							<center>TO DO</center><br><Br>
							1) Min Stock Level<br>
							2) Use Chemical In Reaction<br>
							3) Make Notice Board Functional<br>
							4) Write Admin Area<br>
							<strike>5) CSS Login Failed Page<br></strike>
							<strike>6) Make Content Page<br></strike>
							<strike>7) Make second tier menu horizontal<br></strike>
							<strike>8) Make value calculation input troy ounce<br></strike>
							9) Show chemical's used when displaying reaction<br>
							10) Add Chemical made to reaction
						</div>
						<br>
						
		<td width="50%" valign="top">
			<div align="center">
				
			</div>
			<br>
		</div>
		<br>
               		<div class="notice3">
				<img src="images/pin-1.png" border="0" align="left">
				<img src="images/pin-2.png" border="0" align="right">
				<center><a href="stock-level.php">Stock Level Notice Board</a></center><br><br>
				<? display_stock_levels(); ?>
			</div>
			<br>
			
			<br>
                
		</td>
	</tr>
</table>
