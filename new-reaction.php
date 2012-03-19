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
	
		<h1>Reactions - Add New Reaction</h1>
		<p>
		<?php
			if (isset($_POST['submit'])) {
				if ($_POST['submit'] == 'Save Reaction') {
					//get form varibles
					$reactionname = $_POST['reactionname'];
					$reactiondescription = $_POST['reactiondescription'];
					$userid = $_SESSION['SESS_MEMBER_ID'];
					//if statments to make sure all of form was completed
					if ((!empty($reactionname)) && (!empty($reactiondescription))) {
						//insert reaction into db
						mysql_query("INSERT INTO reaction (reaction_name, reaction_comments, members_id) VALUES ('$reactionname', '$reactiondescription', '$userid')");
						$reactionid = mysql_insert_id();
						echo "Thank you your reaction has been added to the data base";
						//Call Function To Print Chemical Information Page
						display_reaction($reactionid);
						//Any Batch or Contents Adding T0 Be Done On View Chemical Page
					}
					//Check for incomplete form
					if (empty($reactionname) || empty($reactiondescription)) {
  						echo "Please make sure you have completed all the fields<br><br>";
						//add new reations form with original varibles
						echo "<table border='0'>";
						echo "<form method='post' action='",$_SERVER['PHP_SELF'],"'>";
						echo "<tr><td>Reaction Name </td><td><input type='text' name='reactionname' value='",$reactionname,"'></td></tr>";
						echo "<tr><td>Reaction Description </td><td><textarea name='reactiondescription' rows='5' cols='80'>",$reactiondescription,"</textarea></td></tr>";
						echo "<tr><td>Save Reaction </td><td><input type='submit' value='Save Reaction' name='submit'></td></tr>";
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
				Please complete the form bellow to add your reaction.
				</p>";
				echo "<table border='0'>";
				echo "<form method='post' action='",$_SERVER['PHP_SELF'],"'>";
				echo "<tr><td>Reaction Name </td><td><input type='text' name='reactionname'></td></tr>";
				echo "<tr><td>Reaction Description </td><td><textarea name='reactiondescription' rows='5' cols='80'></textarea></td></tr>";
				echo "<tr><td>Save Reaction </td><td><input type='submit' value='Save Reaction' name='submit'></td></tr>";
				echo "</form>";
				echo "</table>";
			}
		?>
		</div>
		<div id='footer'>
			<? include("include/footer.php"); ?>
		</div>
	</div>
<script type="text/JavaScript" src="../jquery.js"></script>
<script type="text/javascript">
	$(".addSOE").hide();
        $(".show_hide").show();

	$('.show_hide').click(function(){
	$(".addSOE").slideToggle();
	});
</script>
<script type="text/javascript">
	$(".events").show();
        $(".show_hide_events").show();

	$('.show_hide_events').click(function(){
	$(".events").slideToggle();
	});
</script>
<script type="text/javascript">
	$(".useChem").hide();
        $(".show_hide_chem").show();

	$('.show_hide_chem').click(function(){
	$(".useChem").slideToggle();
	});
</script>
</body>
</html>
