<table width="100%" background="images/fzm-seamless.corkboard.texture-01-[500x500].jpg">
<tr><td width="50%" valign="top">

<?
$sql = "SELECT  
			events.AutoID,
			events.Type,
			events.Booking,
			CONCAT('&pound;',events.Charge) as Charge,
			date_FORMAT(events.Date, '%a %d/%m/%y') as Date,
			time_FORMAT(events.Start, '%H:%i') as Start,
			time_FORMAT(events.End, '%H:%i') as End,
			events.Title as Event,
			_units.Unit as Unit_providing,
			booking.Unit as Unit_requesting,
			events.DIPSRef as DIPS_ref,
			events.Pref as Pay_ref,
			CASE
				WHEN DATE (events.Date) >= DATE(Now()) AND events.Confirmed = '0000-00-00' THEN 'Booking not confirmed'
				WHEN DATE (events.Date) >= DATE(Now()) AND events.Staffed = '0000-00-00' THEN 'Responders needed'
				WHEN DATE (events.Date) >= DATE(Now()) AND events.Staffed <> '0000-00-00' AND events.Type ='Duty' THEN 'Fully covered'
				WHEN DATE (events.Date) >= DATE(Now()) AND events.Staffed <> '0000-00-00' AND events.Type <>'Duty' THEN 'Booking confirmed'
				END as Status
			FROM events
			LEFT JOIN _units AS _units ON events.idUnits=_units.AutoID
			LEFT JOIN _units AS booking ON events.Booking=booking.AutoID
			WHERE events.Deleted = '0000-00-00'
			AND events.Cancelled = '0000-00-00'
			AND events.Date >= DATE(Now())
			AND events.idCounties=$My_County_id
			ORDER BY events.Date ASC
			LIMIT 5"; 
$result = mysql_query("$sql");
$i=0;
$event1="";
$event2="";
$event3="";
$event4="";
$event5="";
$num=mysql_numrows($result);
		if ($num==0) {
			// Do nothing //
		} else {
			while($row = mysql_fetch_assoc($result)){
				$i=$i+1;
				if ($i==1) {
					if ($row["Type"]=="Duty") {
						$event1 = '<div class="post-it1" id="duty">';
					} else { 
						$event1 = '<div class="post-it1" id="event">';
					}
					$event1=$event1.'<a href="members_event_view.php?id='.$row["AutoID"].'">'.$row["Event"].'</a>';
					$event1=$event1.'<br>'.$row["Date"].' ('.$row["Start"].' - '.$row["End"].')';
					$event1=$event1.'<br>'.$row["Unit_providing"];
					$event1=$event1.'<br>'.$row["Status"];
					$event1=$event1.'</div>';
				} else if ($i==2) {
					if ($row["Type"]=="Duty") {
						$event2 = '<div class="post-it2" id="duty">';
					} else { 
						$event2 = '<div class="post-it2" id="event">';
					}
					$event2=$event2.'<a href="members_event_view.php?id='.$row["AutoID"].'">'.$row["Event"].'</a>';
					$event2=$event2.'<br>'.$row["Date"].' ('.$row["Start"].' - '.$row["End"].')';
					$event2=$event2.'<br>'.$row["Unit_providing"];
					$event2=$event2.'<br>'.$row["Status"];
					$event2=$event2.'</div>';
				} else if ($i==3) {
					if ($row["Type"]=="Duty") {
						$event3 = '<div class="post-it3" id="duty">';
					} else { 
						$event3 = '<div class="post-it3" id="event">';
					}
					$event3=$event3.'<a href="members_event_view.php?id='.$row["AutoID"].'">'.$row["Event"].'</a>';
					$event3=$event3.'<br>'.$row["Date"].' ('.$row["Start"].' - '.$row["End"].')';
					$event3=$event3.'<br>'.$row["Unit_providing"];
					$event3=$event3.'<br>'.$row["Status"];
					$event3=$event3.'</div>';
				} else if ($i==4) {
					if ($row["Type"]=="Duty") {
						$event4 = '<div class="post-it4" id="duty">';
					} else { 
						$event4 = '<div class="post-it4" id="event">';
					}
					$event4=$event4.'<a href="members_event_view.php?id='.$row["AutoID"].'">'.$row["Event"].'</a>';
					$event4=$event4.'<br>'.$row["Date"].' ('.$row["Start"].' - '.$row["End"].')';
					$event4=$event4.'<br>'.$row["Unit_providing"];
					$event4=$event4.'<br>'.$row["Status"];
					$event4=$event4.'</div>';
				} else if ($i==5) {
					if ($row["Type"]=="Duty") {
						$event5 = '<div class="post-it5" id="duty">';
					} else { 
						$event5 = '<div class="post-it5" id="event">';
					}
					$event5=$event5.'<a href="members_event_view.php?id='.$row["AutoID"].'">'.$row["Event"].'</a>';
					$event5=$event5.'<br>'.$row["Date"].' ('.$row["Start"].' - '.$row["End"].')';
					$event5=$event5.'<br>'.$row["Unit_providing"];
					$event5=$event5.'<br>'.$row["Status"];
					$event5=$event5.'</div>';
				}
			}
		}
			
