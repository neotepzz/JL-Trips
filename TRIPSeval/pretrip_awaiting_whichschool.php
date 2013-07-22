
<?php include ("connect_mysql_database.php"); ?>
<?php
require("connect_mysql_database.php");
session_start();

		$username = $_SESSION['username'];
		$schoolquery = mysql_query("SELECT * FROM `teachers` WHERE `username`='$username'");
		$schoolarray = mysql_fetch_Array($schoolquery);	
		$lgs1 = $schoolarray['LGS'];
		$lhs2 = $schoolarray['LHS'];
		$ffd3 = $schoolarray['FFD'];
		// need an if statement to figure out which one of these is true in each user's case.
		if ($lgs1 == 1)
			{
			$school = 'LGS'; 
			}
		elseif ($lhs2 == 1)
			{
			$school = 'LHS';
			}
		elseif ($ffd3 == 1)
			{
			$school = 'FFD';
			}
		else //if else statement ends on the logic that if it isn't LGS, LHS or FFD it's LESM. 
			{
			$school = 'Error'
			};
// now the school is found out, need to check for trips that are submitted, from that school.
$submitquery = mysql_query("SELECT * FROM `trips` WHERE `pretripsubmitted`='1' AND `$school`='1' AND `pretripaccepted`='0' AND `pretripdenied`='0'") or die (mysql_error());
$submitcount = mysql_num_rows($submitquery);
$trip_list = "";
if($submitcount > 0) {
		while($row = mysql_fetch_array($submitquery)) { // assign the query to the row, fetching the data into an array
			$tripid = $row['tripid']; //assign the tripid column to the $tripid variable, same as the below
			$createdby = $row['createdby'];
			$description = $row['description'];
			$organiser = $row['organiser'];
			$pretripaccepted = $row['pretripaccepted'];
			$pretripdenied = $row['pretripdenied'];
			$pretripsubmitted = $row['pretripsubmitted'];
			$createddate = $row['createddate'];
			$lgs = $row['LGS'];
			$lhs = $row['LHS'];
			$ffd = $row['FFD'];
			$lgsevm = $row['lgsevma'];
			$lhsevm = $row['lhsevma'];
			$ffdevm = $row['ffdevma'];
			$school2 = $school;
			// below checks if the school is lgs/lhs/ffd and if it has been accepted by that school as well, colour shows green, if it's just a school assigned and hasn't been accepted shows red, if the school isn't involved shows grey.
		if ($lgs == 1 && $lgsevm == 1) 
			{$lgscol = "<font color='green'>";}
		else if ($lgs == 1)
			{$lgscol = "<font color='red'>";}
		else
			{$lgscol = "<font color='grey'>";};
		
		if ($lhs == 1 && $lhsevm == 1) 
			{$lhscol = "<font color='green'>";}
		else if ($lhs == 1)
			{$lhscol = "<font color='red'>";}
		else
			{$lhscol = "<font color='grey'>";};
		
		if ($ffd == 1 && $ffdevm == 1) 
			{$ffdcol = "<font color='green'>";}
		else if ($ffd == 1)
			{$ffdcol = "<font color='red'>";}
		else
			{$ffdcol = "<font color='grey'>";};
		

	

		if ($school2 == 'LGS' && $lgsevm == 1) 
			{$lgstick = 1;}
		else {$lgstick = 0;};
		
		if ($school2 == 'LHS' && $lhsevm == 1) 
			{$lhstick = 1;}
		else {$lhstick = 0;};
		
		if ($school2 == 'FFD' && $ffdevm == 1) 
			{$ffdtick = 1;}
		else {$ffdtick = 0;};


	// this displays the accurate school information below in a mini table inside the status column.
			$display = "<table><tr><td class='". $lgscol . "'>G</td></tr><tr><td class='" . $lhscol . "'>H</td></tr><Tr><td class='" . $ffdcol . "'>F</td></tr></td></table>";
			//this if statement decides which links appear - top one is if it is accepted already 
			if ($school2 == 'LGS' && $lgstick == 1 || $school2 == 'LHS' && $lhstick == 1 || $school2 == 'FFD' && $ffdstick == 1) 
			{	//Create a variable for View Link
				$viewlink = "<a href='pretrip_viewtrip.php?viewtripid=$tripid'>View</a>";
	//Create a variable for the Accept Link
				$acceptlink = "Accepted";
	//Create a variable for the Denied Link.
				$deniedlink = "Accepted";
	//Now create the variable that will display the data.} 
				$givetriplist = 1;
			}
			elseif ($lgstick == 0 || $lhstick == 0 || $ffdstick == 0)
			{	$viewlink = "<a href='pretrip_viewtrip.php?viewtripid=$tripid'>View</a>";
	//Create a variable for the Accept Link
				$acceptlink = "<a href='pretrip_accept.php?accepttripid=$tripid'>Accept</a>&nbsp;&nbsp;";
	//Create a variable for the Denied Link.
				$deniedlink = "<a href='pretrip_deniedreason.php?denytripid=$tripid'>Deny</a>";
	//Now create the variable that will display the data.}}
				$givetriplist = 1;
			}
			else
			{
				$viewlink = "Error";
	//Create a variable for the Accept Link
				$acceptlink = "Error";
	//Create a variable for the Denied Link.
				$deniedlink = "Error";
	//Now create the variable that will display the data.}}
				$givetriplist = 1;
			};
			if ($givetriplist == 1)
			{
			$trip_list .= "<tr class='trborder'><td>$tripid</td><td>$createdby</td><td>$description</td><td>$display</td><td>$createddate</td><td>$viewlink</td><td>$acceptlink&nbsp;/&nbsp;$deniedlink</td></tr>";}

}
}
	 else 	{
			$trip_list = '<h2 align="center">There Are No Pre Trips Awaiting Approval</h2>';
	};
?>
