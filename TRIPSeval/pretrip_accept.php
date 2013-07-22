<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<?php
include "connect_mysql_database.php";
session_start();
if (isset($_GET['accepttripid'])) 
	{
	$tripid = $_GET['accepttripid'];
	$username = $_SESSION['username'];
	$acceptmessage ='<h2>Accepting Trip...</h2>';
	// below query to get the school details from the user
	$q3 = mysql_query("SELECT * FROM `teachers` WHERE `username`='$username'");
	while ($row3 = mysql_fetch_array($q3))
		{
		$lgstrip = $row3['LGS'];
		$lhstrip = $row3['LHS'];
		$ffdtrip = $row3['FFD'];
		}
	// now need to figure out which school the person is in
	if ($lgstrip == 1 && $lhstrip == 0 && $ffdtrip == 0)
		{
		// "LGS";
		mysql_query ("UPDATE `trips` SET `lgsevma`=1 WHERE `tripid`='$tripid'");
		}
	else if ($lgstrip == 0 && $lhstrip == 1 && $ffdtrip == 0)
		{
		// "LHS";
		mysql_query ("UPDATE `trips` SET `lhsevma`=1 WHERE `tripid`='$tripid'");
		}
	else if ($lgstrip == 0 && $lhstrip == 0 && $ffdtrip == 1)
		{
		// "FFD";
		mysql_query ("UPDATE `trips` SET `ffdevma`=1 WHERE `tripid`='$tripid'");
	 	}
	else
		{
		// "ERROR"
		};
//
//email setup syntax is mail(to,subject,message,headers,parameters)
// email below goes to the user whos trip it is to tell them it's been accepted by this person.
//
		$q1 = mysql_query("SELECT * FROM `trips` WHERE `tripid`='$tripid'") or die (mysql_error());
		while ($row = mysql_fetch_array($q1)) 
			{
			$tripusername = $row['createdby'];
			}
		$tripuser = $tripusername;
		$q2 = mysql_query("SELECT * FROM `teachers` WHERE `username`='$tripuser'") or die (mysql_error());
		while ($row2 = mysql_fetch_array($q2))
			{
			$tripemail = $row2['Email'];
			}
		$email = $tripemail;
		$from_name = "LES Trips";
		$from_email = "tripsemail@endowedschools.org";
		$headers = "From: $from_name <$from_email>";
		$body = "This Pre Trip - $tripid has been ACCEPTED by $username.";
		$subject = "This Pre Trip - $tripid has been ACCEPTED by $username.";
		$to = $email;
		mail($to, $subject, $body, $headers);
		}
	else
		{
		$acceptmessage ='<h2>Could not accept this Pre Trip, please contact NSC...</h2>';
		};
//
// ********* THIS SECTION IS FOR IF ALL EVMS ASSIGNED HAVE ACCEPTED ************ //
//
				$q4 = mysql_query ("SELECT * FROM `trips` WHERE `tripid`='$tripid'");
				while ($row4 = mysql_fetch_array($q4))
					{
					$lgsevm = $row4['lgsevma'];
					$lhsevm = $row4['lhsevma'];
					$ffdevm = $row4['ffdevma'];
					
					$lgs = $row4['LGS'];
					$lhs = $row4['LHS'];
					$ffd = $row4['FFD'];
					
					}
				//below if stastements first check to see if the school is selected by the trip, if it is then it goes into another if statement which checks if the EVM is set to 1 or not. 
				// both assign a value to a variable if they're met, this will enable me to run a check against these values.
		/* unused code below:
		if ($lgstrip == 1)
					{
						if ($lgsevm == 1)
							{
								$lgsconfirm = 1;
							}
					}
				if ($lhstrip == 1)
					{
						if ($lhsevm == 1)
							{
								$lhsconfirm = 1;
							}
					}
				if ($ffdtrip == 1)
					{
						if ($ffdevm == 1)
							{
								$ffdconfirm = 1;
							}
					}
			
			*/
