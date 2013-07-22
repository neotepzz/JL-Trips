<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
if(isset($_GET['fltripid']))
{
	// Where the file is going to be placed 
	$tripid = $_GET['fltripid'];
	$target_path = "C:\\xampp\\htdocs\\TRIPSeval\\uploads\\$tripid\\";
	$folder_path = "C:\\xampp\\htdocs\\TRIPSeval\\uploads\\$tripid\\";
	if(!is_dir($folder_path))
		{
		mkdir("C:\\xampp\\htdocs\\TRIPSeval\\uploads\\$tripid",0700);
		}
	else
		{

		};
	/* Add the original filename to our target path.  
	Result is "uploads/filename.extension" */
	$target_path = $target_path . basename($_FILES['myFile']['name']); 
	if(move_uploaded_file($_FILES['myFile']['tmp_name'], $target_path)) 
		{
		    $message = "The file ".  basename( $_FILES['myFile']['name']). 
		    " has been uploaded";
			$error = "There is no error";
	} else
	{
			$error = $_FILES['myFile']['error'];
		    $message = "There was an error uploading the file, please try again!";
	};
}

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
	<meta http-equiv="refresh" content="3;trip_editpage4.php?edittripid=<?php echo $tripid; ?>">
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
				<?php echo $toplinks; ?>
			</span>
		</div>
		<div id="header"><h1>Main Menu</h1></div>
		<div id="sidebar-a">
			<div class="padding">
			<h2>Help</h2>
			<p>On this page you can upload files that will be kept in a folder on our server for access that are related to your trip.</p>
			</div>
		</div>
		<div id="content">
			<div class="padding">
				<?php
					echo $target_path;
				?>
			<br>
				<?php
					echo $message;
				?>
			<br>
				<?php
					echo $error;
				?>
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
