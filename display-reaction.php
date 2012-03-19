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
	<script type="text/JavaScript" src="../jquery.js"></script>
	<div id="container">
		<h1>CAMBASE</h1>
		<script language="JavaScript" type="text/javascript" src="menu.js"></script>
		<? require_once("menu/reaction-menu.php"); ?>
		<div id="content">
	
		<h1>Reactions - Add New Reaction</h1>
		<p>
		<?php
			$err = '0';
			//write event information into db
			$reactionid = $_GET['reactionid'];
			if (isset($_POST['submit'])) {
				if ($_POST['submit'] == 'Save Event') {
					if ((empty($_POST['date']))) {
						$eventdate = date('Y-m-d');
					}
					else {
						$eventdate = $_POST['date'];
					}
					if ((empty($_POST['time']))) {
						$eventtime = date('H:i:s');
					}
					else {
						$eventtime = $_POST['time'];
					}
					echo $eventtime;
					$eventdescription = $_POST['event'];
					$memberid = $_SESSION['SESS_MEMBER_ID'];;
					//save event information and re print form with varibles if not complete!
					if ((empty($eventdescription))) {
						$err = '1';
						$errmsg = 'Your event has not been saved. Please enter an event description!';
					}
					else {
						mysql_query("INSERT INTO event (reaction_id, event_date, event_time, event_description, members_id) VALUES ('$reactionid', '$eventdate', '$eventtime', '$eventdescription', '$memberid')");
						$errmsg = "Your event has been logged.";
					}
				}
				if ($_POST['submit'] == 'Use Chemical') {
			
				if ((empty($_POST['date']))) {
						$eventdate = date('Y-m-d');
					}
					else {
						$eventdate = $_POST['date'];
					}
					if ((empty($_POST['time']))) {
						$eventtime = date('H:i:s');
					}
					else {
						$eventtime = $_POST['time'];
					}
					$chemical = $_POST['chemical'];
					$qty = $_POST['qty'];
					$memberid = $_SESSION['SESS_MEMBER_ID'];

				//get chemical name from db so name can be used in event text
				$result = mysql_query("SELECT * FROM batch,chem WHERE batch.batch_id LIKE '$chemical' && batch.chem_id LIKE chem.chem_id");
				//add $matches to make sure batch number is crorrect
				$matches = mysql_affected_rows();
				while($query_data = mysql_fetch_row($result)) {
					$chem_name = $query_data[10];
				}
				//make event description
				$eventdescription = $qty . "g of " . $chem_name . " ceimig batch number: " . $chemical . " added to reaction.  Stock amount automatically updated.";
				//save chemical usage event in event table
				//if statement to make sure the data was submitted
				if ((empty($chemical)) || (empty($qty)) || $matches == '0') {
					$err = '2';
					if ((empty($chemical)) || (empty($qty))) {
						$errmsg = "Please enter a ceimig batch number or quantity ammount.  ";
					}
					if ($matches == '0') {
						$errmsg = $errmsg . "Ceimig Batch Ref not found, please check barcode.";
					}
				}
				else {
				mysql_query("INSERT INTO event (reaction_id, event_date, event_time, event_description, members_id) VALUES ('$reactionid', '$eventdate', '$eventtime', '$eventdescription', '$memberid')");
				//save chemical usage in usebatch table
				mysql_query("INSERT INTO usebatch (reaction_id, batch_id, usebatch_qty) VALUES ('$reactionid', '$chemical', '$qty')");
				//run an update query on batch table to adjust stock
				mysql_query("UPDATE batch SET batch_used=batch_used + '$qty' WHERE batch_id='$chemical'");
				$errmsg = "Your Chemical use has been logged and stock update";
				}
				}
			}
			if ($_POST['submit'] == 'Assign') {
			$user = $_POST['user'];
			mysql_query("INSERT INTO reactionassign (members_id, reaction_id) VALUES ('$user', '$reactionid')");
			}
			if ($_POST['submit'] == 'Delete') {
			$id = $_POST['reactionassignid'];
			mysql_query("DELETE FROM reactionassign WHERE reactionassign_id='$id'");
			}
			display_reaction($reactionid, $err, $chemical, $qty, $err);
			
		?>
		</div>
		<div id='footer'>
			<? include("include/footer.php"); ?>
		</div>
	</div>

<?php
	//display java alert msg with custom message
if ($err != '0') {
	echo "<script type='text/JavaScript'>
	alert('",$errmsg,"');
	</script>";
}

if ($err == '2') {
	echo "<script type='text/javascript'>
	$('.useChem').show();
        $('.show_hide_chem').show();

	$('.show_hide_chem').click(function(){
	$('.useChem').slideToggle();
	});
	</script>";
}
else {
	echo "<script type='text/javascript'>
	$('.useChem').hide();
        $('.show_hide_chem').show();

	$('.show_hide_chem').click(function(){
	$('.useChem').slideToggle();
	});
	</script>";
}
if ($err == '1') {
	echo "<script type='text/javascript'>
	$('.addSOE').show();
        $('.show_hide').show();

	$('.show_hide').click(function(){
	$('.addSOE').slideToggle();
	});
	</script>";
}
else {
	echo "<script type='text/javascript'>
	$('.addSOE').hide();
        $('.show_hide').show();

	$('.show_hide').click(function(){
	$('.addSOE').slideToggle();
	});
	</script>";
}



?>
<script type="text/javascript">
	$(".events").show();
        $(".show_hide_events").show();

	$('.show_hide_events').click(function(){
	$(".events").slideToggle();
	});
</script>
</body>
</html>
