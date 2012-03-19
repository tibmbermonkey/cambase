<?php

function display_stock_levels() {
	echo "<table border='0' width='100%'>";
	echo "<tr><td>Chemical</td><td>Qty</td><td>Min Qty</td></tr>";
	$result = mysql_query("SELECT * FROM chem ORDER BY chem_name");
	while($query_data = mysql_fetch_row($result)) {
		$total = '0';
		$chemid = $query_data[0];
		$chem = $query_data[1];
		$minstock = $query_data[8];
		$result_total = mysql_query("SELECT * FROM batch WHERE chem_id LIKE '$chemid'");
		while($query_total = mysql_fetch_row($result_total)) {
		$batchqty = $query_total[2] - $query_total[3];
		$total = $total + $batchqty;
		}
	//now print chem name and total in stock + minstock
	echo "<tr><td>",$chem,"</td><td>",$total,"g</td><td>",$minstock,"</td></tr>";
	}
	echo"</table>";
}

function display_stock_levels_border() {
	echo "<table border='0' width='100%' class='chemqty'>";
	echo "<tr><td  class='chemqty'>Chemical</td><td  class='chemqty'>Qty</td><td  class='chemqty'>Min Qty</td></tr>";
	$result = mysql_query("SELECT * FROM chem ORDER BY chem_name");
	while($query_data = mysql_fetch_row($result)) {
		$total = '0';
		$chemid = $query_data[0];
		$chem = $query_data[1];
		$minstock = $query_data[8];
		$result_total = mysql_query("SELECT * FROM batch WHERE chem_id LIKE '$chemid'");
		while($query_total = mysql_fetch_row($result_total)) {
		$batchqty = $query_total[2] - $query_total[3];
		$total = $total + $batchqty;
		}
	//now print chem name and total in stock + minstock
	echo "<tr><td class='chemqty'>",$chem,"</td><td class='chemqty'>",$total,"g</td><td class='chemqty'>",$minstock,"</td></tr>";
	}
	echo"</table>";
}
