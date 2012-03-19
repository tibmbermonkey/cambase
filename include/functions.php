<?php
/*
THIS FILE CONTAINS FUNCTIONS THAT ARE USED MORE THAT ONCE IN THE SOFTWARE, ALSO USED TO HELP TIDY UP CODE
*/

//Displays a single chemical
function display_chem($chemid) {
	echo "<table border='0' width='100%'>";
	$result = mysql_query("SELECT * FROM chem,location,manufacturer WHERE chem.chem_id LIKE '$chemid' AND chem.chem_location LIKE location.location_id AND chem.chem_location LIKE manufacturer.manufacturer_id");
	while($query_data = mysql_fetch_row($result)) {
		$chemname = $query_data[1];
		$chempcode = $query_data[2];
		$chemcasnumber = $query_data[3];
		$chemformula = $query_data[4];
		$chemmolweight = $query_data[5];
		$chemmanufacturer = $query_data[11];
		$chemlocation = $query_data[7];
		$locationname = $query_data[9];
		echo "<tr><td colspan='4'><span id='chemname'>",$chemname,"</span></td></tr>";
		echo "<tr><td colspan='2'><span id='chemheading'>P Code:</span> ",$chempcode,"</td><td colspan='2'><span id='chemheading'>CAS Number:</span> ",$chemcasnumber,"</td></tr>";
		echo "<tr><td colspan='2'><span id='chemheading'>Chemical Formula:</span> ",$chemformula,"</td><td colspan='2'><span id='chemheading'>Molecular Weight:</span> ",$chemmolweight,"</td></tr>";
		echo "<tr><td colspan='2'><span id='chemheading'>Manufacturer:</span> ",$chemmanufacturer,"</td><td colspan='2'><span id='chemheading'>location:</span> ",$locationname,"</td></tr>";
		
	}
	echo "</table><br><br>";
	//need to grab batch and contents in formation, display in 2 div float left and right
	echo "<div id='posleft'>";
	echo "<table border='1' width='100%'>";
	echo "<tr><td colspan='4'><span id='tblheading'>Contents of Chemical</span></td></tr>";
	display_contents_information($chemid);
	if ($_SESSION['SESS_USR_LEVEL'] >= 5) {	
		echo "<tr><td colspan='2' align='center'><a href='add-chem-contents.php?chemid=",$chemid,"'>Add New Contents</a></td></tr>";
	}
	echo "</table>";
	echo "</div>";
	echo "<div id='posright'>";
	echo "<table border='1' width='100%'>";
	echo "<tr><td colspan='5'><span id='tblheading'>Batch Information</span></td></tr>";
	display_batch_information($chemid);
	if ($_SESSION['SESS_USR_LEVEL'] >= 5) {	
		echo "<tr><td colspan='5' align='center'><a href='add-chem-batch.php?chemid=",$chemid,"'>Add New Batch</a></td></tr>";
	}
	echo "</table>";
	echo "</div>";
}

//Displays batch information of a chemical
function display_batch_information($chemid) {
	echo "<tr><td>Ceimig Ref</td><td>Qty In Stock</td><td>Batch Number</td><td>Location</td><td>Manufacturer</td></tr>";
	$result = mysql_query("SELECT * FROM batch,location,manufacturer WHERE batch.chem_id LIKE '$chemid' AND batch.batch_location LIKE location.location_id AND batch.manufacturer_id LIKE manufacturer.manufacturer_id");
	while($query_data = mysql_fetch_row($result)) {
		$batchid = $query_data[0];
		$batchqty = $query_data[2];
		$batchused = $query_data[3];
		$batchnumber = $query_data[4];
		$unitid = $query_data[6];
		$location = $query_data[10];
		$manufacturer = $query_data[12];
		$qtyinstock = $batchqty - $batchused;
		$result_unit = mysql_query("SELECT * FROM unit WHERE unit_id LIKE '$unitid'");
		echo "<tr><td>",$batchid,"</td><td>",$qtyinstock," g</td><td>",$batchnumber,"</td><td>",$location,"</td><td>",$manufacturer,"</td></tr>";
	}
}

//Displays contents information of a chemical
function display_contents_information($chemid) {
	echo "<tr><td>Contents</td><td>% In Chemical</td></tr>";
	$result = mysql_query("SELECT * FROM contents,content WHERE chem_id LIKE '$chemid' AND contents.contents_name LIKE content.content_id");
	while($query_data = mysql_fetch_row($result)) {
		$percentage = $query_data[2];
		$contents = $query_data[5];
		echo "<tr><td>",$contents,"</td><td>",$percentage,"</td></tr>";
	}
}
	
