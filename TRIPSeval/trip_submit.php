<?php 
include ("connect_mysql_database.php");
session_start();
$subid = ($_GET['submittripid']);
mysql_query ("UPDATE `trips` SET `tripaccepted`='0', `tripdenied`='0', `tripsubmitted`='1' WHERE `tripid`='$subid'");
$username = $_SESSION['username'];
mysql_query("INSERT INTO `log` (`user`, `logtime`, `logdesc`, `logtripid`) VALUES ('$username', NOW(), 'Submitted Trip', '$subid')");
$submitmessage = '<h2>Submitting Your Trip... Please Wait</h2>';
//email setup syntax is mail(to,subject,message,headers,parameters)
		$q1 = mysql_query("SELECT * FROM `trips` WHERE `tripid`='$subid'") or die (mysql_error());
		while ($row = mysql_fetch_array($q1)) 
			{
			$tripusername = $row['createdby'];
			}
		$tripuser = $tripusername;
		$q2 = mysql_query("SELECT * FROM `teachers` WHERE `username`='$tripuser'") or die (mysql_error());
		while ($row2 = mysql_fetch_array($q2))
			{
			$tripemail = $row2['Email'];
			$lgs = $row2['LGS'];
			$lhs = $row2['LHS'];
			$ffd = $row2['FFD'];
			}
			//below statement checks for the school!
			if ($lgs == 1)
				{
				$school = 'LGS'; 
				}
			else if ($lhs == 1)
				{
				$school = 'LHS';
				}
			else if ($ffd == 1)
				{
				$school = 'FFD';
				}
			else
				{
				$school = 'ERROR';
				};
		//this query below is finding the EVM for the school
		$q3 = mysql_query("SELECT * FROM `teachers` WHERE `EVM`='1' AND `$school`='1'") or die (mysql_error());
		//while statement to mail all the EVM's that a trip has been submitted
		while ($row3 = mysql_fetch_array($q3))
		//the email below this goes to the user
		$email = $tripemail;
		$from_name = "LES Trips";
		$from_email = "tripsemail@endowedschools.org";
		$headers = "From: $from_name <$from_email>";
		$body = "This Trip - $subid has been SUBMITTED.";
		$subject = "This Trip - $subid has been SUBMITTED.";
		$to = $email;
		mail($to, $subject, $body, $headers);
		$toplinks = "";
if (isset($_SESSION['id'])) {
	// Put stored session variables into local php variable
    $userid = $_SESSION['id'];
    $username = $_SESSION['username'];
	$toplinks = '<div class="topright">You\'re logged in as:&nbsp;'. $username .'</div><div class="aright"><a href="index.php" class="nav">Main Menu</a></div>';
} else {
	$toplinks = '<a href="login_form.php" class="nav">You\'re not logged in, click here to log in.</a>';
}
?>
<html>
<head>
	<meta http-equiv="refresh" content="2;URL=trip_view.php">
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
		<div id="header"><h1>Trip Submitting</h1></div>
		<div id="sidebar-a">
			<div class="padding">
			<h2>Help</h2>
			<p>Please wait, page is loading.</p>
			</div>
		</div>
		<div id="content">
			<div class="padding">
			<p><?php echo $submitmessage; ?></p>	
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