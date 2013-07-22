
<?php 
require("connect_mysql_database.php");
session_start();

// ****************************** START OF USERNAME ************************************
//first thing is to check if the username box has been filled in at all and then 
//goes to check if the username is already used
$newusername = '';
$testusername = $_POST['username1'];
if (empty($testusername))
{
	$newusername = 2;
}
else
{
	$checkusername = $_POST['username1'];
	$checkquery = mysql_query("SELECT * FROM teachers WHERE username='$checkusername'") or die ('Unable to run query on mysql query for select checkquery:'.mysql_error()); 
			if (mysql_num_rows($checkquery))
			//checking the number of rows to perform an if statement
			//this is the check to see if the username is already used
			{
			$newusername = 1;
			}
			else
			{
			$newusername = 0;
			};
	
};
//newusername = 0 is ok, name is entered and is unique.
//newusername = 1 is wrong, means the name has been entered but isn't unique.
//newusername = 2 is wrong, means the username field has no value.
//************************************* END OF USERNAME ********************************
//
//
//************************************ START OF PASSWORD *******************************
$newpassword = '';
if (isset($_POST['password1']) && $_POST['password1'] !== NULL) 
{
	$newpassword = 0;
	$checkpassword = $_POST['password1'];
}
else
{
	$newpassword = 1;
};
//newpassword = 0 is ok, password is entered.
//newpassword = 1 is wrong, nothing was entered into the password field.
//********************************* END OF PASSWORD ************************************
//
//
//********************************* START OF EMAIL *************************************
$newemail = '';
$testemail = $_POST['email1'];
if (empty($testemail))
{
	$newemail = 0;
}
else
{
 $newemail = 1;
};
//********************************* END OF EMAIL ***************************************
//
//
//***************************** START OF LEVEL OF ACCESS *******************************
if (isset($_POST['chkEVM']))
{
$chkevm = $_POST['chkEVM'];
}
else
{
$chkevm = 0;
};
// chkevm = 1 means that the user DID tick the checkbox.
// chkevm = 0 means that the user DID NOT tick the checkbox.
if (isset($_POST['chkDEPUTY']))
{
$chkdeputy = $_POST['chkDEPUTY'];
}
else
{
$chkdeputy = 0;
};
// chkdeputy = 1 means that the user DID tick the checkbox.
// chkdeputy = 0 means that the user DID NOT tick the checkbox.
if (isset($_POST['chkHEAD']))
{
$chkhead = $_POST['chkHEAD'];
}
else
{
$chkhead = 0;
};
// chkhead = 1 means that the user DID tick the checkbox.
// chkhead = 0 means that the user DID NOT tick the checkbox.
if (isset($_POST['chkADMIN']))
{
$chkadmin = $_POST['chkADMIN'];
}
else
{
$chkadmin = 0;
};
// chkadmin = 1 means that the user DID tick the checkbox.
// chkadmin = 0 means that the user DID NOT tick the checkbox.
//******************************* END OF LEVEL OF ACCESS *******************************
//
//
// ****************************** START OF SCHOOL **************************************
if (isset($_POST['chkFFD']))
{
$chkffd = $_POST['chkFFD'];
}
else
{
$chkffd = 0;
};
// chkffd = 1 means that the user DID tick the checkbox.
// chkffd = 0 means that the user DID NOT tick the checkbox.
if (isset($_POST['chkLGS']))
{
$chklgs = $_POST['chkLGS'];
}
else
{
$chklgs = 0;
};
// chklgs = 1 means that the user DID tick the checkbox.
// chklgs = 0 means that the user DID NOT tick the checkbox.
if (isset($_POST['chkLHS']))
{
$chklhs = $_POST['chkLHS'];
}
else
{
$chklhs = 0;
};	
// chklhs = 1 means that the user DID tick the checkbox.
// chklhs = 0 means that the user DID NOT tick the checkbox.
if (isset($_POST['chkLESM']))
{
$chklesm = $_POST['chkLESM'];
}
else
{
$chklesm = 0;
};
// chklesm = 1 means that the user DID tick the checkbox.
// chklesm = 0 means that the user DID NOT tick the checkbox.
// ****************************** END OF SCHOOL ****************************************
//
//
// ******************* CODE TO FIGURE OUT IF IT CAN GO INTO THE DATABASE ***************
// Need to create a if, else if statement to produce a result that can either be sent back to 
// the admin_create_user page for the user to put the correct information into and notify the user or 
// it needs to update the database with a new user.
//
//
// if statement below is used to find the school to make the if statement below shorter.
// each if statement checks if one of the chkboxes is selected, and as it now has the value of 1
// is it higher then any of the other chkboxes (if selected they have a value of 1), if they haven't been selected
// they will retain a value of 0, and the variable will be higher, meaning we've checked for 
// if it's selected and if it's selected on its own.
//
//intialise variable
$schoolselect = '';
//
if ($chkffd == 1 && $chklgs == 0 && $chklhs == 0 && $chklesm == 0)
{
$schoolselect = '0';
}
else if ($chklgs == 1 && $chkffd == 0 && $chklhs == 0 && $chklesm == 0)
{
$schoolselect = '1';
}
else if ($chklhs == 1 && $chkffd == 0 && $chklgs == 0 && $chklesm == 0)
{
$schoolselect = '2';
}
else if ($chklesm == 1 && $chkffd == 0 && $chklhs == 0 && $chklgs == 0)
{
$schoolselect = '3';
}
else if ($chkffd == 0 && $chklesm == 0 && $chklgs == 0 && $chklhs == 0)
{
$schoolselect = '4';
}
else
{
$schoolselect = '5';
};
// schoolselect = '0' means school selected is ffd
// schoolselect = '1' means school selected is lgs
// schoolselect = '2' means school selected is lhs
// schoolselect = '3' means school selected is lesm
// schoolselect = '4' means school selected is none and therefore unchecked
// schoolselect = '5' means multiple values selected
//if statement below does the same as above except for the access rights.
//intialise variable
$rightselect = '';
//
if ($chkevm == 1 && $chkdeputy == 0 && $chkadmin == 0 && $chkhead == 0)
{
$rightselect = '0';
}
else if ($chkdeputy == 1 && $chkevm == 0 && $chkadmin == 0 && $chkhead == 0)
{
$rightselect = '1';
}
else if ($chkadmin == 1 && $chkdeputy == 0 && $chkevm == 0 && $chkhead == 0)
{
$rightselect = '2';
}
else if ($chkhead == 1 && $chkdeputy == 0 && $chkadmin == 0 && $chkevm == 0)
{
$rightselect = '3';
}
else if ($chkhead == 0 && $chkevm == 0 && $chkdeputy == 0 && $chkhead == 0)
{
$rightselect = '4';
}
else
{
$rightselect = '5';
};
// rightselect = '0' means right selected is evm
// rightselect = '1' means right selected is deputy
// rightselect = '2' means right selected is admin
// rightselect = '3' means right selected is head
// rightselect = '4' means right selected is none and therefore unchecked
// rightselect = '5' means multiple values selected
if ($newusername == 2 && $newpassword == 1 && $rightselect == 4 && $schoolselect == 4)
{
$updateadmin = '0'; 
}
else if ($newusername == 2 || $newusername == 1)
{
$updateadmin = '1';
}
else if ($newusername == 0 && $newpassword == 1 && ($rightselect == 1 || $rightselect == 2 || $rightselect == 3 || $rightselect == 4 || $rightselect == 5) && ($schoolselect == 1 || $schoolselect == 2 || $schoolselect == 3 || $schoolselect == 4 || $schoolselect == 5))
{
$updateadmin = '2';
}
else if ($newusername == 0 && $newpassword == 0 && $rightselect == 4 && $schoolselect == 4)
{
$updateadmin = '3';
}
else if ($newusername == 0 && $newpassword == 0 && $rightselect == 5 && $schoolselect == 5)
{
$updateadmin = '4'; 
}
else if ($newusername == 0 && $newpassword == 0 && $rightselect == 4 && $schoolselect == 5)
{
$updateadmin = '5'; 
}
else if ($newusername == 0 && $newpassword == 0 && $rightselect == 5 && $schoolselect == 4)
{
$updateadmin = '6'; 
}
else if ($newusername == 1) 
{
$updateadmin = '8';
}
else if ($newemail == 0)
{
$updadteadmin = '9';
}
else
{
$updateadmin = '7';
};
//updateadmin = '0' means that no options were selected when submit was pressed.
//updateadmin = '1' means username missing or wrong.
//updateadmin = '2' means username is correct and unique, no password has been entered, any of the boxes might have been ticked.
//updateadmin = '3' means username is correct and unique, a password has been entered, however no checkboxes selected.
//updateadmin = '4' means username is correct and unique, a password has been entered, however too many selected.
//updateadmin = '5' means username is correct and unique, a password has been enterd, however rights has had nothing selected and schools has had too many selected.
//updateadmin = '6' means username is correct and unique, a password has been entered, however school has nothing selected and rights has too many selected. 
//updateadmin = '7' means everything is as it should be.
//updateadmdin = '8' means username isn't unique, the rest doesn't matter, cancels.
//updateadmdin = '9' means email isn't unique. 
// *************** END OF CODE TO FIGURE OUT IF IT CAN GO INTO THE DATABASE ************
//
//
// ***************************** START OF CODE TO REDIRECT OR SAVE ******************************
//
$createuserlink ='';
$refreshlink ='';
if ($updateadmin == 7)
{
	$un = mysql_real_escape_string($_POST['username1']);
	$pw = mysql_real_escape_string($_POST['password1']);
	$chke = mysql_real_escape_string($chkevm);
	$chkd = mysql_real_escape_string($chkdeputy);
	$chkh = mysql_real_escape_string($chkhead);
	$chklg = mysql_real_escape_string($chklgs);
	$chklh = mysql_real_escape_string($chklhs);
	$chkf = mysql_real_escape_string($chkffd);
	$chkle = mysql_real_escape_string($chklesm);
	$chka = mysql_real_escape_string($chkadmin);
	$email = mysql_real_escape_string($_POST['email1']);
	mysql_query("INSERT INTO `teachers` (username, password, EVM, Deputy, Head, LGS, LHS, FFD, LESM, admin, Email)
	VALUES ('$un', '$pw', '$chke', '$chkd', '$chkh', '$chklg', '$chklh', '$chkf', '$chkle', '$chka', '$email')");
	mysql_close();
	$createuserlink .= "<h2> Creating New User - username: $un , password: $pw</h2>";
	$refreshlink .= "<meta http-equiv='refresh' content='5;url=admin_create_user.php?updateadmin=$updateadmin'>";
}
else
{
$createuserlink .= "<h2> Redirecting you back to the create user page... </h2>";
$refreshlink .= "<meta http-equiv='refresh' content='5;url=admin_create_user.php?updateadmin=$updateadmin'>";

};
?>
<?php echo $refreshlink; ?>
<html>
<body>
<?php echo $createuserlink; ?>
</body>
</html>
