<TABLE cellpadding="0" cellspacing="0" border="0" class="menu-bar">
<tr>
<td align="center">
<a href="new-reaction.php" class="menu">New Reaction</a>
</td>

<td align="center">
<a href="view-reactions.php?userid=<? echo $_SESSION['SESS_MEMBER_ID']; ?>" class="menu">View Your Reactions</a>
</td>


<? if ($_SESSION['SESS_USR_LEVEL'] >= 5) { ?>	
<td align="center"><a href="view-reactions.php?userid=all" class="menu">View All Reactions</a></td>

<? } ?>
</tr>
</table>


