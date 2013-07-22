<?php 
 include ("connect_mysql_database.php");
		$username = $_SESSION['username'];
		$trip_list=""; //need to create the trip_list variable first and tell it it's empty to initialise it.

//this below gets the school from the user.
$q2 = mysql_query("SELECT * FROM `teachers` WHERE `username`='$username'");
while ($row2 = mysql_fetch_array($q2))
			{
			$lgs = $row2['LGS'];
			$lhs = $row2['LHS'];
			$ffd = $row2['FFD'];
			}
			//below statement checks for the school!
			if ($lgs == 1)
				{
				$school = 'LGS'; 
				}
			else if ($lhs == 1)
				{
				$school = 'LHS';
				}
			else if ($ffd == 1)
				{
				$school = 'FFD';
				}
			else
				{
				$school = 'ERROR';
				};

// this below shows the list of trips fully approved from the school the person is logging on from. Only the EVM, Deputy + Head
$query2 = mysql_query("SELECT * FROM `trips` WHERE `$school`='1' AND `tripfinalised`='1'");  //query the entire trips table for all data from all rows + columns NEEDS CHANGING TO SPECIFIC
$query3 = mysql_num_rows($query2); // count the rows from query 2.

if ($query3 > 0) {
	while ($row = mysql_fetch_array($query2)){ // assign the query to the row, fetching the data into an array
		$tripid = $row['tripid']; //assign the tripid column to the $tripid variable, same as the below
		$createdby = $row['createdby'];
		$description = $row['description'];
		$organiser = $row['organiser'];
		$tripfinalised = $row['tripfinalised'];
		$lgs = $row['LGS'];
		$lhs = $row['LHS'];
		$ffd = $row['FFD'];
		$lgsevm = $row['lgsheada'];
		$lhsevm = $row['lhsheada'];
		$ffdevm = $row['ffdheada'];
		//
		//this section will now decide the colour of each of the icons displayed below
		//
		if ($lgs == 1 && $lgsevm == 1) 
			{$lgscol = "green";}
		else if ($lgs == 1)
			{$lgscol = "red";}
		else
			{$lgscol = "grey";};
		
		if ($lhs == 1 && $lhsevm == 1) 
			{$lhscol = "green";}
		else if ($lhs == 1)
			{$lhscol = "red";}
		else
			{$lhscol = "grey";};
		
		if ($ffd == 1 && $ffdevm == 1) 
			{$ffdcol = "green";}
		else if ($ffd == 1)
			{$ffdcol = "red";}
		else
			{$ffdcol = "grey";};


		$trip_status= ""; //each of the pretrip states listed below has a 0 or 1 value in the database, the below is a calculation as to which one should be displayed.
			if ($tripfinalised == 1) {
					$trip_status ="Approved";
			} else  $trip_status ="Contact NSC"; {
			};
			if ($trip_status == "Approved") // if it is awaiting approval it 
			{
					$display = "<table><tr><td class='". $lgscol . "'>G</td></tr><tr><td class='" . $lhscol . "'>H</td></tr><tr><td class='" . $ffdcol . "'>F</td></tr></td></table>";
					$viewlink= "<a href=''>View</a>";
			}
			else
			{	
				$display = "Error";
				$submitlink='Error';
				$editlink='Error';
				$dellink='Error';
			};
		$createddate = $row['createddate'];
//Now create the variable that will display the data.
		$trip_list .= "<tr class='trborder'><td>$description</td><td>$display</td><td>$createddate</td><td>$viewlink</td></tr>";
}
} else {
		$trip_list = "<h2>There are no approved trips for $school </h2>";
};
?>