<?php
require ("connect_mysql_database.php");
$q=$_GET["q"];
$sql = mysql_query("SELECT * FROM `activity_risk` WHERE `activityid` = '".$q."'");
/** while($row = mysql_fetch_array($sql))
  {
	//this while statement will aim to display all the risks involved with an activity, naming it so that we can POST the values for pickup later.
	//count number of rows in the array
	echo "<tr>";
	echo "<th>Risk</th>";
	echo "<td>" . $row['risk'] . "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<th>Control Measure</th>";
	echo "<td><input type='text' name='control$row[riskid]'.' id='control$row[riskid]'.' value='Enter your control measure here...'</td>";
	echo "</tr>";
  }

  echo "</table>"; **/
 while($row = mysql_fetch_array($sql))
 {
?>
<html>
<head>
</head>
<body>
<table>
<tr>
<th>Risk</th>
<td><?php echo $row['risk']; ?></td>
</tr>
<tr>
<th>Control Measure</th>
<td><input type='text' name='1control<?php echo $row[riskid];?>' value='Enter your control measure here...'></td>
</tr>
</table>
<?php } ?>
</body>
</html>



