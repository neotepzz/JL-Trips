<?php require ("connect_mysql_database.php"); ?>
<?php
session_start();
$username = $_SESSION['username'];
if (isset($_GET['edittripid'])){
	//if statement checks to see if the checkbox isset and if its value is 1 (which it will be if the value is =1 in the previous page
			if (isset($_POST['chkFFD']) && $_POST['chkFFD'] == 1)
			{
			$chkffd = 1;
			}
			else
			{
			$chkffd = 0;
			};
			// chkffd = 1 means that the user DID tick the checkbox.
			// chkffd = 0 means that the user DID NOT tick the checkbox.
			if (isset($_POST['chkLGS']) && $_POST['chkLGS'] == 1)
			{
			$chklgs = 1;
			}
			else
			{
			$chklgs = 0;
			};
			// chklgs = 1 means that the user DID tick the checkbox.
			// chklgs = 0 means that the user DID NOT tick the checkbox.
			if (isset($_POST['chkLHS']) && $_POST['chkLHS'] == 1)
			{
			$chklhs = 1;
			}
			else
			{
			$chklhs = 0;
			};	
			// chklhs = 1 means that the user DID tick the checkbox.
			// chklhs = 0 means that the user DID NOT tick the checkbox.
			$lgs = mysql_real_escape_string($chklgs);
			$lhs = mysql_real_escape_string($chklhs);
			$ffd = mysql_real_escape_string($chkffd);
	$sqltripid = mysql_real_escape_string($_GET['edittripid']);
	$description = mysql_real_escape_string($_POST['description']);
	$organiser = mysql_real_escape_string($_POST['organiser']);
	$dept = mysql_real_escape_string($_POST['department']);
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
	$msg = '<h2>Saving Your Pre Trip Data...</h2>';
	mysql_query("UPDATE trips SET description='$description', organiser='$organiser', Department='$dept', LGSYearGroups='$lgsyg', LHSYearGroups='$lhsyg', FFDYearGroups='$ffdyg', FFDProposedNumbers='$ffdpn', LGSProposedNumbers='$lgspn', LHSProposedNumbers='$lhspn', deptdate='$dd', retdate='$rd', ProposedLocation='$pl', CurriculumValue='$cl', ProposedTransport='$pt', PaymentMethod='$pm', CoachCompany='$cc', TravelCompanyUse='$tu', TravelCompName='$tn', PupilCost='$cp', `FirstAiders`='$fa', StaffAcc='$sa', `LGS`='$lgs', `LHS`='$lhs', `FFD`='$ffd' WHERE tripid = '$sqltripid'") or die (mysql_error());
	mysql_query("INSERT INTO log (user, logtime, logdesc, logtripid) VALUES ('$username', NOW(), 'Edited Pre Trip and saved changes', $sqltripid)");

} elseif (isset($_GET['createpretriptripid'])){
	/*
	********* This section will determine the schools that need to be assigned ********
	*/
	//if statement checks to see if the checkbox isset and if its value is 1 (which it will be if the value is =1 in the previous page
			if (isset($_POST['chkFFD']) && $_POST['chkFFD'] == 1)
			{
			$chkffd = 1;
			}
			else
			{
			$chkffd = 0;
			};
			// chkffd = 1 means that the user DID tick the checkbox.
			// chkffd = 0 means that the user DID NOT tick the checkbox.
			if (isset($_POST['chkLGS']) && $_POST['chkLGS'] == 1)
			{
			$chklgs = 1;
			}
			else
			{
			$chklgs = 0;
			};
			// chklgs = 1 means that the user DID tick the checkbox.
			// chklgs = 0 means that the user DID NOT tick the checkbox.
			if (isset($_POST['chkLHS']) && $_POST['chkLHS'] == 1)
			{
			$chklhs = 1;
			}
			else
			{
			$chklhs = 0;
			};	
			// chklhs = 1 means that the user DID tick the checkbox.
			// chklhs = 0 means that the user DID NOT tick the checkbox.
			$lgs = mysql_real_escape_string($chklgs);
			$lhs = mysql_real_escape_string($chklhs);
			$ffd = mysql_real_escape_string($chkffd);	
	$sqltripid = mysql_real_escape_string($_GET['createpretriptripid']);
	$description = mysql_real_escape_string($_POST['description']);
	$organiser = mysql_real_escape_string($_POST['organiser']);
	$dept = mysql_real_escape_string($_POST['department']);
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
	include ("pretrip_createddatecalc.php"); 
	$msg = '<h1>Saving Your Pre Trip Data...</h1>';
	mysql_query("UPDATE trips SET description='$description', organiser='$organiser', Department='$dept', LGSYearGroups='$lgsyg', LHSYearGroups='$lhsyg', FFDYearGroups='$ffdyg', FFDProposedNumbers='$ffdpn', LGSProposedNumbers='$lgspn', LHSProposedNumbers='$lhspn', deptdate='$dd', retdate='$rd', ProposedLocation='$pl', CurriculumValue='$cl', ProposedTransport='$pt', PaymentMethod='$pm', CoachCompany='$cc', TravelCompanyUse='$tu', TravelCompName='$tn', PupilCost='$cp', `FirstAiders`='$fa', StaffAcc='$sa', `LGS`='$lgs', `LHS`='$lhs', `FFD`='$ffd' WHERE tripid = '$sqltripid'") or die (mysql_error());
	mysql_query("INSERT INTO `log` (`user`, `logtime`, `logdesc`, `logtripid`) VALUES ('$username', NOW(), 'Created Pre Trip and saved changes', '$sqltripid')");
} else {
	$msg = '<h2>Could Not Save Your Pre Trip Data... Please Contact NSC</h2>';
}


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
	<meta http-equiv="refresh" content="3;URL=pretrip_view.php">
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
		<div id="header"><h1>Pre Trip Saving</h1></div>
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
