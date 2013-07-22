<?php require ("connect_mysql_database.php"); ?>
<?php
session_Start();
//if statement to check if the denied reasons were set, and the to update the database so that I can extract the reason and puit it into the email body below.
if (isset($_POST['dr']))
{
$dr = mysql_real_escape_string($_POST['dr']);
$tripid1 = $_GET['denytripid'];
mysql_query("UPDATE `trips` SET `DeniedReason`='$dr' WHERE `tripid`='$tripid1'");
$username1 = $_SESSION['username'];
mysql_query("INSERT INTO log (user, logtime, logdesc, logtripid) VALUES ('$username1', NOW(), 'Updated Denied Reason for trip with -> $dr, $tripid1)");
};
//if statement to check if the denytripid is set, if it is, update the trip with the info below, making it into a denied pretrip.
if (isset($_GET['denytripid'])) 
{
$tripid = $_GET['denytripid'];
mysql_query("UPDATE `trips` SET `pretripaccepted`='0', `pretripdenied`='1', `pretripsubmitted`='0' WHERE `tripid`='$tripid'"); //updates database to show that the trip is denied.
$acceptmessage ='<h2>Denying this Pre Trip... </h2>';
$username = $_SESSION['username'];
mysql_query("INSERT INTO log (user, logtime, logdesc, logtripid) VALUES ('$username', NOW(), 'Denied Pre Trip', $tripid)");
//email setup syntax is mail(to,subject,message,headers,parameters)
//email setup syntax is mail(to,subject,message,headers,parameters)
		$q1 = mysql_query("SELECT * FROM `trips` WHERE `tripid`='$tripid'") or die (mysql_error()); //gain the data we need from the trips table for the email, in this case, finding the users address and the reason for the deny.
		while ($row = mysql_fetch_array($q1)) 
			{
			$tripusername = $row['createdby'];
			$drr = $row['DeniedReason'];
			}
		$tripuser = $tripusername;
		$drrr = $drr;
		$q2 = mysql_query("SELECT * FROM `teachers` WHERE `username`='$tripuser'") or die (mysql_error());
		while ($row2 = mysql_fetch_array($q2))
		{
			$tripemail = $row2['Email']; //once we have the username, get the usernames email address from the teachers table.
		}
		$email = $tripemail;
		$from_name = "LES Trips";
		$from_email = "tripsemail@endowedschools.org";
		$headers = "From: $from_name <$from_email>";
		$body = "This Pre Trip - $tripid has been DENIED by $username.  For the following reason: $drr.";
		$subject = "This Pre Trip - $tripid has been DENIED by $username.";
		$to = $email;
		mail($to, $subject, $body, $headers);
}
else
{
$acceptmessage ='<h2>Could not deny this Pre Trip, please contact NSC...</h2>';
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
	$toplinks = '<div class="topright">You\'re logged in as:&nbsp;'. $username .'</div><div class="aright"><a href="index.php" class="nav">Main Menu</a></div>';
} else {
	$toplinks = '<a href="login_form.php" class="nav">You\'re not logged in, click here to log in.</a>';
}

// $toplinks can now be used in any file that login_header is included with(this is included with everypage)
?>
<html>
<head>
	<meta http-equiv="refresh" content="3;URL=pretrip_awaitingapproval.php">
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
		<div id="header"><h1>Pre Trip Denied</h1></div>
		<div id="sidebar-a">
			<div class="padding">
			<h2>Help</h2>
			<p>Page is loading, please wait.</p>
			</div>
		</div>
		<div id="content">
			<div class="padding">
			<?php echo $acceptmessage ?>
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