//********* This is the if elseif statement that will determine when the pretrip is converted to a trip. ********
					//just LGS
				if ($lgs == 1 && $ffd == 0 && $lhs == 0)
						{
						if ($lgsevm == 1)
							{
								mysql_query("UPDATE `trips` SET `pretripaccepted`='1', `pretripdenied`='0', `pretripsubmitted`='0', `pretrip`='0', `trip`='1' WHERE `tripid`='$tripid'");
								mysql_query("INSERT INTO `log` (`user`, `logtime`, `logdesc`, `logtripid`) VALUES ('$username', NOW(), 'Pre Trip accepted - converted to Trip', '$tripid')");
							}
						}
					//just FFD
					if ($lgs == 0 && $ffd == 1 && $lhs == 0)
						{
						if ($ffdevm == 1)
							{
								mysql_query("UPDATE `trips` SET `pretripaccepted`='1', `pretripdenied`='0', `pretripsubmitted`='0', `pretrip`='0', `trip`='1' WHERE `tripid`='$tripid'");
								mysql_query("INSERT INTO `log` (`user`, `logtime`, `logdesc`, `logtripid`) VALUES ('$username', NOW(), 'Pre Trip accepted - converted to Trip', '$tripid')");
							}
						}
					//just LHS
				if ($lgs == 0 && $ffd == 0 && $lhs == 1)
						{
						if ($lhsevm == 1)
							{
								mysql_query("UPDATE `trips` SET `pretripaccepted`='1', `pretripdenied`='0', `pretripsubmitted`='0', `pretrip`='0', `trip`='1' WHERE `tripid`='$tripid'");
								mysql_query("INSERT INTO `log` (`user`, `logtime`, `logdesc`, `logtripid`) VALUES ('$username', NOW(), 'Pre Trip accepted - converted to Trip', '$tripid')");
							}
						}
					//LGS & FFD
				elseif ($lgs == 1 && $ffd == 1 && $lhs == 0)
						{
							if ($lgsevm == 1 && $ffdevm == 1)
							{
								mysql_query("UPDATE `trips` SET `pretripaccepted`='1', `pretripdenied`='0', `pretripsubmitted`='0', `pretrip`='0', `trip`='1' WHERE `tripid`='$tripid'");
								mysql_query("INSERT INTO `log` (`user`, `logtime`, `logdesc`, `logtripid`) VALUES ('$username', NOW(), 'Pre Trip accepted - converted to Trip', '$tripid')");
							}
						}
					//FFD & LHS
				elseif ($lgs == 0 && $ffd == 1 && $lhs == 1)
						{
						if ($ffdevm == 1 && $lhsevm == 1)
							{
								mysql_query("UPDATE `trips` SET `pretripaccepted`='1', `pretripdenied`='0', `pretripsubmitted`='0', `pretrip`='0', `trip`='1' WHERE `tripid`='$tripid'");
								mysql_query("INSERT INTO `log` (`user`, `logtime`, `logdesc`, `logtripid`) VALUES ('$username', NOW(), 'Pre Trip accepted - converted to Trip', '$tripid')");
							}
						}
					//LGS & LHS
				elseif ($lgs == 1 && $ffd == 0 && $lhs == 1)
						{
						if ($lgsevm == 1 && $lhsevm == 1)
							{
								mysql_query("UPDATE `trips` SET `pretripaccepted`='1', `pretripdenied`='0', `pretripsubmitted`='0', `pretrip`='0', `trip`='1' WHERE `tripid`='$tripid'");
								mysql_query("INSERT INTO `log` (`user`, `logtime`, `logdesc`, `logtripid`) VALUES ('$username', NOW(), 'Pre Trip accepted - converted to Trip', '$tripid')");
							}
						}
					//LGS & FFD & LHS
				elseif ($lgs == 1 && $ffd == 1 && $lhs == 1)
						{
							if ($lgsevm == 1 && $ffdevm == 1 && $lhsevm == 1)
							{
								mysql_query("UPDATE `trips` SET `pretripaccepted`='1', `pretripdenied`='0', `pretripsubmitted`='0', `pretrip`='0', `trip`='1' WHERE `tripid`='$tripid'");
								mysql_query("INSERT INTO `log` (`user`, `logtime`, `logdesc`, `logtripid`) VALUES ('$username', NOW(), 'Pre Trip accepted - converted to Trip', '$tripid')");
							}
						}	
				else 
						{
						//do nothing if requirements not met
						};
						
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
	<meta http-equiv="refresh" content="3;pretrip_awaitingapproval.php">
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
		<div id="header"><h1>Pre Trip Accept</h1></div>
		<div id="sidebar-a">
			<div class="padding">
			<h2>Help</h2>
			<p>Page is loading, please wait.</p>
			</div>
		</div>
		<div id="content">
			<div class="padding">
			<?php echo $acceptmessage; ?>
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
