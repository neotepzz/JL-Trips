<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php include ("not_logged_in_redirect.php"); ?>
<?php include("pretrip_view_user_table.php"); ?>

<?php 
require("connect_mysql_database.php");
$username = $_SESSION['username'];
//this if & while statement below allows the program to extract data about the trip
$query2 = mysql_query("SELECT * FROM `trips` WHERE `pretrip`='1' AND `delete`='0' AND `pretripdenied`='1' AND `createdby`='$username'");  //query the entire trips table for all data from all rows + columns
$query3 = mysql_num_rows($query2); // count the rows from query 2.
$insertlink = "";
if ($query3 > 0) {
	while ($row = mysql_fetch_array($query2)){ // assign the query to the row, fetching the data into an array
		$tripid = $row['tripid']; //assign the tripid column to the $tripid variable, same as the below
		$createdby = $row['createdby'];
		$description = $row['description'];
		$organiser = $row['organiser'];
		$pretripaccepted = $row['pretripaccepted'];
		$pretripdenied = $row['pretripdenied'];
		$pretripsubmitted = $row['pretripsubmitted'];
		$lgs = $row['LGS'];
		$lhs = $row['LHS'];
		$ffd = $row['FFD'];
		$lgsevm = $row['lgsevma'];
		$lhsevm = $row['lhsevma'];
		$ffdevm = $row['ffdevma'];
	}
	if ($pretripdenied == 1)
		{$insertlink = '<th>Denied Reason</th>';}
}

session_start(); // Must start session first thing
/* 
Created By Adam Khoury @ www.flashbuilding.com 
-----------------------June 20, 2008----------------------- 
*/
// See if they are a logged in member by checking Session data
$toplinks = "";
if (isset($_SESSION['id'])) {
	// Put stored session variables into local php variable
    $userid = $_SESSION['id'];
    $username = $_SESSION['username'];
	$toplinks = '<div class="topright">You\'re logged in as:&nbsp;'. $username .'</div><div class="aright"><a href="index.php" class="nav">Main Menu</a></div>';
} else {
	$toplinks = '<a href="login_form.php" class="nav">You\'re not logged in, click here to log in.</a>';
}

// $toplinks can now be used in any file that login_header is included with(this is included with everypage)
?>
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
    <title>Loughborough Endowed Schools - TRIPS</title>
    <meta http-equiv="Content-Language" content="en-us" /> 
    <meta http-equiv="imagetoolbar" content="no" />
    <meta name="MSSmartTagsPreventParsing" content="true" />
    <meta name="description" content="Description" />
    <meta name="keywords" content="Keywords" />
    <meta name="author" content="James Leeson Designs" />
    <style type="text/css" media="all">@import "css/master.css";</style>  <style type="text/css" media="all">@import "css/master.css";</style>
</head>
<body>
	<div id="page-container">
		<div id="Main-Nav">
			<span class="logo">
				<h1>LES Trips Software</h1>
			</span>
			<span class="link">
				<font class="toplinkslogin"><?php echo '' . $toplinks . ''; ?></font>
			</span>
		</div>
		<div id="header"><h1><?php echo $username?>'s Pre-Trips</h1></div>
		<div id="sidebar-a">
			<div class="padding">
			<h2>Help</h2>
			<p>Here you can Edit, Delete or Submit your Pre-Trip.</p>
			<p>If you've already submitted your Pre-Trip you will be unable to Edit, Delete or Submit the Pre-Trip. </p>
			</div>
		</div>
		<div id="content">
			<div class="padding">
				<table><tr class="trborder"><th>Trip Description</th><?php if ($pretripdenied == 1) {echo '' .  $insertlink . '';} else { /* do nothing */ };?><th>Pre Trip Status</th><th>Created Date</th><th>Edit Pre Trip</th><th>Delete Pre Trip<th>Submit Pre Trip</th></tr>
				<?php echo $trip_list; ?>
			</table>	
			</div>
		</div>
		<div id="footer">
<?php 
//REMOVED SESSION START FROM HERE ******
$bottomlinks = "";
if (isset($_SESSION['id'])) {
	// Put stored session variables into local php variable
    $userid = $_SESSION['id'];
    $username = $_SESSION['username'];
	$bottomlinks = '<a href="logout.php">Logout</a>';
} else {
	exit();
}
// $bottomlinks is now usable to display the Logout link in the footer when the user is logged in.
?>
<span class="footername">
James Leeson Designs
</span>
<span class="footerlogout"> <?php echo '' . $bottomlinks . ''; ?></span>
		</div>
	</div>

</body>
</html>
