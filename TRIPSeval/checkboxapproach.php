<html>
<head>
	<script type="text/javascript" src="javascript/jquery.js"></script>
	<script type="text/javascript" src="javascript/jquery.blockui.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#loadingDiv').hide()
			var edittripid = $('#tripid').val();
				// on click of ac1 drop down button, update the database with the selection, and also send data to testing3.php to load a new risk list depending on the selection.
				$(document).on('click', '#button', function() {
					if ($('#chkbox1').prop('checked')) var chkbox1 = 1;
					else var chkbox1 = 0;
					if ($('#chkbox2').prop('checked')) var chkbox2 = 1;
					else var chkbox2 = 0; 
					if ($('#chkbox3').prop('checked')) var chkbox3 = 1;
					else var chkbox3 = 0; 
					if ($('#chkbox4').prop('checked')) var chkbox4 = 1;
					else var chkbox4 = 0; 
					if ($('#chkbox5').prop('checked')) var chkbox5 = 1;
					else var chkbox5 = 0; 
					if ($('#chkbox6').prop('checked')) var chkbox6 = 1;
					else var chkbox6 = 0; 
					if ($('#chkbox7').prop('checked')) var chkbox7 = 1;
					else var chkbox7 = 0; 
					if ($('#chkbox8').prop('checked')) var chkbox8 = 1;
					else var chkbox8 = 0; 
					if ($('#chkbox9').prop('checked')) var chkbox9 = 1;
					else var chkbox9 = 0;
					if ($('#chkbox10').prop('checked')) var chkbox10 = 1;
					else var chkbox10 = 0; 					
					// ajax requests to load the page
							$.ajax({
							type: "POST",
							url: "trip_activity_chkbox_save.php",
							cache: false,
							data: { chkbox1: chkbox1, chkbox2: chkbox2, chkbox3: chkbox3, chkbox4: chkbox4, chkbox5: chkbox5,  chkbox6: chkbox6,  chkbox7: chkbox7, chkbox8: chkbox8,  chkbox9: chkbox9,  chkbox10: chkbox10, edittripid: edittripid },
							beforeSend: function() {
									$.blockUI({ message: '<h1><img src="images/ajax-loader.gif" /> Updating...</h1>' }); 
									setTimeout($.unblockUI, 2000);
								}
							})
				});
});				
	</script>
</head>
<body>
<?php
include ("connect_mysql_database.php");
$gettripid = 1;

		// call on mysql to select all fields from activity table
		$sql = mysql_query("SELECT * FROM activity");
		// use a while statement to fill an array so I can use a for each statement
		while ($row[] = mysql_fetch_assoc($sql));
		//pop the last part of the array as it always adds one too many
		array_pop($row);
		//call on mysql to select all fields from trips
		$sql1 = mysql_query("SELECT * FROM trips WHERE `tripid`=$gettripid");
		while ($row1[] = mysql_fetch_assoc($sql1));
		array_pop($row1);
	?>
		<div id="div-chkbox">
		<input type="hidden" id="tripid" value="<?php echo $gettripid; ?>">
	<?php 
	// declare counter outside of foreach.
		$i = 1;
	//foreach loop
		foreach ($row as $r)
		{ 
	?>
		<label for="chkbox<?php echo $r['activityid']; ?>">
		<?php echo $r['activitytype']; ?>
		</label>
		<?php $boom = "ac" . $i;?>
		<input type='checkbox' id='chkbox<?php echo $r['activityid']; ?>' name='chkbox<?php echo $r['activityid']; ?>' value='<?php echo $r['activityid']?>' <?php if ($row1[0][$boom] == 1) {echo "checked";} else {echo $row1[0][$boom];} ?> >
	<?php
		$i++;
		};
	?>
		<input type="button" id="button" value="Update" />
		</div>
	<?php

	?>
</body>