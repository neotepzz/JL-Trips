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
<?php include ("not_logged_in_redirect.php"); ?>
<?php include ("connect_mysql_database.php"); ?>
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
	<meta http-equiv="refresh" content="5;url=pretrip_view.php">
    <style type="text/css" media="all">@import "css/master.css";</style>  <style type="text/css" media="all">@import "css/master.css";</style>
	<?php 
		session_start();
		if(isset($_GET['deletetripid'])) { //check to see if we can get a value for the deletetripid
		$confirm = $_POST['confirmdelete']; //set confirm variable as the confirmdelete box from the previous page
		$tripid = $_GET['deletetripid']; //tripid is set to the deletetripid
		if ($confirm == "Confirm") { //if the variable confirm is equal to Confirm typed into the delete page's box.
		mysql_query("UPDATE `trips` SET `Delete`='1' WHERE `tripid`='$tripid'") or die (mysql_error());
		$message = "<h2>Your Pre Trip is Being Deleted... Please Wait</h2>";
		}
		else {
		$message = "<h2>Your Pre Trip Cannot Be Deleted... Redirecting You</h2>";
		};
}
else { $message = "<h2>No Data Can Be Found To Delete... Redirecting You</h2>";
};
$username = $_SESSION['username'];
mysql_query("INSERT INTO log (user, logtime, logdesc, logtripid) VALUES ('$username', NOW(), 'Deleted Pre Trip', $tripid)");
	?>
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
		<div id="header"><h1>Delete Pre-Trip</h1></div>
		<div id="sidebar-a">
			<div class="padding">
			<h2>Help</h2>
			<p>Loading, please wait...</p>
			</div>
		</div>
		<div id="content">
			<div class="padding">
			<?php echo $message; ?>	
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
