<?php
include ("connect_mysql_database.php");
$gettripid = 1;
//FUNCTION setChk runs a check to see if the post variable is firstly set, and then if it equals 1, if it does, this then updates the database, if the post variable is 0, it sets this in the database.
function setChk($tripid, $ac, $chkbox)
{
	if (isset($_POST[$chkbox]));
	{
		if($_POST[$chkbox] == 1)
		{
			mysql_query("UPDATE trips SET $ac=1 WHERE tripid=$tripid");
		}
		elseif($_POST[$chkbox] == 0)
		{
			mysql_query("UPDATE trips SET $ac=0 WHERE tripid=$tripid");
		}
		else
		{
		//do nothing
		}
	}
}
//call each function for each ac.
setChk($gettripid, "ac1", "chkbox1");
setChk($gettripid, "ac2", "chkbox2");
setChk($gettripid, "ac3", "chkbox3");
setChk($gettripid, "ac4", "chkbox4");
setChk($gettripid, "ac5", "chkbox5");
setChk($gettripid, "ac6", "chkbox6");
setChk($gettripid, "ac7", "chkbox7");
setChk($gettripid, "ac8", "chkbox8");
setChk($gettripid, "ac9", "chkbox9");
setChk($gettripid, "ac10", "chkbox10");
?>