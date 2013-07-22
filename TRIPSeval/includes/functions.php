<?php
include_once("connect_mysql_database.php");
//FUNCTION activityDDSave is designed to save the choice, to the tripid into the database, trips table. 
//choice options are ac1, 2choice, 3choice, 4choice, 5choice
//activityid is provided from the database, trips table in ac1 if selected, if not, default value is NULL.
//tripid is provided from the page, posted as edittripid, put into a variable of $gettripid.
function aDDSave($activityid, $tripid, $choice)
	{
	// first get all entries from the activity table that match the specified activityid
	$sql2 = mysql_query("SELECT * FROM activity where activityid=$activityid");
	// put the array of results into the row2. 
	while ($row2[] = mysql_fetch_assoc($sql2));
	// remove extra array as it places itself forward once.
	array_pop($row2);
	//place into activitytype.
	$r2holder = $row2[0]['activitytype'];
	//now update the database with the new activity 1st choice.
	mysql_query("UPDATE `trips` SET `$choice`='$r2holder' WHERE `tripid`=$tripid");
	};
//FUNCTION activityDD is designed to create a dropdown menu based on the choice the person is making.
// choice options are ac1, 2choice, 3choice, 4choice, 5choice	
//activityid is provided from the database, trips table in ac1 if selected, if not, default value is NULL.
//tripid is provided from the page, posted as edittripid, put into a variable of $gettripid.
function aDD($activityid, $tripid, $choice)
	{
	// call on mysql to select all fields from activity table
	$sql = mysql_query("SELECT * FROM activity");
	// use a while statement to fill an array so I can use a for each statement
	while ($row[] = mysql_fetch_assoc($sql));
	//pop the last part of the array as it always adds one too many
	array_pop($row);
	//call on mysql to select all fields from trips
	$sql1 = mysql_query("SELECT $choice FROM trips WHERE `tripid`=$tripid");
	while ($row1[] = mysql_fetch_assoc($sql1));
	array_pop($row1);
	// gets value from row 1, $choice into a variable for use in a comparison.
	$boom = $row1[0][$choice];
	//NEED TO FIGURE OUT HOW TO CHECK IT AGAINST OTHER VALUES
	
	//echo $boom;
	//below is the array filled select option.
	//create an array to check choice against
	?>
	<div id="div-<?php echo $choice; ?>-dd-holder">
	<div id="div-<?php echo $choice; ?>-dd">
	<input type="hidden" id="<?php echo $choice; ?>id" value="<?php echo $choice; ?>">
	<input type="hidden" id="tripid" value="<?php echo $tripid; ?>">
	<select name="<?php echo $choice; ?>dd" id="<?php echo $choice; ?>dd">
	<option value="0">Select an Activity Type:</option>
	<?php 
	foreach ($row as $r)
	{ ?>
	<option value="<?php echo $r['activityid'];?>" <?php if ($activityid == $r['activityid']) {echo "selected='selected'";} else {}; ?>><?php echo $r['activitytype'];?></option>
	<?php
	};
	?>
	</select><input type="button" id="<?php echo $choice; ?>button" value="Update" />
	</div>
	</div>
	<?php
	};
	?>
	<?php
//FUNCTION activityCheck is designed to use the tripid and the choice variable to find which activity has been saved to the trips (choice activity) column.
function aCheck($tripid, $choice)
	{
		$sql = mysql_query("SELECT $choice FROM `trips` WHERE `tripid`=$tripid");
		while ($row[] = mysql_fetch_assoc($sql));
		$retval = $row[0][$choice];
		return $retval;
	};
//FUNCTION activityGetID is designed to get the ID of the trips 1st choice, which is taken from the activityCheck function.
function aGetID ($atype)
	{
		$sql = mysql_query("SELECT activityid FROM activity WHERE activitytype='$atype'");
		while ($row[] = mysql_fetch_assoc($sql));
		$retval = $row[0]['activityid'];
		return $retval;
	};
