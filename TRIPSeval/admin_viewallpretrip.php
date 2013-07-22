<?php include("header_template.php"); ?>
<?php 
include ("not_logged_in_redirect.php");
require("connect_mysql_database.php");
session_start();
$pretrip_list = '';
$vallq = mysql_query("SELECT * FROM `trips` WHERE `delete`='0' AND `pretrip`='1'");
$vallq2 = mysql_num_rows($vallq); // count the rows from userquery.
if ($vallq2 > 0) {
	while ($row = mysql_fetch_array($vallq)){ // assign the query to the row, fetching the data into an array
		$tripid = $row['tripid']; //assign the id's from the teachers table to a variable as below
		$createdby = $row['createdby'];
		$description = $row['description'];
		$organiser = $row['organiser'];
		$pretripaccepted = $row['pretripaccepted'];
		$pretripdenied = $row['pretripdenied'];
		$pretripsubmitted = $row['pretripsubmitted'];
		$createddate = $row['createddate'];
		$organiseremail = $row['organiseremail'];
		$LGS = $row['LGS'];
		$LHS = $row['LHS'];
		$FFD = $row['FFD'];
		$LESM = $row['LESM'];
		$pretrip = $row['pretrip'];
$pretrip_status= ""; //each of the pretrip states listed below has a 0 or 1 value in the database, the below is a calculation as to which one should be displayed.
			if ($pretripaccepted + $pretripdenied + $pretripsubmitted === 0 && $pretrip == 1) {
					$pretrip_status .="Editing";
			} elseif ($pretripaccepted > $pretripdenied + $pretripsubmitted && $pretrip == 1) {
					$pretrip_status .="Accepted Pre Trip";
			} elseif ($pretripdenied > $pretripaccepted + $pretripsubmitted && $pretrip == 1) {
					$pretrip_status .="Denied Pre Trip";
			} elseif ($pretripsubmitted > $pretripaccepted + $pretripdenied && $pretrip == 1) {
					$pretrip_status .="Awaiting Approval";
			} else  $pretrip_status ="Error"; {
			};
			if ($pretrip_status == "Editing") {//this if statement hides the submit link if the pre-trip is submitted. 
					$submitlink='<a href="#' . $tripid . '">SUBMIT</a>';
			} else {
				$submitlink='Already Submitted';
			};
		//Now create the variable that will display the data.
		$pretrip_list .= "<tr><td>$tripid</td><td>$createdby</td><td>$description</td><td>$organiser</td><td>$pretrip_status</td><td>$createddate</td><td>$organiseremail<td>$LGS</td><td>$LHS</td><td>$FFD</td><td>$LESM</td><td><a href='admin_pretrip_edit.php?edittripid=$tripid'>EDIT</a></td><td>DELETE</td><td>CHANGE STATUS</td></tr>";
}
} else {
		$pretrip_list .= '<h2>Cannot find any trips in the database.</h2>';
}

?>
<body>
<tr>
<td>
<h2>Administrator: View All Pre Trips</h2>
<table align="center" border ="1" bordercolor="#0000FF" width="60%"><tr><td>Trip ID</td><td>Created By</td><td>Description</td><td>Organiser</td><td>Pre Trip Status</td><td>Created Date</td><td>Organiser Email<td>LGS</td><td>LHS</td><td>FFD</td><td>LESM</td><td>EDIT</td><td>DELETE</td><td>CHANGE STATUS</td></tr>
<?php echo $pretrip_list; ?>
</table>
<table align="center" border ="1" bordercolor="#0000FF" width="60%"><tr><td><b>HELP</b><br>'1' in the column means it's true - '0' in the column is false. If it's true, it holds that value, e.g. a 1 in the EVM column makes the user an EVM. </td></tr></table>
<a href='administratormain.php'>Administrator Main Page</a>
</body>
<?php include("footer_template.php"); ?>