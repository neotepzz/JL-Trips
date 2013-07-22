<?php
//this page is designed to take the posted variables and return a html table of the selected activities risks, making sure that there are no duplicate risks.
include ("connect_mysql_database.php");
$gettripid = 1;

if (isset($_POST['chkbox1'])) //checks to make sure the variable is set.
	{
		if($_POST['chkbox1'] == 1) //checks to make sure the variable is the value we expect to make it display the list (1).
			{
				$sql = mysql_query("SELECT DISTINCT risk FROM `activity_risk` WHERE activityid=1");
			}
	}
//PLAN ON HOW TO MAKE THIS WORK, MAKE A FUNCTION FOR EACH IF STATEMENT THAT UPDATES AN ARRAY, THEN RUN AN IF STATEMENT WITHIN A FOR OR FOREACH STATEMENT THAT WILL ECHO DISTINCT RISKS FROM EACH ACTIVITY ID.
//ARRAY WILL BE e.g. ARRAY = Array ( activityid => $i (have this increase on a counter) and selected => 1 ) if it isn't set to 1 on the post value for the chkbox it stays as 0. foreach concentrates on if there 
// is a 0 or a 1. populates table accordingly.
while ($row[] = mysql_fetch_assoc($sql));
array_pop($row);
//beginning the table for the results.
	echo "<fieldset>";
	echo "<legend>Control Measures for Risks</legend>";
foreach ($row as $r)
	{
		echo $r['risk'] . "<span><input type='text' placeholder='Enter control measure here...'></span><br />";
	}
		echo "<input type='button' value='Save Controls'>";
		echo "</fieldset>";
?>