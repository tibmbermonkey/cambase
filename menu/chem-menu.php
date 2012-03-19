<TABLE cellpadding="0" cellspacing="0" border="0" class="menu-bar">
<tr>
<td align="center">
<a href="chem.php" class="menu">Chem Home</a>
</td>

<td align="center">
<a href="view-all-chem.php" class="menu">View All</a>
</td>

<td align="center">
<a href="stock-level.php" class="menu">Stock Level</a>
</td>
<? if ($_SESSION['SESS_USR_LEVEL'] >= 5) { ?>	
<td align="center"><a href="add-chem.php" class="menu">Add Chem</a></td>
<td align="center"><a href="view-all-content.php" class="menu">Contents </a></td>
<? } ?>
</tr>
</table>

