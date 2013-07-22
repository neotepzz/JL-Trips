<?php 
require("connect_mysql_database.php");
session_start(); //start session first, no need to check if the user is logged in as the redirect has taken care of that.
// first need to assign the passed variable - id, into a local variable from a session.
$userid = $_SESSION['id'];
$username = $_SESSION['username'];
$createdby = $_SESSION['username']; //the createdby variable is the username of the person creating the trip
//This section below is for putting the school into the trip by looking at the user's school, then using that and the above information
//to push data into the correct areas in the database.
$schoolquery = mysql_query("SELECT * FROM `teachers` WHERE `username`='$username'");
$schoolarray = mysql_fetch_Array($schoolquery);	
$lgs = $schoolarray['LGS'];
$lhs = $schoolarray['LHS'];
$ffd = $schoolarray['FFD'];
$lesm = $schoolarray['LESM'];
	if ($lgs == 1)
	{
	$lgsvalueholder = '1';
	mysql_query("INSERT INTO `trips` (`createdby`, `LGS`)
	VALUES ('$createdby', '$lgsvalueholder')");
	$tripid = mysql_insert_id();
	mysql_query("INSERT INTO `log` (`user`, `logtime`, `logdesc`, `logtripid`) VALUES ('$username', NOW(), 'Created LGS Pre Trip', '$tripid')");
	mysql_close();
	}
	else if ($lhs == 1)
	{
	$lhsvalueholder = '1';
	mysql_query("INSERT INTO `trips` (`tripid`, `createdby`, `LHS`)
	VALUES ('$tripid', '$createdby', '$lhsvalueholder')");
	$tripid = mysql_insert_id();
	mysql_query("INSERT INTO `log` (`user`, `logtime`, `logdesc`, `logtripid`) VALUES ('$username', NOW(), 'Created LHS Pre Trip', '$tripid')");
	mysql_close();
	}
	else if ($ffd == 1)
	{
	$ffdvalueholder = '1';
	mysql_query("INSERT INTO `trips` (`tripid`, `createdby`, `FFD`)
	VALUES ('$tripid', '$createdby', '$ffdvalueholder')");
	$tripid = mysql_insert_id();
	mysql_query("INSERT INTO `log` (`user`, `logtime`, `logdesc`, `logtripid`) VALUES ('$username', NOW(), 'Created FFD Pre Trip', '$tripid')");
	mysql_close();
	}
	else //if else statement ends on the logic that if it isn't LGS, LHS or FFD it's LESM. 
	{
	$lesmvalueholder = '1';
	mysql_query("INSERT INTO `trips` (`tripid`, `createdby`, `LESM`)
	VALUES ('$tripid', '$createdby', '$lesmvalueholder')");
	$tripid = mysql_insert_id();
	mysql_query("INSERT INTO `log` (`user`, `logtime`, `logdesc`, `logtripid`) VALUES ('$username', NOW(), 'Created LESM Pre Trip', '$tripid')");
	mysql_close();
	};
//Now we have an accurate tripid number for the next trip, this will be populated before this page opens in the database.

?>