//Displays all Chmicals in the data base in a list
function display_all_chem() {
	echo "<TABLE class='menu-bar2'><tr>";
	$i = 1;
	$result = mysql_query("SELECT * FROM chem ORDER BY chem_name");
	while($query_data = mysql_fetch_row($result)) {
		$chemid = $query_data[0];
		$chemname = $query_data[1];
		echo "<td><a class='menu' href='view-chem.php?chemid=",$chemid,"'>",$chemname,"</a></td>";
		if ($i == 5) {
			echo "</tr><tr>";
			$i = 0;
		}		
		$i ++;
	}
	echo "</tr></table>";	
}

//writes locations into a drop down
function location_drop_down() {
	$result = mysql_query("SELECT * FROM location ORDER BY location_name");
	while($query_data = mysql_fetch_row($result)) {
		$locationid = $query_data[0];
		$locationname = $query_data[1];
		echo "<option value='",$locationid,"'>",$locationname,"</option>";
	}

}

//wites full drop down for unit of measure
function unit_drop_down() {
	echo "<select name='unit'>";
	echo "<option value='0'>Unit</option>";
	$result = mysql_query("SELECT * FROM unit ORDER BY unit_unit");
	while($query_data = mysql_fetch_row($result)) {
		$unitid = $query_data[0];
		$unit = $query_data[1];
		echo "<option value='",$unitid,"'>",$unit,"</option>";
	}
	echo "</select>";
}

//wites full drop down for manufacture
function manufacturer_drop_down() {
	echo "<select name='chemmanufacturer'>";
	echo "<option value='0'>Manufacturer</option>";
	$result = mysql_query("SELECT * FROM manufacturer ORDER BY manufacturer_name");
	while($query_data = mysql_fetch_row($result)) {
		$manufacturerid = $query_data[0];
		$manufacturername = $query_data[1];
		echo "<option value='",$manufacturerid,"'>",$manufacturername,"</option>";
	}
	echo "</select>";
}

//wites full drop down for contents
function content_drop_down() {
	echo "<select name='contents'>";
	echo "<option value='0'>Slect Contents</option>";
	$result = mysql_query("SELECT * FROM content ORDER BY content_name");
	while($query_data = mysql_fetch_row($result)) {
		$contentid = $query_data[0];
		$contentname = $query_data[1];
		echo "<option value='",$contentid,"'>",$contentname,"</option>";
	}
	echo "</select>";
}

//wites full drop down for users
function users_drop_down() {
	echo "<select name='user'>";
	echo "<option value='0'>Select User</option>";
	$result = mysql_query("SELECT * FROM members ORDER BY firstname");
	while($query_data = mysql_fetch_row($result)) {
		$userid = $query_data[0];
		$fname = $query_data[1];
		$sname = $query_data[2];
		echo "<option value='",$userid,"'>",$fname," ",$sname,"</option>";
	}
	echo "</select>";
}

//Displays all Contents and amounts in the data base in a list
function display_all_content() {
	$qtygrams = 0;
	echo "<TABLE class='menu-bar2'><tr>";
	$result = mysql_query("SELECT * FROM content ORDER BY content_name");
	while($query_data = mysql_fetch_row($result)) {
		$contentid = $query_data[0];
		$contentname = $query_data[1];
		$result_contents = mysql_query("SELECT * FROM contents WHERE contents_name LIKE '$contentid'");
		while($query_data_contents = mysql_fetch_row($result_contents)) {
			$chemid = $query_data_contents[1];
			$percentage = $query_data_contents[2];
			$result_batch = mysql_query("SELECT * FROM batch,unit WHERE chem_id LIKE '$chemid' AND batch.batch_unit LIKE unit.unit_id");
			while($query_data_batch = mysql_fetch_row($result_batch)) {
				$qtygrams = $query_data_batch[2] - $query_data_batch[3];
				$qtygrams = $qtygrams / 100;
				$qtygrams = $qtygrams * $percentage;
				$total = $total + $qtygrams;
			}
		}
		echo "<td><a class='menu' href='content-details.php?contentid=",$contentid,"'>",$contentname,", ",$total,"g</a></td>";
		if ($i == 5) {
			echo "</tr><tr>";
			$i = 0;
		}		
		$i ++;
		$total = 0;
		$qtygrams = 0;
	}
	echo "</table>";	
}

