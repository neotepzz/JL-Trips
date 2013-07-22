<?php 
include_once("connect_mysql_database.php");
include("includes/functions.php");
$gettripid = $_POST['edittripid'];
// NOW USE THE ABOVE FUNCTION TO SAVE
if (isset($_POST['testvalue']))
	{
		if (isset($_POST['ac1']))
			{
				$tv = $_POST['testvalue'];
				$ac1 = $_POST['ac1'];
				aDDSave($tv, $gettripid, $ac1);
				aDD($tv, $gettripid, $ac1);
			}
}
if (isset($_POST['testvalue2']))
	{
		if (isset($_POST['ac2']))
			{
				$tv = $_POST['testvalue2'];
				$ac2 = $_POST['ac2'];
				aDDSave($tv, $gettripid, $ac2);
				aDD($tv, $gettripid, $ac2);
			}
}
if (isset($_POST['testvalue3']))
	{
		if (isset($_POST['ac3']))
			{
				$tv = $_POST['testvalue3'];
				$ac3 = $_POST['ac3'];
				aDDSave($tv, $gettripid, $ac3);
				aDD($tv, $gettripid, $ac3);
			}
}
if (isset($_POST['testvalue4']))
	{
		if (isset($_POST['ac4']))
			{
				$tv = $_POST['testvalue4'];
				$ac4 = $_POST['ac4'];
				aDDSave($tv, $gettripid, $ac4);
				aDD($tv, $gettripid, $ac4);
			}
}
if (isset($_POST['testvalue5']))
	{
		if (isset($_POST['ac5']))
			{
				$tv = $_POST['testvalue5'];
				$ac5 = $_POST['ac5'];
				aDDSave($tv, $gettripid, $ac5);
				aDD($tv, $gettripid, $ac5);
			}
}

?>