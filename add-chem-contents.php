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
		<? require_once("menu/chem-menu.php"); ?>
		<div id="content">
	
		<h1>Chemicals - Add New Chemical</h1>
		<p>
		<?php
			if (isset($_POST['submit'])) {
				if ($_POST['submit'] == 'Save Contents Information') {
					//get form varibles
					$chemid = $_POST['chemid'];
					$percentage = $_POST['percentage'];
					$contents = $_POST['contents'];
					if ((!empty($chemid)) && (!empty($percentage)) && (!empty($contents))) {
						//insert chemical into db
						mysql_query("INSERT INTO contents (chem_id, contents_percentage, contents_name) VALUES ('$chemid', '$percentage', '$contents')");
						$batchid = mysql_insert_id();
						echo "Thank you for adding contents information to the chemical, the internal unique identifier is: ",$batchid,"<br><br>";
						echo "Click <a href='view-chem.php?chemid=",$chemid,"'>here</a> to go back to the chemical's information page.";
						
						}
					//Check for complete form
					if (empty($percentage) || empty($contents)) {
  						echo "Please make sure you have completed all the fields<br><br>";
						//add chemical form with passed varibles
						echo "<table border='0'>";
						echo "<form method='post' action='",$_SERVER['PHP_SELF'],"'>";
						echo "<tr><td>Chemical ID </td><td><input readonly='readonly' type='text' name='chemid' value='",$chemid,"'></td></tr>";
						echo "<tr><td>Contents Name</td><td>",content_drop_down(),"</td></tr>";
						echo "<tr><td>Percentage Of Contents In Chemical</td><td><input type='text' name='percentage' value='",$percentage,"'></td></tr>";
						echo "<tr><td>Save</td><td><input type='submit' value='Save Contents Information' name='submit'></td></tr>";
						echo "</form>";
						echo "</table>";
					}
				}
			}
			else {
				$output_form = true;
			}
			if ($output_form) {
				$chemid = $_GET['chemid'];
				echo "<p>
				Please complete the form bellow, to add batch information to a chemical, if order is in multiple orders then multiple batch records will be required to give each containers unique indentifiers
				</p>";
				echo "<table border='0'>";
				echo "<form method='post' action='",$_SERVER['PHP_SELF'],"'>";
				echo "<tr><td>Chemical ID</td><td><input readonly='readonly' type='text' name='chemid' value=",$chemid,"></td></tr>";
				echo "<tr><td>Contents Name</td><td>",content_drop_down(),"</td></tr>";
				echo "<tr><td>Percentage Of Contents In Chemical</td><td><input type='text' name='percentage'</td></tr>";
				echo "<tr><td>Save</td><td><input type='submit' value='Save Contents Information' name='submit'></td></tr>";
				echo "</form>";
				echo "</table>";
			}
		?>
		</div>
		<div id='footer'>
			<? include("include/footer.php"); ?>
		</div>
	</div>
</body>
</html>
