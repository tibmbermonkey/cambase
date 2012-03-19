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
	
		<h1>Chemicals - Add New Batch Information</h1>
		<p>
		<?php
			if (isset($_POST['submit'])) {
				if ($_POST['submit'] == 'Save Batch Information') {
					//get form varibles
					$chemid = $_POST['chemid'];
					$batchqty = $_POST['batchqty'];
					$batchnumber = $_POST['batchnumber'];
					$batchlocation = $_POST['chemlocation'];
					$manufacturer = $_POST['chemmanufacturer'];
					if ((!empty($chemid)) && (!empty($batchqty)) && (!empty($batchnumber)) && ($batchlocation != '0') && ($manufacturer != '0')) {
						//insert chemical into db
						mysql_query("INSERT INTO batch (chem_id, batch_qty, batch_number, batch_location, batch_unit, manufacturer_id) VALUES ('$chemid', '$batchqty', '$batchnumber', '$batchlocation', '$unit', '$manufacturer')");
						$batchid = mysql_insert_id();
						echo "Thank you for adding batch information to the chemical, the internal unique identifier is: ",$batchid,"<br><br>";
						echo "Click <a href='view-chem.php?chemid=",$chemid,"'>here</a> to go back to the chemical's information page.";
						
						}
					//Check for complete form
					if (empty($batchqty) || empty($batchnumber) || $batchlocation == '0') {
  						echo "Please make sure you have completed all the fields<br><br>";
						//add chemical form with passed varibles
						echo "<table border='0'>";
						echo "<form method='post' action='",$_SERVER['PHP_SELF'],"'>";
						echo "<tr><td>Chemical ID </td><td><input readonly='readonly' type='text' name='chemid' value='",$chemid,"'></td></tr>";
						echo "<tr><td>Qty of Chemical in Batch (g)</td><td><input type='text' name='batchqty' value='",$batchqty,"'></td></tr>";
						echo "<tr><td>Batch Number From Manufacturer</td><td><input type='text' name='batchnumber' value='",$batchnumber,"'></td></tr>";
						echo "<tr><td>Location</td><td><select name='chemlocation'>
						<option selected='selected' value='0'>Please Select Location</option>";
						location_drop_down();
						echo "</select></td></tr>";
						echo "<tr><td>Batch Manufacturer</td><td>",manufacturer_drop_down(),"</td></tr>";
						echo "<tr><td>Save</td><td><input type='submit' value='Save Batch Information' name='submit'></td></tr>";
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
				echo "<tr><td>Batch QTY (g) </td><td><input type='text' name='batchqty'></td></tr>";
				echo "<tr><td>Manufacturers Batch Number</td><td><input type='text' name='batchnumber'</td></tr>";
				echo "<tr><td>Location</td><td><select name='chemlocation'>
						<option selected='selected' value='0'>Please Select Location</option>";
						location_drop_down();
						echo "</select></td></tr>";
				echo "<tr><td>Batch Manufacturer</td><td>",manufacturer_drop_down(),"</td></tr>";
				echo "<tr><td>Save</td><td><input type='submit' value='Save Batch Information' name='submit'></td></tr>";
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
