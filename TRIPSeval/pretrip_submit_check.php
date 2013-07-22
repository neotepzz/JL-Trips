<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php include ("not_logged_in_redirect.php"); ?>
<?php include ("connect_mysql_database.php"); ?>
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
<?php
//This is the submit update check to make sure required fields are filled in.
//Below pulls data on the pretrip.
session_start();
$subid = ($_GET['submittripid']);
		$q1 = mysql_query("SELECT * FROM `trips` WHERE `tripid`='$subid'") or die (mysql_error());
		while ($row = mysql_fetch_array($q1)) 
			{
			$sqltripid = $row['tripid'];
			$description = $row['description'];
			$organiser = $row['organiser'];
			$dept = $row['Department'];
			$lgsyg = $row['LGSYearGroups'];
			$lhsyg = $row['LHSYearGroups'];
			$ffdyg = $row['FFDYearGroups'];
			$lgspn = $row['LGSProposedNumbers'];
			$lhspn = $row['LHSProposedNumbers'];
			$ffdpn = $row['FFDProposedNumbers'];
			$dd = $row['deptdate'];
			$rd = $row['retdate'];
			$pl = $row['ProposedLocation'];
			$cl = $row['CurriculumValue'];
			$pt = $row['ProposedTransport'];
			$pm = $row['PaymentMethod'];
			$cc	= $row['CoachCompany'];
			$tu = $row['TravelCompanyUse'];
			$tn = $row['TravelCompName'];
			$cp = $row['PupilCost'];
			$sa = $row['StaffAcc'];
			$fa = $row['FirstAiders'];
			}
if (empty($dept) || empty($fa) || empty($dd) || empty($rd) || empty($pl) || empty($cl) || empty($pt) || empty($pm) || empty($cp) || empty($sa))
{
$redirectlink = '<meta http-equiv="refresh" content="2;url=pretrip_view.php">';
$submitmessage = '<h2>Pre Trip cannot be submitted - please make sure all fields are filled in.</h2>';
}
else
{
$redirectlink = '<meta http-equiv="refresh" content="2;url=pretrip_submit.php?submittripid=' . $subid . '">';
$submitmessage = '<h2>Pre Trip can be submitted... Loading...</h2>';
};
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
	<?php echo $redirectlink; ?>
    <style type="text/css" media="all">@import "css/master.css";</style>
	
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
		<div id="header"><h1>Pre Trip Submitting</h1></div>
		<div id="sidebar-a">
			<div class="padding">
			<h2>Help</h2>
			<p>Loading, please wait...</p>
			</div>
		</div>
		<div id="content">
			<div class="padding">
			<?php echo $submitmessage; ?>
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
