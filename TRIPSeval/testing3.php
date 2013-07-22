
<?php 
include_once("connect_mysql_database.php");
include("includes/functions.php");
$choice = "";
$choice2 = "";
$activityid1 = "";
$activityid2 = "";

if (isset($_POST['testvalue']))
	{

		if (isset($_POST['ac1']))
			{
				$activityid1 = $_POST['testvalue'];
				$choice1 = $_POST['ac1'];
				aRiskList($activityid1, $choice1);
			}
		else
			{
			};

	}
else
		{
		};
		
if (isset($_POST['testvalue2']))
	{
		
		if (isset($_POST['ac2']))
			{
				$activityid2 = $_POST['testvalue2'];
				$choice2 = $_POST['ac2'];
				aRiskList($activityid2, $choice2);
			}
		else
			{
			};

	}
if (isset($_POST['testvalue3']))
	{
		
		if (isset($_POST['ac3']))
			{
				$activityid3 = $_POST['testvalue3'];
				$choice3 = $_POST['ac3'];
				aRiskList($activityid3, $choice3);
			}
		else
			{
			};

	}
if (isset($_POST['testvalue4']))
	{
		
		if (isset($_POST['ac4']))
			{
				$activityid4 = $_POST['testvalue4'];
				$choice4 = $_POST['ac4'];
				aRiskList($activityid4, $choice4);
			}
		else
			{
			};

	}
if (isset($_POST['testvalue5']))
	{
		
		if (isset($_POST['ac5']))
			{
				$activityid5 = $_POST['testvalue5'];
				$choice5 = $_POST['ac5'];
				aRiskList($activityid5, $choice5);
			}
		else
			{
			};

	}

?>