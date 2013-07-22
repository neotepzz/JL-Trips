<?php require ("connect_mysql_database.php"); ?>
<?php
session_start();
if (isset($_GET['edittripid'])){
	$sqltripid = mysql_real_escape_string($_GET['edittripid']);
	$description = mysql_real_escape_string($_POST['description']);
	$organiser = mysql_real_escape_string($_POST['organiser']);
	$dept = mysql_real_escape_string($_POST['department']);
	$yg = mysql_real_escape_string($_POST['YearGroup']);
	$pn = mysql_real_escape_string($_POST['ProNumbers']);
	$dd = mysql_real_escape_string($_POST['departuredate']);
	$rd = mysql_real_escape_string($_POST['returndate']);
	$pl = mysql_real_escape_string($_POST['ProLocation']);
	$cl = mysql_real_escape_string($_POST['CurriLink']);
	$pt = mysql_real_escape_string($_POST['MainTransport']);
	$pm = mysql_real_escape_string($_POST['Paymentmethod']);
	$cc	= mysql_real_escape_string($_POST['CoachCompany']);
	$tu = mysql_real_escape_string($_POST['TravelCompanyYN']);
	$tn = mysql_real_escape_string($_POST['TravelCompanyName']);
	$mh = mysql_real_escape_string($_POST['MrHarker']);
    $cp = mysql_real_escape_string($_POST['PupilCost']);
	$sa = mysql_real_escape_string($_POST['StaffAcc']);
	echo '<h1>Saving Your Edited Pre Trip Data...</h1>';
	mysql_query("UPDATE trips SET description='$description', organiser='$organiser', Department='$dept', YearGroups='$yg', ProposedNumbers='$pn', deptdate='$dd', retdate='$rd', ProposedLocation='$pl', CurriculumValue='$cl', ProposedTransport='$pt', PaymentMethod='$pm', CoachCompany='$cc', TravelCompanyUse='$tu', TravelCompName='$tn', MrHarker='$mh', PupilCost='$cp', StaffAcc='$sa' WHERE tripid = '$sqltripid'") or die (mysql_error());

} elseif (isset($_GET['createpretriptripid'])){
	$sqltripid = mysql_real_escape_string($_GET['createpretriptripid']);
	$description = mysql_real_escape_string($_POST['description']);
	$organiser = mysql_real_escape_string($_POST['organiser']);
	$dept = mysql_real_escape_string($_POST['department']);
	$yg = mysql_real_escape_string($_POST['YearGroup']);
	$pn = mysql_real_escape_string($_POST['ProNumbers']);
	$dd = mysql_real_escape_string($_POST['departuredate']);
	$rd = mysql_real_escape_string($_POST['returndate']);
	$pl = mysql_real_escape_string($_POST['ProLocation']);
	$cl = mysql_real_escape_string($_POST['CurriLink']);
	$pt = mysql_real_escape_string($_POST['MainTransport']);
	$pm = mysql_real_escape_string($_POST['Paymentmethod']);
	$cc	= mysql_real_escape_string($_POST['CoachCompany']);
	$tu = mysql_real_escape_string($_POST['TravelCompanyYN']);
	$tn = mysql_real_escape_string($_POST['TravelCompanyName']);
	$mh = mysql_real_escape_string($_POST['MrHarker']);
    $cp = mysql_real_escape_string($_POST['PupilCost']);
	$sa = mysql_real_escape_string($_POST['StaffAcc']);
	include ("pretrip_createddatecalc.php"); 
	echo '<h1>Saving Your New Pre Trip Data...</h1>';
	mysql_query("UPDATE trips SET description='$description', organiser='$organiser', createddate='$createddate', Department='$dept', YearGroups='$yg', ProposedNumbers='$pn', deptdate='$dd', retdate='$rd', ProposedLocation='$pl', CurriculumValue='$cl', ProposedTransport='$pt', PaymentMethod='$pm', CoachCompany='$cc', TravelCompanyUse='$tu', TravelCompName='$tn', MrHarker='$mh', PupilCost='$cp', StaffAcc='$sa'  WHERE tripid = '$sqltripid'") or die (mysql_error());
} else {
	echo '<h1>Could Not Save Your Pre Trip Data... </h1>';
}


?>


<meta http-equiv="refresh" content="5;url=admin_viewallpretrip.php">
<html>
<body>

</body>
</html>