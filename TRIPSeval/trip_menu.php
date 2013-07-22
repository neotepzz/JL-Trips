<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php include ("not_logged_in_redirect.php"); ?>
<?php
//Connect to the database through our include 
include "connect_mysql_database.php";
//list session id's incase we need them
$userid = $_SESSION['id'];
$username = $_SESSION['username'];
//now going to do a security check so that if someone is Deputy or Head or above they can accept the trip. 
$evmquery = mysql_query("SELECT * FROM `teachers` WHERE `username`='$username' AND (`EVM`='1' OR `HEAD`='1')");
$evmquery2 = mysql_num_rows($evmquery); //checking the number of rows to perform an if statement
if ($evmquery2 > 0)
{
	$awaitingapprovallink = '<p><a href="trip_awaitingapproval.php">Trips Awaiting Acceptance</a></p>';
}
else
{
 	$awaitingapprovallink ='';
};

//now to check if the person is a head and can see the link.
$evmquery3 = mysql_query("SELECT * FROM `teachers` WHERE `username`='$username' AND `HEAD`='1'");
$evmquery4 = mysql_num_rows($evmquery3); //checking the number of rows to perform an if statement
if ($evmquery4 > 0) {
	$finalapprovallink = '<p><a href="trip_awaitingapprovalfinal.php">Trips Awaiting Final Acceptance</a></p>';
} else {
	$finalapprovallink = '';
};
// link that anyone can see for fully accepted Trips.
$fullyapprovedlink = '<p><a href="trip_fullyapproved.php">View My Approved Trips</a></p>';
// link that only EVM + DEPUTY + HEAD can view to see the trips for the specific school / 
$qa = mysql_query("SELECT * FROM `teachers` WHERE `username`='$username' AND (`EVM`='1' OR `HEAD`='1' OR `DEPUTY`='1')");
$qb = mysql_num_rows($qa); //checking the number of rows to perform an if statement
if ($qb > 0)
{
	$fullyapprovedschoollink = "<p><a href='trip_fullyapprovedschool.php'>View All <?php echo $school; ?> Approved Trips</a></p>";
}
else
{
 	$fullyapprovedschoollink ='';
};
?>
<?php 
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
				<?php echo $toplinks; ?>
			</span>
		</div>
		<div id="header"><h1>Trips Menu</h1></div>
		<div id="sidebar-a">
			<div class="padding">
			<h2>Help</h2>
			<p>This is the main hub for Trips, from here, you can create, view, edit, delete and submit your Trip. To Edit, Delete or Submit a Trip, please follow the 'View Trips' link. </p>
			</div>
		</div>
		<div id="content">
			<div class="padding">
			<h2>Trips</h2>
			<p><a href="trip_view.php">View My Trips &amp; Options</a></p>
			<?php echo $awaitingapprovallink; ?>
			<?php echo $finalapprovallink; ?>
			<?php echo $fullyapprovedlink; ?>
			<?php echo $fullyapprovedschoollink; ?>
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

</td>
</tr>
</body>
</html>


