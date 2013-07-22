<?php 
include ("connect_mysql_database.php");
session_start();
$subid = ($_GET['submittripid']);
mysql_query ("UPDATE trips SET pretripaccepted=0 AND pretripdenied=0 AND pretripsubmitted=1 WHERE tripid=$subid") or die (mysql_error());
$username = $_SESSION['username'];
mysql_query("INSERT INTO log (user, logtime, logdesc, logtripid) VALUES ('$username', NOW(), 'Submitted Trip', $subid)");
$submitmessage = '<h2>Submitting Your Trip... Please Wait</h2>';
//}
//else
//{
//$submitmessage = '<h2>Your Pre Trip Cannot Be Submitted... Redirecting You </h2>';
//};
?>
