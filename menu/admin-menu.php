<TABLE cellpadding="0" cellspacing="0" border="0" class="menu-bar">
<tr>

<? if ($_SESSION['SESS_USR_LEVEL'] >= 5) { ?>	
<td align="center"><a href="register-form.php" class="menu">New User</a></td>

<? } ?>

<? if ($_SESSION['SESS_USR_LEVEL'] >= 9) { ?>	
<td align="center"><a href="reset-form.php" class="menu">Reset Users Password</a></td>

<? } ?>
</tr>
</table>

