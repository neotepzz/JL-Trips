<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php require ("not_logged_in_redirect.php"); ?>
<?php include ("connect_mysql_database.php"); ?>
<?php
require("connect_mysql_database.php");
session_start();

		$username = $_SESSION['username'];
		$schoolquery = mysql_query("SELECT * FROM `teachers` WHERE `username`='$username'");
		$schoolarray = mysql_fetch_Array($schoolquery);	
		$lgs1 = $schoolarray['LGS'];
		$lhs2 = $schoolarray['LHS'];
		$ffd3 = $schoolarray['FFD'];
		// need an if statement to figure out which one of these is true in each user's case.
		if ($lgs1 == 1)
			{
			$school = 'LGS'; 
			}
		elseif ($lhs2 == 1)
			{
			$school = 'LHS';
			}
		elseif ($ffd3 == 1)
			{
			$school = 'FFD';
			}
		else //if else statement ends on the logic that if it isn't LGS, LHS or FFD it's an error
			{
			$school = 'Error';
			};
// now the school is found out, need to check for trips that are submitted, from that school.
$submitquery = mysql_query("SELECT * FROM `trips` WHERE `pretripsubmitted`='1' AND `$school`='1' AND `pretripaccepted`='0' AND `pretripdenied`='0'") or die (mysql_error());
$submitcount = mysql_num_rows($submitquery);
$trip_list = "";
if($submitcount > 0) {
		while($row = mysql_fetch_array($submitquery)) { // assign the query to the row, fetching the data into an array
			$tripid = $row['tripid']; //assign the tripid column to the $tripid variable, same as the below
			$createdby = $row['createdby'];
			$description = $row['description'];
			$organiser = $row['organiser'];
			$pretripaccepted = $row['pretripaccepted'];
			$pretripdenied = $row['pretripdenied'];
			$pretripsubmitted = $row['pretripsubmitted'];
			$createddate = $row['createddate'];
			$lgs = $row['LGS'];
			$lhs = $row['LHS'];
			$ffd = $row['FFD'];
			$lgsevm = $row['lgsevma'];
			$lhsevm = $row['lhsevma'];
			$ffdevm = $row['ffdevma'];
			$school2 = $school;
			$denied = $row['DeniedReason'];
			// below checks if the school is lgs/lhs/ffd and if it has been accepted by that school as well, colour shows green, if it's just a school assigned and hasn't been accepted shows red, if the school isn't involved shows grey.
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
		
	

		if ($school2 == 'LGS' && $lgsevm == 1) 
			{$lgstick = 1;}
		else {$lgstick = 0;};
		
		if ($school2 == 'LHS' && $lhsevm == 1) 
			{$lhstick = 1;}
		else {$lhstick = 0;};
		
		if ($school2 == 'FFD' && $ffdevm == 1) 
			{$ffdtick = 1;}
		else {$ffdtick = 0;};


	// this displays the accurate school information below in a mini table inside the status column.
			$display = "<table><tr><td class='". $lgscol . "'>G</td></tr><tr><td class='" . $lhscol . "'>H</td></tr><Tr><td class='" . $ffdcol . "'>F</td></tr></td></table>";
			//this if statement decides which links appear - top one is if it is accepted already 
			if ($school2 == 'LGS' && $lgstick == 1 || $school2 == 'LHS' && $lhstick == 1 || $school2 == 'FFD' && $ffdstick == 1) 
			{	//Create a variable for View Link
				$viewlink = "<a href='pretrip_viewtrip.php?viewtripid=$tripid'>View</a>";
	//Create a variable for the Accept Link
				$acceptlink = "Accepted";
	//Create a variable for the Denied Link.
				$deniedlink = "Accepted";
	//Now create the variable that will display the data.} 
				$givetriplist = 1;
			}
			elseif ($lgstick == 0 || $lhstick == 0 || $ffdstick == 0)
			{	$viewlink = "<a href='pretrip_viewtrip.php?viewtripid=$tripid'>View</a>";
	//Create a variable for the Accept Link
				$acceptlink = "<a href='pretrip_accept.php?accepttripid=$tripid'>Accept</a>&nbsp;&nbsp;";
	//Create a variable for the Denied Link.
				$deniedlink = "<a href='pretrip_deniedreason.php?denytripid=$tripid'>Deny</a>";
	//Now create the variable that will display the data.}}
				$givetriplist = 1;
			}
			else
			{
				$viewlink = "Error";
	//Create a variable for the Accept Link
				$acceptlink = "Error";
	//Create a variable for the Denied Link.
				$deniedlink = "Error";
	//Now create the variable that will display the data.}}
				$givetriplist = 1;
			};
			if ($givetriplist == 1)
			{
			$trip_list .= "<tr class='trborder'><td>$createdby</td><td>$description</td><td>$display</td><td>$createddate</td><td>$viewlink</td><td>$acceptlink&nbsp;/&nbsp;$deniedlink</td></tr>";}

}
}
	 else 	{
			$trip_list = '<h2 align="center">There Are No Pre Trips Awaiting Approval</h2>';
	};

$denyr = "<th> " .  $denied . " </th>";
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
		<div id="header"><h1>Pre-Trips Awaiting Approval</h1></div>
		<div id="sidebar-a">
			<div class="padding">
			<h2>Help</h2>
			<p>Here you can view Pre-Trips awaiting to be accepted or denied and also View the trip before making that decision. Simply click the accept or deny link once the decision is made. If you select deny, you will be asked to provide a reason, this will be added to the email notification so as to inform the staff member why the pre-trip was denied.</p>
			</div>
		</div>
		<div id="content">
			<div class="padding">
				<table><tr class="trborder"><th>Created By</th><th>Trip Description</th><th>Pre Trip Status</th><th>Created Date</th><th>View Pre Trip</th><th>Accept/Deny Pre Trip</th></tr>
				<?php echo $trip_list ?>
				</table>	
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