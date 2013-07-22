<?php include ("not_logged_in_redirect.php"); ?>
<?php include("header_template.php"); ?>
<?php 
session_start(); //start session first, no need to check if the user is logged in as the redirect has taken care of that.
// first need to assign the passed variable - id, into a local variable from a session.
if (isset($_GET['iduser'])) {
	$userid = ($_GET['iduser']);
} else {
	$userid = "0";	
}
if ($userid > 0){
		$sqluserid = mysql_query("SELECT * FROM teachers WHERE id ='$userid'");
		$rowuserid = mysql_fetch_array($sqluserid);
		$username2 = $rowuserid['username'];
		$password2 = $rowuserid['password'];
		$lastlogin2 = $rowuserid['lastlogin'];
		$email2 = $rowuserid['Email'];
		$EVM2 = $rowuserid['EVM'];
		$DEPUTY2 = $rowuserid['Deputy'];
		$HEAD2 = $rowuserid['Head'];
		$ADMIN2 = $rowuserid['admin'];
		$LGS2 = $rowuserid['LGS'];
		$LHS2 = $rowuserid['LHS'];
		$FFD2 = $rowuserid['FFD'];
		$LESM2 = $rowuserid['LESM'];
} 
else 	{
	$username2 = "0";
	$password2 = "0";
	$email2 = "0";
	$EVM2 = "0";
	$DEPUTY2 = "0";
	$HEAD2 = "0";
	$ADMIN2 = "0";
	$LGS2 = "0";
	$LHS2 = "0";
	$FFD2 = "0";
	$LESM2 = "0";
}
//if statements to say whether it's checked or not! 
// EVM Check
if ($EVM2 == 1)
{
	$evmchk = 'checked';
}
else
{
	$evmchk = '';
};
// Deputy Head check
if ($DEPUTY2 == 1)
{
	$deputychk = 'checked';
}
else
{
	$deputychk = '';
};
// Head check
if ($HEAD2 == 1)
{
	$headchk = 'checked';
}
else
{
	$headchk = '';
};
// admin check
if ($ADMIN2 == 1)
{
	$adminchk = 'checked';
}
else
{
	$adminchk = '';
};
// ffd check
if ($FFD2 == 1)
{
	$ffdchk = 'checked';
}
else
{
	$ffdchk = '';
};
// lgs check
if ($LGS2 == 1)
{
	$lgschk = 'checked';
}
else
{
	$lgschk = '';
};
//lhs check
if ($LHS2 == 1)
{
	$lhschk = 'checked';
}
else
{
	$lhschk = '';
};
//lesm check
if ($LESM2 == 1)
{
	$lesmchk = 'checked';
}
else
{
	$lesmchk = '';
};
?>

<body>
<tr>
<td>
<h2>Edit User</h2>
<form action="admin_edit_update.php?idofuser=<?php echo $userid; ?>" method="post">
<table width="60%" border="1" bordercolor="#666666" align="center">
<tr>
<td align="center">
Username
</td>
<td align="center">
<?php echo $username2; ?>
</td>
</tr>
<tr>
<td align="center">
Password
</td>
<td align="center">
<input type="text" name="password2" value="<?php echo $password2; ?>">
</td>
</tr>
<tr>
<td align="center">
Email
</td>
<td align="center">
<input type="text" name="email2" value="<?php echo $email2; ?>">
</td>
</tr>
<tr>
<td align="center">
EVM
</td>
<td align="center">
<input type="hidden" name="chkevm2" value="0">
<input type="checkbox" name="chkevm2" value="1" <?php echo $evmchk; ?>>
</td>
</tr>
<tr>
<td align="center">
Deputy
</td>
<td align="center">
<input type="hidden" name="chkdeputy2" value="0">
<input type="checkbox" name="chkdeputy2" value="1" <?php echo $deputychk; ?>>
</td>
</tr>
<tr>
<td align="center">
Head
</td>
<td align="center">
<input type="hidden" name="chkhead2" value="0">
<input type="checkbox" name="chkhead2" value="1" <?php echo $headchk; ?>>
</td>
</tr>
<tr>
<td align="center">
Admin
</td>
<td align="center">
<input type="hidden" name="chkadmin2" value="0">
<input type="checkbox" name="chkadmin2" value="1" <?php echo $adminchk; ?>>
</td>
</tr>
<tr>
<td align="center">
FFD
</td>
<td align="center">
<input type="hidden" name="chkffd2" value="0">
<input type="checkbox" name="chkffd2" value="1" <?php echo $ffdchk; ?>>
</td>
</tr>
<tr>
<td align="center">
LGS
</td>
<td align="center">
<input type="hidden" name="chklgs2" value="0">
<input type="checkbox" name="chklgs2" value="1" <?php echo $lgschk; ?>>
</td>
</tr>
<tr>
<td align="center">
LHS
</td>
<td align="center">
<input type="hidden" name="chklhs2" value="0">
<input type="checkbox" name="chklhs2" value="1" <?php echo $lhschk; ?>>
</td>
</tr>
<tr>
<td align="center">
LESM
</td>
<td align="center">
<input type="hidden" name="chklesm2" value="0">
<input type="checkbox" name="chklesm2" value="1" <?php echo $lesmchk; ?>>
</td>
</tr>
<tr>
<td align="center" colspan="2">
<input type="submit" Value="Save & Exit">
</td>
</tr>
</table>
</form>
</body>
<?php include("footer_template.php"); ?>