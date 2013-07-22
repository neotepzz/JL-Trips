<?php
include_once ("connect_mysql_database.php");
$res = mysql_query("SELECT * FROM trips");
$result = array();
while ($row = mysql_fetch_array($res))
{
 array_push($result, array('1st' => $row[0],
			                          '2nd'  => $row[1],
										'3rd' => $row[2]));
										};
echo json_encode(array("result" => $result));
?>