// END SQL QUERY //
?>

<div align="center">
	<table class="notice">
	<tr><td><img src="images/pin-3.png" border="0"></td>
	<td>
		<div align="center">
		<h1>Upcoming events</h1>
		Duties and training events coming up. <br>For a full list, <a href="members_events.php">click here</a> 	
		</div>
	</td>
	<td><img src="images/pin-3.png" border="0"></td>
	</tr></table><br>
	<table border="0" class="null" width="100%">
	<tr>
	<td>
		<? echo $event1; ?>
<br>
		<? echo $event3; ?>
</td><td>
		<? echo $event2; ?>
    <br>    
		<? echo $event4; ?>
	</td></tr></table>
		<? echo $event5; ?>
	<table class="notice">
	<tr>
	<td><img src="images/pin-4.png" border="0"></td>
	<td>
		<div align="center">
		<h1>Issues</h1>
		Outstanding issues reported with cycles...
        <br>For a full list and to report a problem, <a href="members_fleet.php">click here</a>	
		</div>
	</td>
	<td><img src="images/pin-4.png" border="0"></td>
	</tr></table><br>
		<div class="notice3"><img src="images/pin-2.png" border="0" align="right">
        <?
        $sql = "SELECT 
			fleet_service.AutoID,
			date_FORMAT(fleet_service.date, '%d/%m/%Y') as date,
			fleet_service.title,
			fleet.call_sign
			FROM fleet_service
			LEFT JOIN fleet ON fleet_service.id_fleet=fleet.AutoID
			WHERE fleet_service.Deleted = '0000-00-00'
			AND fleet_service.closed = '0000-00-00'
			AND fleet.Deleted = '0000-00-00'
			AND fleet.disposed='0000-00-00'
			AND fleet.idCounties=$My_County_id
			ORDER BY fleet_service.priority ASC, fleet_service.date DESC";
$result = mysql_query("$sql");
$num=mysql_numrows($result);
		if ($num==0) {
			echo "<i>There currently no known issues</i>";
		} else {
			while($row = mysql_fetch_assoc($result)){
				echo $row["date"]." - ".$row["call_sign"]." - ".$row["title"]."<br>";
			}
		}
		?>
		</div>
</div>
</td><td width="50%" valign="top">

<div align="center"><table class="notice" width="200">
<tr><td><img src="images/pin-1.png" border="0"></td>
<td>
<div align="center">
<h1>Notice board</h1>
</div>	
</td>
<td><img src="images/pin-1.png" border="0"></td>
</tr></table></div><br>

<?
$sql = "SELECT *, 
			date_FORMAT(date, '%d/%m/%Y') as date 
			FROM _notices 
			WHERE idCounties=$My_County_id
			AND Deleted='0000-00-00'
			AND enabled=1";
$result = mysql_query("$sql"); // Database Query result
$i=0;
	While($row = mysql_fetch_assoc($result)){
		$enabled=0;
		if ($row["expire"]<$SQLdate) {
			if ($row["expire"]=='0000-00-00') {
				$enabled=1;
			} else {
				$enabled=0;
			}
		} else {
			$enabled=1;
		}
		if ($enabled==1) {
			$i=$i+1;
			if ($i==1) {
				?>
				<div class="notice1">
				<img src="images/pin-4.png" border="0" align="right">
				<h2><? echo $row["title"]; ?></h2>
					<?
                	if ($row["date"]<>'0000-00-00') {
                  		echo "(".$row["date"].")<br>";
					}
					?>
				<? echo nl2br($row["message"]); ?>
				</div>
				<br>
                <?
			} else if ($i==2) {
					?>
				<div class="notice2">
				<img src="images/pin-1.png" border="0" align="right">
				<h2><? echo $row["title"]; ?></h2>
                	<?
                	if ($row["date"]<>'0000-00-00') {
                  		echo "(".$row["date"].")<br>";
					}
					?>
				<? echo nl2br($row["message"]); ?>
				</div>
				<br>
                <?
			} else if ($i==3) {
				?>
				<div class="notice3">
				<img src="images/pin-2.png" border="0" align="right">
				<h2><? echo $row["title"]; ?></h2>
                	<?
                	if ($row["date"]<>'0000-00-00') {
                  		echo "(".$row["date"].")<br>";
					}
					?>
				<? echo nl2br($row["message"]); ?>
				</div>
				<br>
                <?
				
				$i=0; // Reset $i //
			}
		}
	}
    ?>
</td>
</tr></table>