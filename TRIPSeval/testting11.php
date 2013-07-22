
<html>
<head>
	<script type="text/javascript" src="javascript/jquery.js"></script>
	<script type="text/javascript" src="javascript/jquery.blockui.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
		$('#loadingDiv').hide()
		var edittripid = $('#tripid').val();
			//originalval is the value of each dropdown box as it loads.
			var originalval1 = $('#ac1dd :selected').val();
			var originalval2 = $('#ac2dd :selected').val();
			var originalval3 = $('#ac3dd :selected').val();
			var originalval4 = $('#ac4dd :selected').val();
			var originalval5 = $('#ac5dd :selected').val();
			//this is the on change event 			
		$("#ac1dd").change( function() {
			if ($("#ac1dd :selected").val() == $("#ac2dd :selected").val())
			else alert ("ELSE!");
		});
			

		
// on click of ac1 drop down button, update the database with the selection, and also send data to testing3.php to load a new risk list depending on the selection.
	$(document).on('click', '#ac1button', function() {
	var testvalue = $('#ac1dd').val();
	var ac1 = $('#ac1id').val();
	// ajax requests to load the page
			$.ajax({
			type: "POST",
			url: "testing2.php",
			cache: false,
			data: { testvalue: testvalue, edittripid: edittripid, ac1: ac1 },
			beforeSend: function() {
					$.blockUI({ message: '<h1><img src="images/ajax-loader.gif" /> Updating...</h1>' }); 
					setTimeout($.unblockUI, 2000);
				}
			}).done(function( response ) {

			$('#div-ac1-dd').html(response);
				$.ajax({
				type: "POST",
				url: "testing3.php",
				cache: false,
				data: { testvalue: testvalue, ac1: ac1 },
				}).done(function( response ) {
				$('#div-ac1holder').html(response);
				});
			});
	}); 
	$(document).on('click', '#ac2button', function() {
			var testvalue2 = $('#ac2dd').val();
			var ac2 = $('#ac2id').val();
			$.ajax({
			type: "POST",
			url: "testing2.php",
			cache: false,
			data: { testvalue2: testvalue2, edittripid: edittripid, ac2: ac2 },
			beforeSend: function() {
					$.blockUI({ message: '<h1><img src="images/ajax-loader.gif" /> Updating...</h1>' }); 
					setTimeout($.unblockUI, 2000);
				}
			}).done(function( response ) {

			$('#div-ac2-dd').html(response);
				$.ajax({
				type: "POST",
				url: "testing3.php",
				cache: false,
				data: { testvalue2: testvalue2, ac2: ac2 },
				}).done(function( response ) {
				$('#div-ac2holder').html(response);
				});
			});
	}); 
		$(document).on('click', '#ac3button', function() {
			var testvalue3 = $('#ac3dd').val();
			var ac3 = $('#ac3id').val();
			$.ajax({
			type: "POST",
			url: "testing2.php",
			cache: false,
			data: { testvalue3: testvalue3, edittripid: edittripid, ac3: ac3 },
			beforeSend: function() {
					$.blockUI({ message: '<h1><img src="images/ajax-loader.gif" /> Updating...</h1>' }); 
					setTimeout($.unblockUI, 2000);
				}
			}).done(function( response ) {

			$('#div-ac3-dd').html(response);
				$.ajax({
				type: "POST",
				url: "testing3.php",
				cache: false,
				data: { testvalue3: testvalue3, ac3: ac3 },
				}).done(function( response ) {
				$('#div-ac3holder').html(response);
				});
			});
	}); 
		$(document).on('click', '#ac4button', function() {
			var testvalue4 = $('#ac4dd').val();
			var ac4 = $('#ac4id').val();
			$.ajax({
			type: "POST",
			url: "testing2.php",
			cache: false,
			data: { testvalue4: testvalue4, edittripid: edittripid, ac4: ac4 },
			beforeSend: function() {
					$.blockUI({ message: '<h1><img src="images/ajax-loader.gif" /> Updating...</h1>' }); 
					setTimeout($.unblockUI, 2000);
				}
			}).done(function( response ) {

			$('#div-ac4-dd').html(response);
				$.ajax({
				type: "POST",
				url: "testing3.php",
				cache: false,
				data: { testvalue4: testvalue4, ac4: ac4 },
				}).done(function( response ) {
				$('#div-ac4holder').html(response);
				});
			});
	}); 
		$(document).on('click', '#ac5button', function() {
			var testvalue5 = $('#ac5dd').val();
			var ac5 = $('#ac5id').val();
			$.ajax({
			type: "POST",
			url: "testing2.php",
			cache: false,
			data: { testvalue5: testvalue5, edittripid: edittripid, ac5: ac5 },
			beforeSend: function() {
					$.blockUI({ message: '<h1><img src="images/ajax-loader.gif" /> Updating...</h1>' }); 
					setTimeout($.unblockUI, 2000);
				}
			}).done(function( response ) {

			$('#div-ac5-dd').html(response);
				$.ajax({
				type: "POST",
				url: "testing3.php",
				cache: false,
				data: { testvalue5: testvalue5, ac5: ac5 },
				}).done(function( response ) {
				$('#div-ac5holder').html(response);
				});
			});
	}); 
});
	</script>
</head>
<body>

<?php
include("connect_mysql_database.php");
include ("includes/functions.php");
$gettripid = 1;
//section1
$choice1 = "ac1";
$activityname1 = aCheck($gettripid, $choice1);
$activity_array = aGetActivityList();
if (multi_in_array($activityname1, $activity_array, 'activitytype'))
{
		$activityid1 = aGetID($activityname1);
		aDD ($activityid1, $gettripid, $choice1);
		aRiskList ($activityid1, $choice1);
}
else
{
		$aDDefault ($gettripid, $choice1);
}
//section2
$choice2 = "ac2";
$activityname2 = aCheck($gettripid, $choice2);
$activitynamelist2 = aGetActivityList();
if (multi_in_array($activityname2, $activity_array, 'activitytype'))
{
		$activityid2 = aGetID($activityname2);
		aDD ($activityid2, $gettripid, $choice2);
		aRiskList ($activityid2, $choice2);
}
else
{
		aDDefault ($gettripid, $choice2);
}
//section3
$choice3 = "ac3";
$activityname3 = aCheck($gettripid, $choice3);
$activitynamelist3 = aGetActivityList();
if (multi_in_array($activityname3, $activity_array, 'activitytype'))
{
		$activityid3 = aGetID($activityname3);
		aDD ($activityid3, $gettripid, $choice3);
		aRiskList ($activityid3, $choice3);
}
else
{
		aDDefault ($gettripid, $choice3);
}
//section4
$choice4 = "ac4";
$activityname4 = aCheck($gettripid, $choice4);
$activitynamelist4 = aGetActivityList();
if (multi_in_array($activityname4, $activity_array, 'activitytype'))
{
		$activityid4 = aGetID($activityname4);
		aDD ($activityid4, $gettripid, $choice4);
		aRiskList ($activityid4, $choice4);
}
else
{
		aDDefault ($gettripid, $choice4);
}
//section5
$choice5 = "ac5";
$activityname5 = aCheck($gettripid, $choice5);
$activitynamelist5 = aGetActivityList();
if (multi_in_array($activityname5, $activity_array, 'activitytype'))
{
		$activityid5 = aGetID($activityname5);
		aDD ($activityid5, $gettripid, $choice5);
		aRiskList ($activityid5, $choice5);
}
else
{
		aDDefault ($gettripid, $choice5);
}
?>
</body>
</html>