//Displays Content and contents information and allow form for working out value in stock
function display_content($contentid) {
	$realtotal = 0;
	echo "<TABLE width='100%'>";
	$result = mysql_query("SELECT * FROM content WHERE content_id LIKE '$contentid' ORDER BY content_name");
	while($query_data = mysql_fetch_row($result)) {
		$contentid = $query_data[0];
		$contentname = $query_data[1];
		$result_contents = mysql_query("SELECT * FROM contents WHERE contents_name LIKE '$contentid'");
		while($query_data_contents = mysql_fetch_row($result_contents)) {
			$chemid = $query_data_contents[1];
			$percentage = $query_data_contents[2];
			$result_batch = mysql_query("SELECT * FROM batch WHERE chem_id LIKE '$chemid'");
			while($query_data_batch = mysql_fetch_row($result_batch)) {
				$qty = $query_data_batch[2] - $query_data_batch[3];
				$qtygrams = $qty;
				$qtygrams = $qtygrams / 100;
				$qtygrams = $qtygrams * $percentage;
				$total = $total + $qtygrams;
			}
		$qtygrams = 0;
		}
		echo "<tr><td colspan='6'><span id='chemname'>",$contentname,"</span></td></tr>";
		echo "<tr><td><span id='chemheading'>Content Name</span> ",$contentname,"</td><td><span id='chemheading'>Total In Stock</span> ",$total," g</td></t>";
		$total = 0;
		echo "<tr><td colspan='6'><span id='chemname1'>Batch Numbers Containing</span></td></tr>";
		echo"<tr><td>Batch ID</td><td>Chemical</td><td>Amount Of Chemical</td><td>% In Chemical</td><td>Amount of ",$contentname,"</td><td>Location</td></tr>";
		$result_batch_containing = mysql_query("SELECT * FROM contents,chem,batch,location WHERE contents.contents_name LIKE '$contentid' AND contents.chem_id LIKE chem.chem_id AND chem.chem_id LIKE batch.chem_id AND batch.batch_location LIKE location.location_id");
		while($query_data_containing = mysql_fetch_row($result_batch_containing)) {
			echo "<tr><td>",$query_data_containing[12],"</td>";
			echo "<td>",$query_data_containing[5],"</td>";
			$instock = $query_data_containing[14] - $query_data_containing[15];			
			echo "<td>",$instock,"g</td>";
			$chem_grams = $instock;
			$percent = $query_data_containing[2];
			$grams = $chem_grams / 100;
			$grams = $grams * $percent;
			echo "<td>",$percent,"%</td>";
			echo "<td>",$grams," g</td>";
			echo "<td>",$query_data_containing[22],"</td></tr>";
			$total = $total + $grams;
		}
	echo "<tr><td></td><td></td><td></td><td><span id='chemheading'>Total Grams In Stock:</span></td><td>",$total," g</td></tr>";		
	}
	echo "</table>";
	//now print a form to allow user to put current exchange rate and price of centent and calculate
?>
<a href="javascript: void(0)" class="show_hide">Show/hide Value Calculations</a><br><br>
<div class="slidingDiv">
<?php
	if (isset($_POST['submit'])) {
		$value = $_POST['value'];
		//now convert value into price per gram
		$value = $value/31.103;
		$exchange = $_POST['exchange'];
		$stirlingprice = $value / $exchange;
		$stirlingprice = $stirlingprice * $total;
		$stirlingprice = round($stirlingprice,2);
		echo "Value of contents in stock: &pound;",$stirlingprice," using $",$exchange," to a pound and $",$value," per gram.";
	}
	else {
		$output_form = true;
	}
	if ($output_form) {
		echo "<form method='post' action='",$_SERVER['PHP_SELF'],"?contentid=",$contentid,"'>";
		echo "Value of $ <input type='text' name='exchange'> ";
		echo "Price of ",$contentname," per Troy Ounce <input type='text' name='value'>";
		echo "<input type='submit' value='Calculate' name='submit'>";
		echo "</form>";
	}
	echo "<a href='javascript: void(0)' class='show_hide'>hide</a>";	
	echo "</div>";
}

