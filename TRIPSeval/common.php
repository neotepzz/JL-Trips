<?php
// ************************** START OF A SESSION SECTION ****************************
include "connect_mysql_database.php";
//REMOVED SESSION START FROM HERE.
// first need to assign the passed variable - id, into a local variable from a session.
$cuserid = $_SESSION['id'];
$cusername = $_SESSION['username'];
$ccreatedby = $_SESSION['username'];
global $cuserid, $cusername, $ccreatedby;

// ************************** END OF SESSION SECTION ********************************

// ******************* START ADMINISTRATOR SECTION **********************************

//Check to see if the user is an administrator and then inserts a link if they are.
if (isset($_SESSION['username']))
{
	$adminuserid1 = $_SESSION['id'];
	$adminusername1 = $_SESSION['username'];
	$adminquery = mysql_query("SELECT * FROM `teachers` WHERE `username`='$adminusername1' AND `Admin`='1'");
	$adminquery2 = mysql_num_rows($adminquery); //checking the number of rows to perform an if statement		
	global $adminquery;
	global $adminquery2;
	global $adminuserid1;
	global $adminusername1;
	
}
else 
{
//user session hasn't started so ignore and produce nothing
};
	
// ********************* END OF ADMINISTRATOR SECTION *******************************

?>