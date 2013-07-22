<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
<?php include ("not_logged_in_redirect.php"); ?>
<?php include ("connect_mysql_database.php"); ?>
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
	<?php 
	session_start();
	if (isset($_GET['deletetripid'])) {
	$tripid = $_GET['deletetripid'];
	} else {
	$tripid = 0;
	};
		$username = $_SESSION['username'];
		$delete=""; //need to create the delete variable first and tell it it's empty to initialise it.
		$deletequery = mysql_query("SELECT * FROM `trips` WHERE `tripid`='$tripid'");  //query the entire trips table for all data from all rows + columns NEEDS CHANGING TO SPECIFIC
		$row = mysql_fetch_array($deletequery);
		$countdeletequery = mysql_num_rows($deletequery); // count the rows from row.
if ($countdeletequery > 0) {
		$createdby = $row['createdby'];
		$description = $row['description'];
		$organiser = $row['organiser'];
		$pretripaccepted = $row['pretripaccepted'];
		$pretripdenied = $row['pretripdenied'];
		$pretripsubmitted = $row['pretripsubmitted'];
		$pretrip_status= "";
			if ($pretripaccepted + $pretripdenied + $pretripsubmitted === 0) {
					$pretrip_status .="Editing";
			} elseif ($pretripaccepted > $pretripdenied + $pretripsubmitted) {
					$pretrip_status .="Accepted Pre Trip";
			} elseif ($pretripdenied > $pretripaccepted + $pretripsubmitted) {
					$pretrip_status .="Denied Pre Trip";
			} elseif ($pretripsubmitted > $pretripaccepted + $pretripdenied) {
					$pretrip_status .="Awaiting Approval";
			} else  $pretrip_status ="Contact NSC"; {
			};
		$createddate = $row['createddate'];
//Now create the variable that will display the data.
		$delete = "<tr><td>$description</td><td>$pretrip_status</td><td>$createddate</td><td><form action='pretrip_confirmdelete.php?deletetripid=$tripid' method='post'><input type='text' id='confirmdelete' name='confirmdelete'></td><td><input type='submit' id='confirmdeletesubmit' name='confirmdeletesubmit' value='Delete'></confirm></td></tr>";
}
 else {
		$delete = '<h2>Cannot find a Pre Trip to delete.</h2>';
};
mysql_query("INSERT INTO `log` (`user`, `logtime`, `logdesc`, `logtripid`) VALUES ('$username', NOW(), 'Submitted Trip', '$tripid')");
?>
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
		<div id="header"><h1>Delete Pre-Trip</h1></div>
		<div id="sidebar-a">
			<div class="padding">
			<h2>Help</h2>
			<p>Please enter 'Confirm' into the text box, it must be exactly as shown here, capital C and lower case onfirm. If it doesn't match this word exactly, you will not be able to delete the pre-trip.</p>
			<p>If you have accidentally deleted a pre-trip, don't worry we can restore all deleted items please just let network services know the details.</p>
			</div>
		</div>
		<div id="content">
			<div class="padding">
			<table><tr><th>Trip Description</th><th>Pre Trip Status</th><th>Created Date</th><th colspan="2">Delete Pre Trip</th></tr>
<?php echo $delete; ?></table>
<?php
include ("common.php");
global $adminquery2;
if ($adminquery2 > 0) {
		$adminpagelink = '<h2>Trips Administration</h2><p><a href="administratormain.php" class="bodylink">Administrator Page for Trips Site</p></a>';
		} else {
		$adminpagelink = '';
		};
echo $adminpagelink; 
 ?>
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
