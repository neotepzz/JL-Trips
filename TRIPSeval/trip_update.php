<?php require ("connect_mysql_database.php"); ?>
<?php
session_start();
$username = $_SESSION['username'];
if (isset($_GET['edittripidpage1'])){
	$lgsyg = mysql_real_escape_string($_POST['LGSYearGroup']);
	$lhsyg = mysql_real_escape_string($_POST['LHSYearGroup']);
	$ffdyg = mysql_real_escape_string($_POST['FFDYearGroup']);
	$lgspn = mysql_real_escape_string($_POST['LGSProNumbers']);
	$lhspn = mysql_real_escape_string($_POST['LHSProNumbers']);
	$ffdpn = mysql_real_escape_string($_POST['FFDProNumbers']);
	$dd = mysql_real_escape_string($_POST['departuredate']);
	$rd = mysql_real_escape_string($_POST['returndate']);
	$pl = mysql_real_escape_string($_POST['ProLocation']);
	$cl = mysql_real_escape_string($_POST['CurriLink']);
	$pt = mysql_real_escape_string($_POST['MainTransport']);
	$pm = mysql_real_escape_string($_POST['Paymentmethod']);
	$cc	= mysql_real_escape_string($_POST['CoachCompany']);
	$tu = mysql_real_escape_string($_POST['TravelCompanyYN']);
	$tn = mysql_real_escape_string($_POST['TravelCompanyName']);
    $cp = mysql_real_escape_string($_POST['PupilCost']);
    $fa = mysql_real_escape_string($_POST['FirstAider']);
	$sa = mysql_real_escape_string($_POST['StaffAcc']);
	$edittripid = $_GET['edittripidpage1'];
	$msg = '<h2>Saving Your Trip Data and Redirecting you to the Next Section...</h2>';
	$redirect = '<meta http-equiv="refresh" content="3;URL=trip_editpage2.php?edittripid=' . $edittripid . '">';
	mysql_query("UPDATE trips SET LGSYearGroups='$lgsyg', LHSYearGroups='$lhsyg', FFDYearGroups='$ffdyg', FFDProposedNumbers='$ffdpn', LGSProposedNumbers='$lgspn', LHSProposedNumbers='$lhspn', deptdate='$dd', retdate='$rd', ProposedLocation='$pl', CurriculumValue='$cl', ProposedTransport='$pt', PaymentMethod='$pm', CoachCompany='$cc', TravelCompanyUse='$tu', TravelCompName='$tn', PupilCost='$cp', FirstAiders='$fa', StaffAcc='$sa', `LGS`='$lgs', `LHS`='$lhs', `FFD`='$ffd' WHERE tripid = '$sqltripid'") or die (mysql_error());
	mysql_query("INSERT INTO log (user, logtime, logdesc, logtripid) VALUES ('$username', NOW(), 'Edited Trip on Section 1 and Saved Changes', $edittripid)");
} 
//this else if is from the trip_editpage2 -> This is the risk scoring page and saves once the submit button is pressed
elseif (isset($_GET['edittripidpage2'])){
	$lgsyg = mysql_real_escape_string($_POST['LGSYearGroup']);
	$lhsyg = mysql_real_escape_string($_POST['LHSYearGroup']);
	$ffdyg = mysql_real_escape_string($_POST['FFDYearGroup']);
	$lgspn = mysql_real_escape_string($_POST['LGSProNumbers']);
	$lhspn = mysql_real_escape_string($_POST['LHSProNumbers']);
	$ffdpn = mysql_real_escape_string($_POST['FFDProNumbers']);
	$dd = mysql_real_escape_string($_POST['departuredate']);
	$rd = mysql_real_escape_string($_POST['returndate']);
	$pl = mysql_real_escape_string($_POST['ProLocation']);
	$cl = mysql_real_escape_string($_POST['CurriLink']);
	$pt = mysql_real_escape_string($_POST['MainTransport']);
	$pm = mysql_real_escape_string($_POST['Paymentmethod']);
	$cc	= mysql_real_escape_string($_POST['CoachCompany']);
	$tu = mysql_real_escape_string($_POST['TravelCompanyYN']);
	$tn = mysql_real_escape_string($_POST['TravelCompanyName']);
    $cp = mysql_real_escape_string($_POST['PupilCost']);
    $fa = mysql_real_escape_string($_POST['FirstAider']);
	$sa = mysql_real_escape_string($_POST['StaffAcc']);
	$edittripid = $_GET['edittripidpage2'];
	$msg = '<h2>Saving Your Trip Data and Redirecting you to the Next Section...</h2>';
	$redirect = '<meta http-equiv="refresh" content="3;URL=trip_editpage3.php?edittripid=' . $edittripid . '">';
	mysql_query("INSERT INTO log (user, logtime, logdesc, logtripid) VALUES ('$username', NOW(), 'Edited Trip on Section 2 and Saved Changes', $edittripid)");
} 
elseif (isset($_GET['edittripidpage3'])){
	$lgsyg = mysql_real_escape_string($_POST['LGSYearGroup']);
	$lhsyg = mysql_real_escape_string($_POST['LHSYearGroup']);
	$ffdyg = mysql_real_escape_string($_POST['FFDYearGroup']);
	$lgspn = mysql_real_escape_string($_POST['LGSProNumbers']);
	$lhspn = mysql_real_escape_string($_POST['LHSProNumbers']);
	$ffdpn = mysql_real_escape_string($_POST['FFDProNumbers']);
	$dd = mysql_real_escape_string($_POST['departuredate']);
	$rd = mysql_real_escape_string($_POST['returndate']);
	$pl = mysql_real_escape_string($_POST['ProLocation']);
	$cl = mysql_real_escape_string($_POST['CurriLink']);
	$pt = mysql_real_escape_string($_POST['MainTransport']);
	$pm = mysql_real_escape_string($_POST['Paymentmethod']);
	$cc	= mysql_real_escape_string($_POST['CoachCompany']);
	$tu = mysql_real_escape_string($_POST['TravelCompanyYN']);
	$tn = mysql_real_escape_string($_POST['TravelCompanyName']);
    $cp = mysql_real_escape_string($_POST['PupilCost']);
    $fa = mysql_real_escape_string($_POST['FirstAider']);
	$sa = mysql_real_escape_string($_POST['StaffAcc']);
	$edittripid = $_GET['edittripidpage3'];
	$msg = '<h2>Saving Your Trip Data and Redirecting you to the Next Section...</h2>';
	$redirect = '<meta http-equiv="refresh" content="3;URL=trip_editpage4.php?edittripid=' . $edittripid . '">';
	mysql_query("INSERT INTO log (user, logtime, logdesc, logtripid) VALUES ('$username', NOW(), 'Edited Trip on Section 3 and Saved Changes', $edittripid)");
} 
elseif (isset($_GET['edittripidpage4'])){
	$lgsyg = mysql_real_escape_string($_POST['LGSYearGroup']);
	$lhsyg = mysql_real_escape_string($_POST['LHSYearGroup']);
	$ffdyg = mysql_real_escape_string($_POST['FFDYearGroup']);
	$lgspn = mysql_real_escape_string($_POST['LGSProNumbers']);
	$lhspn = mysql_real_escape_string($_POST['LHSProNumbers']);
	$ffdpn = mysql_real_escape_string($_POST['FFDProNumbers']);
	$dd = mysql_real_escape_string($_POST['departuredate']);
	$rd = mysql_real_escape_string($_POST['returndate']);
	$pl = mysql_real_escape_string($_POST['ProLocation']);
	$cl = mysql_real_escape_string($_POST['CurriLink']);
	$pt = mysql_real_escape_string($_POST['MainTransport']);
	$pm = mysql_real_escape_string($_POST['Paymentmethod']);
	$cc	= mysql_real_escape_string($_POST['CoachCompany']);
	$tu = mysql_real_escape_string($_POST['TravelCompanyYN']);
	$tn = mysql_real_escape_string($_POST['TravelCompanyName']);
    $cp = mysql_real_escape_string($_POST['PupilCost']);
    $fa = mysql_real_escape_string($_POST['FirstAider']);
	$sa = mysql_real_escape_string($_POST['StaffAcc']);
	$edittripid = $_GET['edittripidpage4'];
	$msg = '<h2>Saving Your Trip Data and Redirecting you to the View My Trips Area...</h2>';
	$redirect = '<meta http-equiv="refresh" content="3;URL=trip_view.php">';
	mysql_query("INSERT INTO log (user, logtime, logdesc, logtripid) VALUES ('$username', NOW(), 'Edited Trip on Section 4 and Saved Changes', $edittripid)");
} 
else 
{
	$msg = '<h2>Could Not Save Your Trip Data... Please Contact NSC</h2>';
	$redirect = '<meta http-equiv="refresh" content="3;URL=trip_view.php">';
};


?>
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
	$toplinks = 'You\'re logged in as:&nbsp;'. $username .'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="index.php" class="nav">Main Menu</a>';
} else {
	$toplinks = '<a href="login_form.php" class="nav">You\'re not logged in, click here to log in.</a>';
}

// $toplinks can now be used in any file that login_header is included with(this is included with everypage)
?>
<html>
<head>
	<?php echo $redirect; ?>
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
		<div id="header"><h1>Trip Saving</h1></div>
		<div id="sidebar-a">
			<div class="padding">
			<h2>Help</h2>
			<p>Please wait, page is loading.</p>
			</div>
		</div>
		<div id="content">
			<div class="padding">
			<p><?php echo $msg; ?></p>	
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