//display reaction information
function display_reaction($reactionid, $err, $chemical, $qty, $err) {
	
	echo "<table border='0' width='100%'>";
	$result = mysql_query("SELECT * FROM reaction,members WHERE reaction.reaction_id LIKE '$reactionid' && reaction.members_id LIKE members.member_id");
	while($query_data = mysql_fetch_row($result)) {
		$reactionname = $query_data[1];
		echo "<tr><td colspan='4'><span id='chemname'>",$reactionname,"</span></td></tr>";
		echo "<tr><td align='left' width='110'><span id='chemheading'>Staff Member: </span></td><td align='left'>",$query_data[6],"</td><td colspan='2'>&nbsp;</td></tr>";
		echo "<tr><td><span id='chemheading'>Reaction Description </span></td><td colspan='3' align='left'>",$query_data[2],"</td></tr>";
	}
	echo "</table>";

	echo "<p><div id='posleft'>";
	echo "<table border='0' width='80%'>";
	echo "<tr><td colspan='5' class='chemqty' align='center'>Chemicals Used</td></tr>";
	echo "<tr><td class='chemqty'>Ceimig Ref</td><td class='chemqty'>Chemical</td><td class='chemqty'>Batch No.</td><td class='chemqty'>Manufacturer</td><td class='chemqty'>Qty Used</td></tr>";
	chemicals_used($reactionid);
	echo "</table><br>";
	echo "</div>";
	//show assigned users to this reaction
	echo "<div id='posright'>";
	echo "<table border='0' width='20%'>";
	echo "<tr><td colspan='2' align='center'>Users Assigned</td></tr>";
	$result = mysql_query("SELECT * FROM reactionassign,members WHERE reactionassign.reaction_id LIKE '$reactionid' && reactionassign.members_id LIKE members.member_id");
	while($query_data = mysql_fetch_row($result)) {
		echo "<form method='post' action='",$_SERVER['PHP_SELF'],"?reactionid=",$reactionid,"'><input type='hidden' name='reactionassignid' value='",$query_data[0],"'><tr><td>",$query_data[4]," ",$query_data[5],"</td><td><input type='submit' value='Delete' name='submit'></td></tr></form>";
	}
	echo "<form method='post' action='",$_SERVER['PHP_SELF'],"?reactionid=",$reactionid,"'><tr><td>",users_drop_down(),"</td><td><input type='submit' value='Assign' name='submit'></td></tr></form>";
	echo "</table><br>";
	echo "</div></p><br><br><div id='nothing'>";
echo "<a href='javascript: void(0)' class='show_hide_events'>Show/Hide Events</a><br>";
	echo "<div class='events'>";
		
		//querry db and display all events for this reaction id
		echo "<table class='events' border='0' width='100%'><tr><td>Date</td><td>Time</td><td>Event</td><td>Staff Member</td></tr>";
		$result = mysql_query("SELECT * FROM event,members WHERE event.reaction_id LIKE '$reactionid' && event.members_id LIKE members.member_id ORDER BY event.event_date, event.event_time");
		while($query_data = mysql_fetch_row($result)) {
			$date = $query_data[2];
			$time = $query_data[3];
			$event = $query_data[4];
			$user = $query_data[7] . " " . $query_data[8];
			echo "<tr>
				<td>",$date,"</td>
				<td>",$time,"</td>
				<td>",$event,"</td>
				<td>",$user,"</td>
			</tr>";			
		}
		echo "</table>";
		
		//print forms for adding events, wrapped in j query to hide and show		
		echo "<a href='javascript: void(0)' class='show_hide'>Add Event</a><br><br>";
		echo "<div class='addSOE'>";
			echo "<form method='post' action='display-reaction.php?reactionid=",$reactionid,"'>";
				echo "<table border='0'>";
					echo "<tr><td colspan='4'>If date/time left blank then current date/time will be used</td</tr>";
					echo "<tr><td>Date yyyy/mm/dd</td><td>Time</td><td>Event</td><td>Save</td></tr>";
					echo "<tr><td><input type='text' name='date'></td>";
					echo "<td><input type='text' name='time'></td>";
					echo "<td><input type='text' name='event'></td>";
					echo "<td><input type='submit' value='Save Event' name='submit'></td></tr>";
				echo "</table>";
			echo "</form>";
			echo "<a href='javascript: void(0)' class='show_hide'>hide</a>";
		echo "</div>";
		//option to add chemical usage
		echo "<a href='javascript: void(0)' class='show_hide_chem'>Add Chemical Usage</a><br><br>";
		echo "<div class='useChem'>";
			echo "<form method='post' action='display-reaction.php?reactionid=",$reactionid,"'>";
				echo "<table border='0'>";
					echo "<tr><td colspan='5'>If date/time left blank then current date/time will be used</td</tr>";
					echo "<tr><td>Date yyyy/mm/dd</td><td>Time</td><td>Ceimig Ref (Barcode)</td><td>Qty Used Grams</td><td>Save</td></tr>";
					echo "<tr><td><input type='text' name='date'></td>";
					echo "<td><input type='text' name='time'></td>";
					//if statment to print for with passed varibles
					if ($err == '2') {
						echo "<td><input type='text' name='chemical' value='",$chemical,"'></td>";
						echo "<td><input type='text' name='qty' value='",$qty,"'></td>";
					}
					else {
						echo "<td><input type='text' name='chemical'></td>";
						echo "<td><input type='text' name='qty'></td>";
					}
					echo "<td><input type='submit' value='Use Chemical' name='submit'></td></tr>";
				echo "</table>";
			echo "</form>";
			echo "<a href='javascript: void(0)' class='show_hide_chem'>hide</a>";
		echo "</div>";
	echo "</div></div>";
}

