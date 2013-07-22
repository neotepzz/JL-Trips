<?php 
 include ("connect_mysql_database.php");
		$username = $_SESSION['username'];
		$trip_list=""; //need to create the trip_list variable first and tell it it's empty to initialise it.
$query2 = mysql_query("SELECT * FROM `trips` WHERE `createdby`='$username' AND `trip`='1' AND `delete`='0' AND `tripfinalised`='0'");  //query the entire trips table for all data from all rows + columns NEEDS CHANGING TO SPECIFIC
$query3 = mysql_num_rows($query2); // count the rows from query 2.

if ($query3 > 0) {
	while ($row = mysql_fetch_array($query2)){ // assign the query to the row, fetching the data into an array
		$tripid = $row['tripid']; //assign the tripid column to the $tripid variable, same as the below
		$createdby = $row['createdby'];
		$description = $row['description'];
		$organiser = $row['organiser'];
		$tripaccepted = $row['tripaccepted'];
		$tripdenied = $row['tripdenied'];
		$tripsubmitted = $row['tripsubmitted'];
		$tripfinalised = $row['tripfinalised'];
		$lgs = $row['LGS'];
		$lhs = $row['LHS'];
		$ffd = $row['FFD'];
		$deniedreason = $row['DeniedReason'];
	}

		//
		//this section will now decide the colour of each of the icons displayed below
		//


		$pretrip_status= ""; //each of the trip states listed below has a 0 or 1 value in the database, the below is a calculation as to which one should be displayed.
			if ($tripaccepted==0 && $tripdenied==0 && $tripsubmitted==0) {
					$pretrip_status ="Editing";
			} elseif ($tripaccepted==1 && $tripdenied==0 && $tripsubmitted==0 && $tripfinalised==0) {
					$pretrip_status ="Awaiting Final Approval";
			} elseif ($tripdenied==1 && $tripaccepted==0 && $tripsubmitted==0) {//NOW REDUNDANT AS DENIED TRIPS JUST GO BACK TO THE EDITING STAGE - LEFT IN INCASE THIS CHANGES
					$pretrip_status ="Denied Trip";
			} elseif ($tripsubmitted == 1 && $tripaccepted == 0 && $tripdenied == 0) {
					$pretrip_status ="Awaiting Approval";
			} else  $pretrip_status ="Contact NSC"; {
			};
			$deniedreasonlink = "";
			if ($pretrip_status == "Editing") //this if statement hides the submit link if the pre-trip is submitted. 
			{
					$display = "";
					$submitlink='<a href="trip_submit.php?submittripid=' . $tripid . '">Submit</a>';
					$editlink='<a href="trip_editpage1.php?edittripid=' . $tripid . '">Edit</a>';
					$dellink='<a href="trip_delete.php?deletetripid=' . $tripid . '">Delete</a>';
					$status = $pretrip_status;
			}		
			elseif ($pretrip_status == "Awaiting Approval") // if it is awaiting approval it 
			{
				$q2 = mysql_query("SELECT * FROM `trips` WHERE `createdby`='$username' AND `trip`='1' AND `delete`='0'");  //query the entire trips table for all data from all rows + columns NEEDS CHANGING TO SPECIFIC
				$q3 = mysql_num_rows($q2); // count the rows from query 2.
				if ($q3 > 0) {
				while ($row = mysql_fetch_array($q2)){ // assign the query to the row, fetching the data into an array
					$lgsevm = $row['lgsdepa'];
					$lhsevm = $row['lhsdepa'];
					$ffdevm = $row['ffddepa'];
				}
			}
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
					$display = "<table><tr><td class='". $lgscol . "'>G</td></tr><tr><td class='" . $lhscol . "'>H</td></tr><Tr><td class='" . $ffdcol . "'>F</td></tr></td></table>";
					$submitlink='Already Submitted';
					$editlink='Cannot Edit - Awaiting Approval';
					$dellink='Cannot Delete - Awaiting Approval';
					$status = $pretrip_status;
			}
				elseif ($pretrip_status == "Awaiting Final Approval") // if it is awaiting approval it 
			{
				$q4 = mysql_query("SELECT * FROM `trips` WHERE `createdby`='$username' AND `trip`='1' AND `delete`='0'");  //query the entire trips table for all data from all rows + columns NEEDS CHANGING TO SPECIFIC
				$q5 = mysql_num_rows($q4); // count the rows from query 2.
				if ($q5 > 0) {
				while ($row = mysql_fetch_array($q4)){ // assign the query to the row, fetching the data into an array
					$lgsevm = $row['lgsheada'];
					$lhsevm = $row['lhsheada'];
					$ffdevm = $row['ffdheada'];
				}
			}
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
					$display = "<table><tr><td class='". $lgscol . "'>G</td></tr><tr><td class='" . $lhscol . "'>H</td></tr><Tr><td class='" . $ffdcol . "'>F</td></tr></td></table>";
					$submitlink='Already Submitted';
					$editlink='Cannot Edit - Awaiting Approval';
					$dellink='Cannot Delete - Awaiting Approval';
					$status = $pretrip_status;
			}		
			elseif ($pretrip_status == "Denied Trip") //this will display if the trip has been denied and show a reason for the denial 
			{	
					$display = "Denied - Re-Editing";
					$submitlink='<a href="trip_submit.php?submittripid=' . $tripid . '">Submit</a>';
					$editlink='<a href="trip_editpage1.php?edittripid=' . $tripid . '">Edit</a>';
					$dellink='<a href="trip_delete.php?deletetripid=' . $tripid . '">Delete</a>';
					$deniedreasonlink = $deniedreason;
					$deniedtd = '<td>';
					$deniedtdexit = '</td>';
			}
			else
			{	
				$display = "Error";
				$submitlink='Error';
				$editlink='Error';
				$dellink='Error';
				$status = 'Error';
			};
		$createddate = $row['createddate'];
//Now create the variable that will display the data.
		$trip_list .= "<tr class='trborder'><td>$description</td>$deniedtd$deniedreasonlink$deniedtdexit<td>$display</td><Td>$status</td><td>$createddate</td><td>$editlink</td><td>$dellink</td><td>$submitlink</td></tr>";

} else {
		$trip_list = '<h2>You Have Saved No Trips</h2>';
};
?>