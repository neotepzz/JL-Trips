<?php include ("not_logged_in_redirect.php"); ?>
<?php include("connect_mysql_database.php"); ?>
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
	$createdby = $_SESSION['username'];
	mysql_query("INSERT INTO `trips` (`tripid`, `createdby`) VALUES (NULL, '$createdby')");
	$tripid = mysql_insert_id();
	mysql_query("INSERT INTO `log` (`user`, `logtime`, `logdesc`, `logtripid`) VALUES ('$username', NOW(), 'Created Pre Trip', '$tripid')");
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
		<div id="header"><h1>New Pre-Trip</h1></div>
		<div id="sidebar-a">
			<div class="padding">
			<h2>Help</h2>
			<p>This is a Pre-Trip, here you will enter a small amount of information related to the Trip you intend to go on, this will enable the SLT to make a quick decision as to whether this Trip should be taken any further or not. Once accepted, your Pre-Trip becomes a Trip. If denied, you can try again unless specified otherwise.  </p>
			</div>
		</div>
		<div id="content">
			<div class="padding">
<form action="pretrip_update.php?createpretriptripid=<?php echo $tripid; ?>" method="post">
<table class="CreatePreTripTable">
<tr>
<th>
LGS
</th>
<td>
<input type='checkbox' name='chkLGS' value='1'>
</td>
</tr>
<tr>
<th>
LHS
</th>
<td>
<input type='checkbox' name='chkLHS' value='1'>
</td>
</tr>
<tr>
<th>
FFD
</th>
<td>
<input type='checkbox' name='chkFFD' value='1'>
</td>
</tr>
<tr>
</tr>
<tr>
<th>
Trip Description
</th>
<td>
<input type="text" name="description" value="Please Enter Your Trip Description Here" size="40">
</td>
</tr>
<tr>
<th>
Trip ID
</th>
<td>
<?php echo $tripid ; ?>
</td>
</tr>
<tr>
<th>
Full Name of Trip Organiser 
</th>
<td>
<input type="text" name="organiser" value="Please Enter The Full Name of the Trip Organiser" size="40">
</td>
</tr>
<tr>
<th>
Department
</th>
<td align="center">
<select name="department">
<option value ="NA">N/A</option>
<option value ="English & Drama">English &amp; Drama</option>
<option value ="Maths">Maths</option>
<option value ="Biology">Biology</option>
<option value ="Chemistry">Chemistry</option>
<option value ="Art & Design">Art &amp; Design</option>
<option value ="History">History</option>
<option value ="MFL">Modern Foreign Languages</option>
<option value ="Classics">Classics</option>
<option value ="Politics">Politics</option>
<option value ="Business Studies">Business Studies</option>
<option value ="CCF">CCF</option>
<option value ="Music">Music</option>
<option value ="D of E">D of E</option>
<option value ="Economics">Economics</option>
<option value ="Food">Food</option>
<option value ="Careers">Careers</option>
<option value ="PE">PE</option>
<option value ="Sports">Sports</option>
<option value ="Pastoral">Pastoral</option>
</select>
</td>
</tr>
<tr>
<th>
LGS Year Group/s
</th>
<td>
<input type="text" name="LGSYearGroup" size="10">
</td>
</tr>
<tr>
<th>
LHS Year Group/s
</th>
<td>
<input type="text" name="LHSYearGroup" size="10">
</td>
</tr>
<tr>
<th>
FFD Year Group/s
</th>
<td>
<input type="text" name="FFDYearGroup" size="10">
</td>
</tr>
<tr>
<th>
LGS Proposed Numbers
</th>
<td>
<input type="number" name="LGSProNumbers" size="4">
</td>
</tr>
<tr>
<th>
LHS Proposed Numbers
</th>
<td>
<input type="number" name="LHSProNumbers" size="4">
</td>
</tr>
<tr>
<th>
FFD Proposed Numbers
</th>
<td>
<input type="number" name="FFDProNumbers" size="4">
</td>
</tr>
<tr>
<th>
Departure Date &amp; Time
</th>
<td>
<input type="datetime" name="departuredate">
</td>
</tr>
<tr>
<th>
Return Date &amp; Time
</th>
<td>
<input type="datetime" name="returndate">
</td>
</tr>
<tr>
<th>
Proposed Location
</th>
<td>
<input type="text" name="ProLocation" size="35">
</td>
</tr>
<tr>
<th>
Curriculum Link &amp; Value (Up to 1000 Characters)
</th>
<td>
<textarea cols="35" rows="10" name="CurriLink">Enter details here of the value of the Trip with regard to the Curriculum.</textarea>
</td>
</tr>
<tr>
<th>
Main Method of Transportation
</th>
<td align="center">
<select name="MainTransport">
<option value ="NA">N/A</option>
<option value ="Underground">Underground</option>
<option value ="Eurostar">Eurostar</option>
<option value ="Aeroplane">Aeroplane</option>
<option value ="Coach">Coach</option>
<option value ="Ferry / Hovercraft">Ferry / Hovercraft</option>
<option value ="MiniBus">MiniBus</option>
<option value ="MiniBusTrailer">MiniBus + Trailer</option>
<option value ="Public Transport">Public Transport</option>
<option value ="Train">Train</option>
<option value ="Walking">Walking</option>
<option value ="Car">Car</option>
<option value ="D of E">Pupil Making Own Way</option>
</select>
</td>
</tr>
<tr>
<th>
Payment Method
</th>
<td>
<select name="Paymentmethod">
<option value ="NA">N/A</option>
<option value ="Cheque">Cheque</option>
<option value ="Fee">Fee, subject to accountants prior approval</option>
<option value ="Pay on Day">Pay on Day</option>
</select>
</td>
</tr>
<tr>
<th>
Name of Coach Company
</th>
<td align="center">
<select name="CoachCompany">
<option value ="NA">N/A</option>
<option value ="Ausden Clark">Ausden Clark</option>
<option value ="Palmer">Palmer</option>
<option value ="Skills">Skills</option>
<option value ="Paul S Winson">Paul S Winson</option>
<option value ="Roberts Coaches">Roberts Coaches</option>
<option value ="Lester Coaches">Lester Coaches</option>
<option value ="Other">Other</option>
<option value ="Approved Supplier">Travel Company Approved Supplier</option>
</select>
</td>
</tr>
<tr>
<th>
Travel Company
</th>
<td>
<select name="TravelCompanyYN">
<option value ="No">No</option>
<option value="Yes">Yes</option>
</select>
</td>
</tr>
<tr>
<th>
Travel Company Name
</th>
<td>
<input type="text" name="TravelCompanyName" size="25">
</td>
</tr>
<tr>
<th>
Cost to Pupil of Trip
</th>
<td>
<input type="text" name="PupilCost" value="00.00" size="6">
</td>
</tr>
<tr>
<th>
First Aiders Accompanying
</th>
<td>
<textarea cols="35" rows="6" name ="FirstAider">Enter the names of other staff attending the trip that are qualified First Aiders and there qualifications if possible...</textarea>
</td>
</tr>
<tr>
<th>
Staff Accompanying
</th>
<td>
<textarea cols="35" rows="6" name ="StaffAcc">Enter the names of other staff attending the trip...</textarea>
</td>
</tr>
<tr>
<td colspan="2">
<input type="submit" Value="Save &amp; Exit">
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

