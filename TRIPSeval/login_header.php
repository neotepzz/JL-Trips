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
	$toplinks = '<font id ="toplinksloggedin">You\'re logged in as: <font color="#0000CC">'. $username .'</font>&nbsp;&nbsp;&nbsp; <a href="index.php">Main Menu</a></font>';
} else {
	$toplinks = '<a id ="toplinksloggedout" href="login_form.php">You\'re not logged in, click here to log in.</a>';
}

// $toplinks can now be used in any file that login_header is included with(this is included with everypage)
?>