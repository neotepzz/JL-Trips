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
			<h1>Edit Trip - Section 1</h1>
		</div>
		<div id="sidebar-a">
			<div class="padding">
			<h2>Help</h2>
			<p>This is a Pre-Trip, here you will enter a small amount of information related to the Trip you intend to go on, this will enable the SLT to make a quick decision as to whether this Trip should be taken any further or not. Once accepted, your Pre-Trip becomes a Trip. If denied, you can try again unless specified otherwise.  </p>
	<h2>Sections</h2>
			<h3>Using the 'Skip To' links below will not save any of your entered data.</h3> <p> You must use the Save &amp; Continue button for this at the bottom of the page.</p>
				<?php
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
else 	{
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
// **************************************** Below code is to show the selected drop down box option for Department Select Box (drop down) **********************************
//
$s1 = '';
$s2 = '';
$s3 = '';
$s4 = '';
$s5 = '';
$s6 = '';
$s7 = '';
$s8 = '';
$s9 = '';
$s10 = '';
$s11 = '';
$s12 = '';
$s13 = '';
$s14 = '';
$s15 = '';
$s16 = '';
$s17 = '';
$s18 = '';
$s19 = '';
$s20 = '';
// if statement to set the selected value for the drop down box.
if ($dept == "NA")
{
$s1 = 'selected';
}
else if ($dept == "English & Drama")
{
$s2 = 'selected';
}
else if ($dept == "Maths")
{
$s3 = 'selected';
}
else if ($dept == "Biology")
{
$s4 = 'selected';
}
else if ($dept == "Chemistry")
{
$s5 = 'selected';
}
else if ($dept == "Art & Design")
{
$s6 = 'selected';
}
else if ($dept == "History")
{
$s7 = 'selected';
}
else if ($dept == "MFL")
{
$s8 = 'selected';
}
else if ($dept == "Classics")
{
$s9 = 'selected';
}
else if ($dept == "Politics")
{
$s10 = 'selected';
}
else if ($dept == "Business Studies")
{
$s11 = 'selected';
}
else if ($dept == "CCF")
{
$s12 = 'selected';
}
else if ($dept == "Music")
{
$s13 = 'selected';
}
else if ($dept == "D of E")
{
$s14 = 'selected';
}
else if ($dept == "Economics")
{
$s15 = 'selected';
}
else if ($dept == "Food")
{
$s16 = 'selected';
}
else if ($dept == "Careers")
{
$s17 = 'selected';
}
else if ($dept == "PE")
{
$s18 = 'selected';
}
else if ($dept == "Sports")
{
$s19 = 'selected';
}
else if ($dept == "Pastoral")
{
$s20 = 'selected';
}
else 
{
};
//
// **************************************** Below code is to show the selected drop down box option for Main Transport Select Box (drop down) **********************************
//
$mt1 = '';
$mt2 = '';
$mt3 = '';
$mt4 = '';
$mt5 = '';
$mt6 = '';
$mt7 = '';
$mt8 = '';
$mt9 = '';
$mt10 = '';
$mt11 = '';
$mt12 = '';
$mt13 = '';
$mt14 = '';
//  if statement to set the selected value for the drop down box.
if ($pt == "NA")
{
$mt1 = 'selected';
}
else if ($pt == "Underground")
{
$mt2 = 'selected';
}
else if ($pt == "Eurostar")
{
$mt3 = 'selected';
}
else if ($pt == "Aeroplane")
{
$mt4 = 'selected';
}
else if ($pt == "Coach")
{
$mt5 = 'selected';
}
else if ($pt == "Ferry / Hovercraft")
{
$mt6 = 'selected';
}
else if ($pt == "MiniBus")
{
$mt7 = 'selected';
}
else if ($pt == "MiniBusTrailer")
{
$mt8 = 'selected';
}
else if ($pt == "Public Transport")
{
$mt10 = 'selected';
}
else if ($pt == "Train")
{
$mt11 = 'selected';
}
else if ($pt == "Walking")
{
$mt12 = 'selected';
}
else if ($pt == "Car")
{
$mt13 = 'selected';
}
else if ($pt == "Pupil")
{
$mt14 = 'selected';
}
else
{
};
//
// **************************************** Below code is to show the selected drop down box option for Payment Method Select Box (drop down) **********************************
//
$pm1 = '';
$pm2 = '';
$pm3 = '';
$pm4 = '';
if ($pm == "NA")
{
$pm1 = 'selected';
}
else if ($pm == "Cheque")
{
$pm2 = 'selected';
}
else if ($pm == "Fee")
{
$pm3 = 'selected';
}
else if ($pm == "Pay on Day")
{
$pm4 = 'selected';
}
else
{
};
//
// **************************************** Below code is to show the selected drop down box option for Coach Company Select Box (drop down) **********************************
//
$cc1 = ""; 
$cc2 = ""; 
$cc3 = ""; 
$cc4 = ""; 
$cc5 = ""; 
$cc6 = ""; 
$cc7 = ""; 
$cc8 = ""; 
$cc9 = ""; 
$cc10 = ""; 
$cc11 = ""; 
if ($cc == "NA")
{
$cc1 = 'selected';
}
else if ($cc == "Ausden Clark")
{
$cc2 = 'selected';
}
else if ($cc == "Palmer")
{
$cc3 = 'selected';
}
else if ($cc == "Skills")
{
$cc4 = 'selected';
}
else if ($cc == "Paul S Winson")
{
$cc6 = 'selected';
}
else if ($cc == "Roberts Coaches")
{
$cc7 = 'selected';
}
else if ($cc == "Lester Coaches")
{
$cc9 = 'selected';
}
else if ($cc == "Other")
{
$cc10 = 'selected';
}
else if ($cc == "Approved Supplier")
{
$cc11 = 'selected';
}
else
{
};
//
// **************************************** Below code is to show the selected drop down box option for Travel Company Select Box (drop down) **********************************
//
$tu1 = '';
$tu2 = '';
if ($tu == "No")
{
$tu1 = 'selected';
}
else if ($tu == "Yes")
{
$tu2 = 'selected';
}
else
{
};
//
// ************************ Below code is to show selected or not in the checkboxes at the top of the page *********************
//
if ($lgs == 1)
{$lgs1 = 'checked';}
else
{$lgs1 = '';};

if ($lhs == 1)
{$lhs1 = 'checked';}
else
{$lhs1 = '';};

if ($ffd == 1)
{$ffd1 = 'checked';}
else
{$ffd1 = '';};
?>
<body>
<tr>
<td>
<form action="trip_update.php?edittripidpage1=<?php echo $gettripid; ?>" method="post">
<table>
<tr>
<th>
Trip Status
</th>
<td>
<?php echo $display; ?>
</td>
</tr>
<tr>
<th>
Trip Description
</th>
<td>
<?php echo $description; ?>
</td>
</tr>
<tr>
<th>
Trip ID
</th>
<td>
<?php echo $gettripid; ?>
</td>
</tr>
<tr>
<th>
Full Name of Trip Organiser 
</th>
<td>
<?php echo $organiser; ?>
</td>
</tr>
<tr>
<th>
Department
</th>
<td>
<?php echo $dept; ?>
</td>
</tr>
<tr>
<th>
LGS Year Group/s
</th>
<td>
<input type="text" name="LGSYearGroup" value="<?php echo $lgsyg; ?>">
</td>
</tr>
<tr>
<th>
LHS Year Group/s
</th>
<td>
<input type="text" name="LHSYearGroup" value="<?php echo $lhsyg; ?>">
</td>
</tr>
<tr>
<th>
FFD Year Group/s
</th>
<td>
<input type="text" name="FFDYearGroup" value="<?php echo $ffdyg; ?>">
</td>
</tr>
<tr>
<th>
LGS Proposed Numbers
</th>
<td align="center">
<input type="number" name="LGSProNumbers" value="<?php echo $lgspn; ?>">
</td>
</tr>
<tr>
<th>
LHS Proposed Numbers
</th>
<td align="center">
<input type="number" name="LHSProNumbers" value="<?php echo $lhspn; ?>">
</td>
</tr>
<tr>
<th>
FFD Proposed Numbers
</th>
<td align="center">
<input type="number" name="FFDProNumbers" value="<?php echo $ffdpn; ?>">
</td>
</tr>
<tr>
<th>
Departure Date &amp; Time
</th>
<td>
<input type="datetime" name="departuredate" value="<?php echo $dd;?>">
</td>
</tr>
<tr>
<th>
Return Date &amp; Time
</th>
<td>
<input type="datetime" name="returndate" value="<?php echo $rd;?>">
</td>
</tr>
<tr>
<th>
Proposed Location
</th>
<td>
<input type="text" name="ProLocation" value="<?php echo $pl; ?>">
</td>
</tr>
<tr>
<th>
Curriculum Link &amp; Value (Up to 1000 Characters)
</th>
<td>
<input type="text" name="CurriLink" value="<?php echo $cl; ?>">
</td>
</tr>
<tr>
<th>
Main Method of Transportation
</th>
<td>
<select name="MainTransport">
<option value ="NA" <?php echo $mt1; ?>>N/A</option>
<option value ="Underground" <?php echo $mt2; ?>>Underground</option>
<option value ="Eurostar" <?php echo $mt3; ?>>Eurostar</option>
<option value ="Aeroplane" <?php echo $mt4; ?>>Aeroplane</option>
<option value ="Coach" <?php echo $mt5; ?>>Coach</option>
<option value ="Ferry / Hovercraft" <?php echo $mt6; ?>>Ferry / Hovercraft</option>
<option value ="MiniBus" <?php echo $mt7; ?>>MiniBus</option>
<option value ="MiniBusTrailer" <?php echo $mt8; ?>>MiniBus + Trailer</option>
<option value ="Public Transport" <?php echo $mt10; ?>>Public Transport</option>
<option value ="Train" <?php echo $mt11; ?>>Train</option>
<option value ="Walking" <?php echo $mt12; ?>>Walking</option>
<option value ="Car" <?php echo $mt13; ?>>Car</option>
<option value ="Pupil" <?php echo $mt14; ?>>Pupil Making Own Way</option>
</select>
</td>
</tr>
<tr>
<th>
Payment Method
</th>
<td>
<select name="Paymentmethod">
<option value ="NA" <?php echo $pm1; ?>>N/A</option>
<option value ="Cheque" <?php echo $pm2; ?>>Cheque</option>
<option value ="Fee" <?php echo $pm3; ?>>Fee, subject to accountants prior approval</option>
<option value ="Pay on Day" <?php echo $pm4; ?>>Pay on Day</option>
</select>
</td>
</tr>
<tr>
<th>
Name of Coach Company
</th>
<td>
<select name="CoachCompany">
<option value ="NA" <?php echo $cc1; ?>>N/A</option>
<option value ="Ausden Clark" <?php echo $cc2; ?>>Ausden Clark</option>
<option value ="Palmer" <?php echo $cc3; ?>>Palmer</option>
<option value ="Skills" <?php echo $cc4; ?>>Skills</option>
<option value ="Paul S Winson" <?php echo $cc6; ?>>Paul S Winson</option>
<option value ="Roberts Coaches" <?php echo $cc7; ?>>Roberts Coaches</option>
<option value ="Lester Coaches" <?php echo $cc9; ?>>Lester Coaches</option>
<option value ="Other" <?php echo $cc10; ?>>Other</option>
<option value ="Approved Supplier" <?php echo $cc11; ?>>Travel Company Approved Supplier</option>
</select>
</td>
</tr>
<tr>
<th>
Travel Company
</th>
<td>
<select name="TravelCompanyYN">
<option value ="No" <?php echo $tu1; ?>>No</option>
<option value="Yes" <?php echo $tu2; ?>>Yes</option>
</select>
</td>
</tr>
<tr>
<th>
Travel Company Name
</th>
<td>
<input type="text" name="TravelCompanyName" value="<?php echo $tn; ?>">
</td>
</tr>
<tr>
<th>
Cost to Pupil of Trip
</th>
<td>
<input type="text" name="PupilCost" value="<?php echo $cp; ?>">
</td>
</tr>
<tr>
<th>
First Aiders Accompanying
</th>
<td>
<input type="text" name="FirstAider" value="<?php echo $fa; ?>">
</td>
</tr>
<tr>
<th>
Staff Accompanying
</th>
<td>
<input type="text" name="StaffAcc" value="<?php echo $sa; ?>">
</td>
</tr>
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



