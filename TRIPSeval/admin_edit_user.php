<?php require ("connect_mysql_database.php"); ?>
<?php include ("not_logged_in_redirect.php"); ?>
<?php include("header_template.php"); ?>
<?php 
		$username = $_SESSION['username'];
		$user_list=""; //need to create the user_list variable first and tell it it's empty to initialise it.
$userquery = mysql_query("SELECT * FROM `teachers` WHERE `delete`='0'");  //query the entire teachers table for all data from all rows + columns
$userquery2 = mysql_num_rows($userquery); // count the rows from userquery.
if ($userquery2 > 0) {
	while ($row = mysql_fetch_array($userquery)){ // assign the query to the row, fetching the data into an array
		$userid = $row['id']; //assign the id's from the teachers table to a variable as below
		$username = $row['username'];
		$password = $row['password'];
		$lastlogin = $row['lastlogin'];
		$email = $row['Email'];
		$EVM = $row['EVM'];
		$DEPUTY = $row['Deputy'];
		$HEAD = $row['Head'];
		$ADMIN = $row['admin'];
		$LGS = $row['LGS'];
		$LHS = $row['LHS'];
		$FFD = $row['FFD'];
		$LESM = $row['LESM'];
		//Now create the variable that will display the data.
		$user_list .= "<tr><td>$userid</td><td>$username</td><td>$password</td><td>$email</td><td>$lastlogin</td><td>$EVM</td><td>$DEPUTY</td><td>$HEAD</td><td>$ADMIN<td>$LGS</td><td>$LHS</td><td>$FFD</td><td>$LESM</td><td><a href='admin_edit.php?iduser=$userid'>EDIT</a></td><td><a href='admin_delete_user.php?deliduser=$userid'>DELETE</td></tr>";
}
} else {
		$user_list = '<h2>Cannot find any users in the database.</h2>';
}
// list of what to display!
$update = '';
if (isset($_GET['updateadmin']))
{
	$updateadmin = ($_GET['updateadmin']);
		if ($updateadmin == 1) 
		{
		$update .= "<h2><font color='red'>Username Missing Or Not Unique + Password Incorrect</h2></font>";
		}
		else if ($updateadmin == 2)
		{
		$update .= "<h2><font color='red'>No Password Entered</h2></font>";
		}
		else if ($updateadmin == 3)
		{
		$update .= "<h2><font color='red'>No Checkboxes Selected</h2></font>";
		}
		else if ($updateadmin == 4)
		{
		$update .= "<h2><font color='red'>Too Many Checkboxes Selected - Only 1 each from schools and from rights</h2></font>";
		}
		else if ($updateadmin == 5)
		{
		$update .= "<h2><font color='red'>No checkboxes selected from Rights</h2></font>";
		}
		else if ($updateadmin == 6)
		{
		$update .= "<h2><font color='red'>No checkboxes selected from Schools</h2></font>";
		}
		else if ($updateadmin == 7)
		{
		$update .= "<h2><font color='red'>User has been updated</h2></font>";
		}	
		else if ($updateadmin == 8)
		{
		$update .= "<h2><font color='red'>Username is not unique.</h2></font>";
		}		
		else
		{
		$update = "<h2><font color='red'>updateadmin value is not an expected value.</h2></font>";
		};
}
else
{
$update = '';
};
if (isset($_GET['delsuc']))
{
		$delsuc = $_GET['delsuc'];
			if ($delsuc > 0)
			{
			$update .= "<h2><font color='red'>Successfully deleted.</h2></font>";
			}
			else
			{
			$update .= "<h2><font color='red'>Not deleted.</h2></font>";
			};
}
else
{
$update .= "";
};
?>
<body>
<tr>
<td>
<h2>Administrator: View Users</h2>
<br />
<?php echo $update; ?>
<br />
<table align="center" border ="1" bordercolor="#0000FF" width="60%"><tr><td>User ID</td><td>Username</td><td>Password</td><td>Email</td><td>Last Login</td><td>EVM</td><td>DEPUTY</td><td>HEAD</td><td>ADMIN<td>LGS</td><td>LHS</td><td>FFD</td><td>LESM</td><td></td><td></td></tr>
<?php echo $user_list; ?>
</table>
<table align="center" border ="1" bordercolor="#0000FF" width="60%"><tr><td><b>HELP</b><br>'1' in the column means it's true - '0' in the column is false. If it's true, it holds that value, e.g. a 1 in the EVM column makes the user an EVM. </td></tr></table>
<a href='administratormain.php'>Administrator Main Page</a>
</body>
<?php include("footer_template.php"); ?>
</html>
