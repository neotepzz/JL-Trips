<?php 
include("header_template.php"); 
include("not_logged_in_redirect.php");
//use the value given back to this page from admin_create_user_script if there's a problem and display the problem below, else the statement acts as if no data has been passed to it.
//updateadmin = '0' means that no options were selected when submit was pressed.
//updateadmin = '1' means username missing or wrong and password missing and any of the boxes could have been ticked.
//updateadmin = '2' means username is correct and unique, no password has been entered, any of the boxes might have been ticked.
//updateadmin = '3' means username is correct and unique, a password has been entered, however no checkboxes selected.
//updateadmin = '4' means username is correct and unique, a password has been entered, however too many selected.
//updateadmin = '5' means username is correct and unique, a password has been enterd, however rights has had nothing selected and schools has had too many selected.
//updateadmin = '6' means username is correct and unique, a password has been entered, however school has nothing selected and rights has too many selected. 
?>
<?php
$update = '';
if (isset($_GET['updateadmin']))
{
	$updateadmin = ($_GET['updateadmin']);
		if ($updateadmin == 1) 
		{
		$update .= "Username Missing Or Not Unique + Password Incorrect";
		echo $page = 1;
		}
		else if ($updateadmin == 2)
		{
		$update .= "No Password Entered";
		echo $page = 1;
		}
		else if ($updateadmin == 3)
		{
		$update .= "No Checkboxes Selected";
		echo $page = 1;
		}
		else if ($updateadmin == 4)
		{
		$update .= "Too Many Checkboxes Selected - Only 1 each from schools and from rights";
		echo $page = 1;
		}
		else if ($updateadmin == 5)
		{
		$update .= "No checkboxes selected from Rights";
		echo $page = 1;
		}
		else if ($updateadmin == 6)
		{
		$update .= "No checkboxes selected from Schools";
		echo $page = 1;
		}
		else if ($updateadmin == 8)
		{
		$update .= "Username is not unique.";
		echo $page = 1;
		}		
		else
		{
		echo $page = 0;
		};
}
else
{
$page = 0;
};
$pageview = "<body>
<tr>
<td>
<h2>This is the Create a New User Account page</h2>
<h3><font color ='red'>$update </h3></font>
<form action='admin_create_user_script.php' method='post'>
<table width='60%' border='1' bordercolor='#666666' align='center'>
<tr>
<td align='center'>
Username
</td>
<td align='center'>
<input type='text' name='username1' value=''>
</td>
</tr>
<tr>
<td align='center'>
Password
</td>
<td align='center'>
<input type='text' name='password1' value=''>
</td>
</tr>
<tr>
<td align='center'>
Email
</td>
<td align='center'>
<input type='text' name='email1' value=''>
</td>
</tr>
<tr>
<td align='center'>
EVM
</td>
<td align='center'>
<input type='checkbox' name='chkEVM' value='1'>
</td>
</tr>
<tr>
<td align='center'>
Deputy
</td>
<td align='center'>
<input type='checkbox' name='chkDEPUTY' value='1'>
</td>
</tr>
<tr>
<td align='center'>
Head
</td>
<td align='center'>
<input type='checkbox' name='chkHEAD' value='1'>
</td>
</tr>
<tr>
<td align='center'>
Admin
</td>
<td align='center'>
<input type='checkbox' name='chkADMIN' value='1'>
</td>
</tr>
<tr>
<td align='center'>
LGS
</td>
<td align='center'>
<input type='checkbox' name='chkLGS' value='1'>
</td>
</tr>
<tr>
<td align='center'>
LHS
</td>
<td align='center'>
<input type='checkbox' name='chkLHS' value='1'>
</td>
</tr>
<tr>
<td align='center'>
FFD
</td>
<td align='center'>
<input type='checkbox' name='chkFFD' value='1'>
</td>
</tr>
<tr>
<td align='center'>
LESM
</td>
<td align='center'>
<input type='checkbox' name='chkLESM' value='1'>
</td>
</tr>
<tr>
<td align='center'>
<input type='submit' Value='Create'>
</td>
</tr>
</form>
</table>
<br>
<a href='administratormain.php'>Administrator Main Page</a>
</body>
</html>";
$pageviewwithoutupdate = "<body>
<tr>
<td>
<h2>This is the Create a New User Account page</h2>
<form action='admin_create_user_script.php' method='post'>
<table width='60%' border='1' bordercolor='#666666' align='center'>
<tr>
<td align='center'>
Username
</td>
<td align='center'>
<input type='text' name='username1' value=''>
</td>
</tr>
<tr>
<td align='center'>
Password
</td>
<td align='center'>
<input type='text' name='password1' value=''>
</td>
</tr>
<tr>
<td align='center'>
Email
</td>
<td align='center'>
<input type='text' name='email1' value=''>
</td>
</tr>
<tr>
<td align='center'>
EVM
</td>
<td align='center'>
<input type='checkbox' name='chkEVM' value='1'>
</td>
</tr>
<tr>
<td align='center'>
Deputy
</td>
<td align='center'>
<input type='checkbox' name='chkDEPUTY' value='1'>
</td>
</tr>
<tr>
<td align='center'>
Head
</td>
<td align='center'>
<input type='checkbox' name='chkHEAD' value='1'>
</td>
</tr>
<tr>
<td align='center'>
Admin
</td>
<td align='center'>
<input type='checkbox' name='chkADMIN' value='1'>
</td>
</tr>
<tr>
<td align='center'>
LGS
</td>
<td align='center'>
<input type='checkbox' name='chkLGS' value='1'>
</td>
</tr>
<tr>
<td align='center'>
LHS
</td>
<td align='center'>
<input type='checkbox' name='chkLHS' value='1'>
</td>
</tr>
<tr>
<td align='center'>
FFD
</td>
<td align='center'>
<input type='checkbox' name='chkFFD' value='1'>
</td>
</tr>
<tr>
<td align='center'>
LESM
</td>
<td align='center'>
<input type='checkbox' name='chkLESM' value='1'>
</td>
</tr>
<tr>
<td align='center'>
<input type='submit' Value='Create'>
</td>
</tr>
</form>
</table>
<br>
<a href='administratormain.php'>Administrator Main Page</a>
</body>
</html>";
if ($page == 1)
{
	echo $pageview;
}
else
{
	echo $pageviewwithoutupdate;
};
?>
<?php include("footer_template.php"); ?>