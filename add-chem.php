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
				if ($_POST['submit'] == 'Save Chemical') {
					//get form varibles
					$chemname = $_POST['chemname'];
					$chempcode = $_POST['chempcode'];
					$chemcasnumber = $_POST['chemcasnumber'];
					$chemformula = $_POST['chemformula'];
					$chemmolweight = $_POST['chemmolweight'];
					$chemmanufacturer = $_POST['chemmanufacturer'];
					$chemlocation = $_POST['chemlocation'];
					if ((!empty($chemname)) && (!empty($chempcode)) && (!empty($chemcasnumber)) && (!empty($chemmolweight)) && (!empty($chemmanufacturer))) {
						//insert chemical into db
						mysql_query("INSERT INTO chem (chem_name, chem_pcode, chem_cas_number, chem_formula, chem_mol_weight, chem_manufacturer, chem_location) VALUES ('$chemname', '$chempcode', '$chemcasnumber', '$chemformula', '$chemmolweight', '$chemmanufacturer', '$chemlocation')");
						$chemid = mysql_insert_id();
						echo "Thank you Chemical added to data base";
						display_chem($chemid);
						//Call Function To Print Chemical Information Page
						//Any Batch or Contents Adding T0 Be Done On View Chemical Page
					}
					//Check for complete form
					if (empty($chemname) || empty($chempcode) || empty($chemcasnumber) || empty($chemmolweight) || empty($chemmanufacturer)) {
  						echo "Please make sure you have completed all the fields<br><br>";
						//add chemical form with passed varibles
						echo "<table border='0'>";
						echo "<form method='post' action='",$_SERVER['PHP_SELF'],"'>";
						echo "<tr><td>Chemical Name </td><td><input type='text' name='chemname' value='",$chemname,"'></td></tr>";
						echo "<tr><td>Chemical P Code </td><td><input type='text' name='chempcode' value='",$chempcode,"'></td></tr>";
						echo "<tr><td>Chemical CAS Number </td><td><input type='text' name='chemcasnumber' value='",$chemcasnumber,"'></td></tr>";
						echo "<tr><td>Chemical Formula </td><td><input type='text' name='chemformula' value='",$chemformula,"'></td></tr>";
						echo "<tr><td>Chemical Molecular Weight </td><td><input type='text' name='chemmolweight' value='",$chemmolweight,"'></td></tr>";
						echo "<tr><td>Chemical Manufacturer </td><td>",manufacturer_drop_down(),"</td></tr>";
						echo "<tr><td>Location</td><td><select name='chemlocation'>
						<option selected='selected' value='0'>Please Select Location</option>";
						location_drop_down();
						echo "</select>";
						echo "<tr><td>Save Chemical </td><td><input type='submit' value='Save Chemical' name='submit'></td></tr>";
						echo "</form>";
						echo "</table>";
					}
				}
			}
			else {
				$output_form = true;
			}
			if ($output_form) {
				echo "<p>
				Please complete the form bellow, once the chemical record is complete you can then add contents and batches.
				</p>";
				echo "<table border='0'>";
				echo "<form method='post' action='",$_SERVER['PHP_SELF'],"'>";
				echo "<tr><td>Chemical Name </td><td><input type='text' name='chemname'></td></tr>";
				echo "<tr><td>Chemical P Code </td><td><input type='text' name='chempcode'></td></tr>";
				echo "<tr><td>Chemical CAS Number </td><td><input type='text' name='chemcasnumber' value='",$chemcasnumber,"'></td></tr>";
				echo "<tr><td>Chemical Formula </td><td><input type='text' name='chemformula'></td></tr>";
				echo "<tr><td>Chemical Molecular Weight </td><td><input type='text' name='chemmolweight'></td></tr>";
				echo "<tr><td>Chemical Manufacturer </td><td>",manufacturer_drop_down(),"</td></tr>";
				echo "<tr><td>Location</td><td><select name='chemlocation'>
						<option selected='selected' value='0'>Please Select Location</option>";
						location_drop_down();
						echo "</select>";
				echo "<tr><td>Save Chemical </td><td><input type='submit' value='Save Chemical' name='submit'></td></tr>";
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
