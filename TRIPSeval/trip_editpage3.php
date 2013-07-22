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
		<div id="header">
			<h1>Edit Trip - Section 3</h1>
		</div>
		<div id="sidebar-a">
			<div class="padding">
			<h2>Help</h2>
			<p>This is a Pre-Trip, here you will enter a small amount of information related to the Trip you intend to go on, this will enable the SLT to make a quick decision as to whether this Trip should be taken any further or not. Once accepted, your Pre-Trip becomes a Trip. If denied, you can try again unless specified otherwise.  </p>
	<h2>Sections</h2>
<h3>Using the 'Skip To' links below will not save any of your entered data.</h3> <p> You must use the Save &amp; Continue button for this at the bottom of the page.</p>				<?php
					if (isset($_GET['edittripid'])) {
						$gettripid = ($_GET['edittripid']);
					} else {
						$gettripid = "0";	
					}
				 $skiplink1='Skip To: <a href="trip_editpage1.php?edittripid=' . $gettripid . '">Section 1</a>';
				 $skiplink2='Skip To: <a href="trip_editpage2.php?edittripid=' . $gettripid . '">Section 2</a>';
				 $skiplink3='Skip To: <a href="trip_editpage3.php?edittripid=' . $gettripid . '">Section 3</a>';
				 $skiplink4='Skip To: <a href="trip_editpage4.php?edittripid=' . $gettripid . '">Section 4</a>';
				 ?>
			<ul class="triplinksul">
				<li><?php echo $skiplink1; ?></li>
				<li><?php echo $skiplink2; ?></li>
				<li><?php echo $skiplink3; ?></li>
				<li><?php echo $skiplink4; ?></li>
			</uL>
			</div>
		</div>
		<div id="content">
			<div class="padding">
<?php 
//start session first, no need to check if the user is logged in as the redirect has taken care of that.
// first need to assign the passed variable - id, into a local variable from a session.
$userid = $_SESSION['id'];
$username = $_SESSION['username'];
$createdby = $_SESSION['username'];
if (isset($_GET['edittripid'])) {
	$gettripid = ($_GET['edittripid']);
} else {
	$gettripid = "0";	
}
if ($gettripid > 0){ //grab all the information needed from the trips table to populate any necessary fields
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
else 	{
	$organiser = "0";
	$descrpition = "0";
};
?>
<body>
<tr>
<td>
<form action="trip_update.php?edittripidpage3=<?php echo $gettripid; ?>" method="post">
<table>
<h2>MORE RISK INPUT</h2>
<tr>
<td colspan="2">
<input type="submit" Value="Save &amp; Continue">
</td>
</tr>
</table>
</form>
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



