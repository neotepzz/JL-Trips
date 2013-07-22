<?php
session_start();
if ($_POST['username']) {
//Connect to the database through our include 
include "connect_mysql_database.php";
$username = $_POST['username']; //set variable username to be the POSTed username
$password = $_POST['password']; //set variable password to be the POSTed password
$username = stripslashes($username); //cleanse username of anything apart from numbers and letters
$password = stripslashes($password);//cleanse password of anything apart from numbers and letters
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);
$sql = mysql_query("SELECT * FROM teachers WHERE username='$username' AND password='$password'");
$login_check = mysql_num_rows($sql); //this creates a variable called login_check, that has had a mysql command to count
// the number of rows that match the sql variable, which is a sql statement above selecting all from the teachers table
// where the username and the password match the variables passed from the POST command on the login_form page.
if($login_check > 0){ // this is the beginning of an if statement, if the login_check variable is greater then 0
	mysql_query("INSERT INTO log (user, logtime, logdesc, logtripid) VALUES ('$username', NOW(), 'Logged In', 0)");
	while ($row = mysql_fetch_array($sql)){ //it will carry out this while statement, creating a new variable called row which stores
	//the array data taken when carrying out the query in the $sql variable.
		// get member ID into a session variable
		$id = $row["id"];
		$_SESSION['id'] = $id;
		//get member username into a session variable
		$username = $row["username"];
		$_SESSION['username'] = $username;
		//Update the last_log_date field for this member
		mysql_query("UPDATE teachers SET lastlogin=NOW() WHERE id='$id'");
		//print success message here if all went well then exit the script
		header("location:index.php?id=$id");
		exit(); // close the while loop
}
} 
else 
{ //closes if and opens else
	// print login failure message to the user and link them back to the login page
	  print '<br /><br />No match in our records, try again </font><br />
<br /><a href="login_form.php">Click here</a> to go back to the login page.';
  exit();
}// closes else
}// close if post
?>