//FUNCTION aRiskList will list the risks associated with the activityid selected by the user.
function aRiskList($activityid, $choice)
			{
$sql = mysql_query("SELECT * FROM activity_risk WHERE activityid=$activityid");
while ($row[] = mysql_fetch_assoc($sql));
array_pop($row);
$actcnt = mysql_num_rows($sql);
$sql1 = mysql_query("SELECT * FROM activity WHERE activityid=$activityid");
while ($row1[] = mysql_fetch_assoc($sql1));
array_pop($row1);
$actnme = $row1[0]['activitytype'];
?>
<div id="div-<?php echo $choice;?>holder">
<div id="div-<?php echo $choice; ?>">
<input type="hidden" id="activity_risk_count" value="<?php echo $actcnt; ?>">
<input type="hidden" id="activity_name" value="<?php echo $actnme; ?>">
<input type="hidden" id="activity_id" value="<?php echo $activityid; ?>">
<?php
for ($i = 0; $i < $actcnt; $i++)
{
if(isset($row[$i])) 
{
$strtoarray = $row[$i]['risk'];
$holder = "$strtoarray - Control Measure:<input type='text' id='$choice$i'><br />";
echo $holder;
}
else
{
echo "no array for $i";
};
};
?>
<input type="button" id="<?php echo $choice; ?>-update" value="Save" />
</div>
</div>
<?php
}; 
// FUNCTION aGetCountActivity is designed to fetch all entries in the activities table and count them.
function aGetCountActivity()
{
	$sql = mysql_query("SELECT * FROM activity");
	while ($row[] = mysql_fetch_assoc($sql));
	array_pop($row);
	$i = 0;
	foreach ($row as $r)
		{
			$i = $i++;
		}
	return $i;
};
//FUNCTION aGetActivityList gets all entries in the activities list and put them into an array, which can be returned and used to run checks against using function multi_in_array
function aGetActivityList()
{
	$sql = mysql_query("SELECT * FROM activity");
	while ($row[] = mysql_fetch_assoc($sql));
	array_pop($row);
	return $row;
}
//FUNCTION multi_in_array SEARCHES FOR A VALUE OF A KEY WITHIN A MULTIDIMENSIONAL ARRAY, AND IS EITHER TRUE OR FALSE (can be used directly in an IF statemnet).
function multi_in_array($needle, $haystack, $key) {
    foreach ($haystack as $h) {
        if (array_key_exists($key, $h) && $h[$key]==$needle) {
            return true;
        }
    }
    return false;
}
//FUNCTION aDDDefault
function aDDefault($tripid, $choice)
	{
	// call on mysql to select all fields from activity table
	$sql = mysql_query("SELECT * FROM activity");
	// use a while statement to fill an array so I can use a for each statement
	while ($row[] = mysql_fetch_assoc($sql));
	//pop the last part of the array as it always adds one too many
	array_pop($row);
	//call on mysql to select all fields from trips
	$sql1 = mysql_query("SELECT $choice FROM trips WHERE `tripid`=$tripid");
	while ($row1[] = mysql_fetch_assoc($sql1));
	array_pop($row1);
	// gets value from row 1, $choice into a variable for use in a comparison.
	$boom = $row1[0][$choice];
	//echo $boom;
	//below is the array filled select option.
	?>
	<div id="div-<?php echo $choice; ?>-dd-holder">
	<div id="div-<?php echo $choice; ?>-dd">
	<input type="hidden" id="<?php echo $choice; ?>id" value="<?php echo $choice; ?>">
	<input type="hidden" id="tripid" value="<?php echo $tripid; ?>">
	<select name="<?php echo $choice; ?>dd" id="<?php echo $choice; ?>dd">
	<option value="0">Select an Activity Type:</option>
	<?php 
	foreach ($row as $r)
	{ ?>
	<option value="<?php echo $r['activityid'];?>"><?php echo $r['activitytype'];?></option>
	<?php
	};
	?>
	</select><input type="button" id="<?php echo $choice; ?>button" value="Update" />
	</div>
	</div>
	<div id="div-<?php echo $choice;?>holder">
<div id="div-<?php echo $choice; ?>">
<input type="hidden" id="activity_risk_count" value="0">
<input type="hidden" id="activity_name" value="0">
<input type="hidden" id="activity_id" value="0">
</div>
</div>
	<?php
	};
	?>