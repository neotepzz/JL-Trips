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
    <style type="text/css" media="all">@import "css/master.css";</style>
	<?php 
	session_start();
if (isset($_GET['deletetripid'])) {
	$gettripid = ($_GET['deletetripid']);
} else {
	$gettripid = "0";	
}
if ($gettripid > 0){
		$sqltripid = mysql_query("SELECT * FROM `trips` WHERE `tripid`='$gettripid'");
		$rowtripid = mysql_fetch_array($sqltripid);
		$organiser = $rowtripid['organiser'];
		$description = $rowtripid['description'];
		$dept = $rowtripid['Department'];
		$lgsyg = $rowtripid['LGSYearGroups'];
		$lhsyg = $rowtripid['LHSYearGroups'];
		$ffdyg = $rowtripid['FFDYearGroups'];
		$lgspn = $rowtripid['LGSProposedNumbers'];
		$lhspn = $rowtripid['LHSProposedNumbers'];
		$ffdpn = $rowtripid['FFDProposedNumbers'];
		$dd = $rowtripid['deptdate'];
		$rd = $rowtripid['retdate'];
		$pl = $rowtripid['ProposedLocation'];
		$cl = $rowtripid['CurriculumValue'];
		$pt = $rowtripid['ProposedTransport'];
		$pm = $rowtripid['PaymentMethod'];
		$cc	= $rowtripid['CoachCompany'];
		$tu = $rowtripid['TravelCompanyUse'];
		$tn = $rowtripid['TravelCompName'];
		$cp = $rowtripid['PupilCost'];
		$fa = $rowtripid['FirstAiders'];
		$sa = $rowtripid['StaffAcc'];
		$lgs = $rowtripid['LGS'];
		$lhs = $rowtripid['LHS'];
		$ffd = $rowtripid['FFD'];
		$lgsdep = $rowtripid['lgsdepa'];
		$lhsdep = $rowtripid['lhsdepa'];
		$ffdep = $rowtripid['ffddepa'];

} 
else 	
{
	$organiser = "0";
	$descrpition = "0";
};
//
// ****** below is the code to display the code for the schools associated to this trip as this is no longer editable in Trip Section **********
//

		if ($lgs == 1 && $lgsdep == 1) 
			{$lgscol = "green";}
		else if ($lgs == 1)
			{$lgscol = "red";}
		else
			{$lgscol = "grey";};
		
		if ($lhs == 1 && $lhsdep == 1) 
			{$lhscol = "green";}
		else if ($lhs == 1)
			{$lhscol = "red";}
		else
			{$lhscol = "grey";};
		
		if ($ffd == 1 && $ffdep == 1) 
			{$ffdcol = "green";}
		else if ($ffd == 1)
			{$ffdcol = "red";}
		else
			{$ffdcol = "grey";};

$display = "<table class='edittrip'><tr><td class='edittrip ". $lgscol . "'>G</td><td class='edittrip " . $lhscol . "'>H</td><td class='edittrip " . $ffdcol . "'>F</td></tr></td></table>";
//
//Now create the variable that will display the data.
		$delete = "<tr><td>$description</td><td>$display</td><td>$createddate</td><td><form action='pretrip_confirmdelete.php?deletetripid=$tripid' method='post'><input type='text' id='confirmdelete' name='confirmdelete'></td><td><input type='submit' id='confirmdeletesubmit' name='confirmdeletesubmit' value='Delete'></confirm></td></tr>";
}
 else {
		$delete = '<h2>Cannot find a Trip to delete.</h2>';
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
		<div id="header"><h1>Delete Trip</h1></div>
		<div id="sidebar-a">
			<div class="padding">
			<h2>Help</h2>
			<p>Please enter 'Confirm' into the text box, it must be exactly as shown here, capital C and lower case onfirm. If it doesn't match this word exactly, you will not be able to delete the pre-trip.</p>
			<p>If you have accidentally deleted a pre-trip, don't worry we can restore all deleted items please just let network services know the details.</p>
			</div>
		</div>
		<div id="content">
			<div class="padding">
			<table><tr><th>Trip Description</th><th>Trip Status</th><th>Created Date</th><th colspan="2">Delete Trip</th></tr>
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
