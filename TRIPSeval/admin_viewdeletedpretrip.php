<?php include("header_template.php"); ?>
<?php 
include ("not_logged_in_redirect.php");
require("connect_mysql_database.php");
session_start();
$pretrip_list = '';
$vallq = mysql_query("SELECT * FROM `trips` WHERE `delete`='1' AND `pretrip`='1'");
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
		//Now create the variable that will display the data.
		$pretrip_list .= "<tr><td>$tripid</td><td>$createdby</td><td>$description</td><td>$organiser</td><td>$pretripaccepted</td><td>$pretripdenied</td><td>$pretripsubmitted</td><td>$createddate</td><td>$organiseremail<td>$LGS</td><td>$LHS</td><td>$FFD</td><td>$LESM</td><td>RESTORE</td></tr>";
}
} else {
		$pretrip_list .= '<h2>Cannot find any trips in the database.</h2>';
}

?>
<body>
<tr>
<td>
<h2>Administrator: View All Deleted & Restore Pre Trips</h2>
<table align="center" border ="1" bordercolor="#0000FF" width="60%"><tr><td>Trip ID</td><td>Created By</td><td>Description</td><td>Organiser</td><td>Pre Trip Accepted</td><td>Pre Trip Denied</td><td>Pre Trip Denied</td><td>Created Date</td><td>Organiser Email<td>LGS</td><td>LHS</td><td>FFD</td><td>LESM</td><td>RESTORE</td></tr>
<?php echo $pretrip_list; ?>
</table>
<table align="center" border ="1" bordercolor="#0000FF" width="60%"><tr><td><b>HELP</b><br>'1' in the column means it's true - '0' in the column is false. If it's true, it holds that value, e.g. a 1 in the EVM column makes the user an EVM. </td></tr></table>
<a href='administratormain.php'>Administrator Main Page</a>
</body>
<?php include("footer_template.php"); ?>