<?php include("header_template.php"); ?>
<?php
		
if (isset($_GET['deliduser']))
{
	$delid = $_GET['deliduser'];
	$viewid = 1;
}
else
{
	$delid = 0;
	$viewid = 0;
};
//mysql query to open	
$delquery = mysql_query("SELECT * FROM teachers WHERE id ='$delid'");
$rowdel = mysql_fetch_array($delquery);
$delun = $rowdel['username'];
// if statement for the redirects/display
$createuserlink = '';
$refreshlink = '';
if ($viewid > 0)
{
$createuserlink .= "<h2> Are you sure you want to delete $delun ? </h2>";
$refreshlink .= "<a href='admin_delete_script.php?deluserid=$delid'>YES</a><br><br><a href='admin_edit_user.php'>NO</a>";
}
else
{
$createuserlink .= "<h2> Redirecting you back to the edit user page... </h2>";
$refreshlink .= "<meta http-equiv='refresh' content='5;url=admin_edit_user.php'>";
};
?>
<body>
<tr>
<td>
<?php echo $createuserlink; ?>
<?php echo $refreshlink; ?>
</tr>
</td>
</body>
<?php include("footer_template.php"); ?>
</html> 
