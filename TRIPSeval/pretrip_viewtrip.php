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
$username = $_SESSION['username'];
$viewtriptable="";
if (isset($_GET['viewtripid']))
{
$tripid = $_GET['viewtripid'];
$tripquery = mysql_query("SELECT * FROM `trips` WHERE `tripid`='$tripid'"); //query trips database with the tripid from the previous page
$tripnumcount = mysql_num_rows($tripquery);
$rowtripid = mysql_fetch_Array($tripquery);
		$organiser = $rowtripid['organiser'];
		$createdby = $rowtripid['createdby'];
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
		$lgsevm = $rowtripid['lgsevma'];
		$lhsevm = $rowtripid['lhsevma'];
		$ffdevm = $rowtripid['ffdevma'];

// school colour sorted out

		if ($lgs == 1 && $lgsevm == 1) 
			{$lgscol = "green";}
		else if ($lgs == 1)
			{$lgscol = "red";}
		else
			{$lgscol = "grey";};
		
		if ($lhs == 1 && $lhsevm == 1) 
			{$lhscol = "green";}
		else if ($lhs == 1)
			{$lhscol = "red";}
		else
			{$lhscol = "grey";};
		
		if ($ffd == 1 && $ffdevm == 1) 
			{$ffdcol = "green";}
		else if ($ffd == 1)
			{$ffdcol = "red";}
		else
			{$ffdcol = "grey";};
		


	// this displays the accurate school information below in a mini table inside the status column.
			$display = "<table><tr><td class='". $lgscol . "'>G</td></tr><tr><td class='" . $lhscol . "'>H</td></tr><Tr><td class='" . $ffdcol . "'>F</td></tr></td></table>";
//below does not require a while statement as it's one specific trip we're viewing.
	$viewtriptable="<table><tr class='trborder'><th>Trip ID</th><td>$tripid</td></tr><tr class='trborder'><th>Description</th><td>$description</td></tr><tr class='trborder'><th>Pre Trip Status</th><td>$display</td></tr><tr class='trborder'><th>Organiser</th><td>$organiser</td></tr><tr class='trborder'><th>Department</th><td>$dept</td></tr><tr class='trborder'><th>LGS Year Group/s</th><td>$lgsyg</td></tr><tr class='trborder'><th>LHS Year Group/s</th><td>$lhsyg</td></tr><tr class='trborder'><th>FFD Year Group/s</th><td>$ffdyg</td></tr><tr class='trborder'><th>LGS Proposed Numbers</th><td>$lgspn</td></tr><tr class='trborder'><th>LHS Proposed Numbers</th><td>$lhspn</td></tr><tr class='trborder'><th>FFD Proposed Numbers</th><td>$ffdpn</td></tr><tr class='trborder'><th>Departure Date & Time</th><td>$dd</td></tr><tr class='trborder'><th>Return Date & Time</th><td>$rd</td></tr><tr class='trborder'><th>Proposed Location</th><td>$pl</td></tr><tr class='trborder'><th>Curriculum Link & Value</th><td>$cl</td></tr><tr class='trborder'><th>Main Method of Transportation</th><td>$pt</td></tr><tr class='trborder'><th>Payment Method</th><td>$pm</td></tr><tr><th>Name of Coach Company</th><td>$cc</td></tr><tr><th>Travel Company</th><td>$tu</td></tr><tr class='trborder'><th>Travel Company Name</th><td>$tn</td></tr><tr class='trborder'></tr><tr class='trborder'><th>Cost to Pupil of Trip</th><td>$cp</td></tr><tr class='trborder'><th>First Aiders Accompanying</th><td>$fa</td></tr><tr class='trborder'><th>Staff Accompanying</th><td>$sa</td></tr></table>";
}
else
{
$viewtriptable='<meta http-equiv="refresh" content="3;url=pretrip_view.php"><h2>There is no data for that trip...</h2>';
};
$returnlink ="<a href='pretrip_awaitingapproval.php'>Return to Pre Trips Awaiting Approval</a>";

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
		<div id="header"><h1>View Pre Trip</h1></div>
		<div id="sidebar-a">
			<div class="padding">
			<h2>Help</h2>
			<p>This is a Pre-Trip, here you will enter a small amount of information related to the Trip you intend to go on, this will enable the SLT to make a quick decision as to whether this Trip should be taken any further or not. Once accepted, your Pre-Trip becomes a Trip. If denied, you can try again unless specified otherwise.  </p>
			</div>
		</div>
		<div id="content">
			<div class="padding">
		<p><?php echo $viewtriptable ?></p>
		<p><?php echo $returnlink ?></p>
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