//Displays all Reactions in the data base
function display_all_reactions($userid) {
	if ($userid == 'all') {
		$sql = "SELECT * FROM reaction,members WHERE reaction.reaction_status NOT LIKE '5' && reaction.members_id LIKE members.member_id ORDER BY reaction.reaction_id";
		}
	else {
		$sql = "SELECT * FROM reaction,members WHERE reaction.members_id LIKE '$userid' && reaction.reaction_status NOT LIKE '5' && reaction.members_id LIKE members.member_id ORDER BY reaction.reaction_id";
	}
	echo "<TABLE width='100%' border='0'>";	
	echo "<tr><td>Reaction ID</td><td>Reaction Name</td><td>Owner</td><td>Status</td><td>View</td></tr>";
	$i = 1;
	$result = mysql_query($sql);
	while($query_data = mysql_fetch_row($result)) {
		$reactionid = $query_data[0];
		$reactionname = $query_data[1];
		$reactionstatus = $query_data[4];
		$membersname = $query_data[6] . " " . $query_data[7];
		echo "<tr>
			<td>",$reactionid,"</td>
			<td>",$reactionname,"</td>
			<td>",$membersname,"</td>
			<td>",$reactionstatus,"</td>
			<td><a href='display-reaction.php?reactionid=",$reactionid,"'>View</a></td><tr>";
	}
	//now search for reactions assigned to user from another user
	if ($userid != 'all') {
	$user_id = $_SESSION['SESS_MEMBER_ID'];
	echo "<tr><td colspan='5' align='center'>Other Users Reactions Assigned To You</td></tr>";
	echo "<tr><td>Reaction ID</td><td>Reaction Name</td><td>Owner</td><td>Status</td><td>View</td></tr>";
	$result = mysql_query("SELECT * FROM reaction,members,reactionassign WHERE reaction.reaction_status NOT LIKE '5' && reaction.members_id LIKE members.member_id && reaction.reaction_id LIKE reactionassign.reaction_id && reactionassign.members_id LIKE '$user_id' ORDER BY reaction.reaction_id");
	while($query_data = mysql_fetch_row($result)) {
		$reactionid = $query_data[0];
		$reactionname = $query_data[1];
		$reactionstatus = $query_data[4];
		$membersname = $query_data[6] . " " . $query_data[7];
		echo "<tr>
			<td>",$reactionid,"</td>
			<td>",$reactionname,"</td>
			<td>",$membersname,"</td>
			<td>",$reactionstatus,"</td>
			<td><a href='display-reaction.php?reactionid=",$reactionid,"'>View</a></td><tr>";
	}
	}
	echo "</table>";	
}

function chemicals_used($reactionid) {
	$result = mysql_query("SELECT * FROM usebatch,batch,chem,manufacturer WHERE usebatch.reaction_id LIKE '$reactionid' && usebatch.batch_id LIKE batch.batch_id && batch.chem_id LIKE chem.chem_id && batch.manufacturer_id LIKE manufacturer.manufacturer_id");
	while($query_data = mysql_fetch_row($result)) {
		$ceimig = $query_data[2];
		$chemical = $query_data[14];
		$batchnumber = $query_data[8];
		$manufacturer = $query_data[23];
		$qty = $query_data[3];
		echo "<tr><td class='chemqty'>",$ceimig,"</td><td class='chemqty'>",$chemical,"</td><td class='chemqty'>",$batchnumber,"</td><td class='chemqty'>",$manufacturer,"</td><td class='chemqty'>",$qty,"g</td></tr>";
	}
}
?>


