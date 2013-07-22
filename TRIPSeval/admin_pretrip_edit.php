<?php include ("not_logged_in_redirect.php"); ?>
<?php include("header_template.php"); ?>
<?php 
session_start(); //start session first, no need to check if the user is logged in as the redirect has taken care of that.
// first need to assign the passed variable - id, into a local variable from a session.
$userid = $_SESSION['id'];
$username = $_SESSION['username'];
$createdby = $_SESSION['username'];
if (isset($_GET['edittripid'])) {
	$gettripid = ($_GET['edittripid']);
} else {
	$gettripid = "0";	
}
if ($gettripid > 0){
		$sqltripid = mysql_query("SELECT * FROM trips WHERE tripid ='$gettripid'");
		$rowtripid = mysql_fetch_array($sqltripid);
		$organiser = $rowtripid['organiser'];
		$description = $rowtripid['description'];
		$dept = $rowtripid['Department'];
		$yg = $rowtripid['YearGroups'];
		$pn = $rowtripid['ProposedNumbers'];
		$dd = $rowtripid['deptdate'];
		$rd = $rowtripid['retdate'];
		$pl = $rowtripid['ProposedLocation'];
		$cl = $rowtripid['CurriculumValue'];
		$pt = $rowtripid['ProposedTransport'];
		$pm = $rowtripid['PaymentMethod'];
		$cc	= $rowtripid['CoachCompany'];
		$tu = $rowtripid['TravelCompanyUse'];
		$tn = $rowtripid['TravelCompName'];
		$mh = $rowtripid['MrHarker'];
		$cp = $rowtripid['PupilCost'];
		$sa = $rowtripid['StaffAcc'];
} 
else 	{
	$organiser = "0";
	$descrpition = "0";
};
//
// **************************************** Below code is to show the selected drop down box option for Department Select Box (drop down) **********************************
//
$s1 = '';
$s2 = '';
$s3 = '';
$s4 = '';
$s5 = '';
$s6 = '';
$s7 = '';
$s8 = '';
$s9 = '';
$s10 = '';
$s11 = '';
$s12 = '';
$s13 = '';
$s14 = '';
$s15 = '';
$s16 = '';
$s17 = '';
// if statement to set the selected value for the drop down box.
if ($dept == "NA")
{
$s1 = 'selected';
}
else if ($dept == "English & Drama")
{
$s2 = 'selected';
}
else if ($dept == "Maths")
{
$s3 = 'selected';
}
else if ($dept == "Biology")
{
$s4 = 'selected';
}
else if ($dept == "Chemistry")
{
$s5 = 'selected';
}
else if ($dept == "Art & Design")
{
$s6 = 'selected';
}
else if ($dept == "History")
{
$s7 = 'selected';
}
else if ($dept == "MFL")
{
$s8 = 'selected';
}
else if ($dept == "Classics")
{
$s9 = 'selected';
}
else if ($dept == "Politics")
{
$s10 = 'selected';
}
else if ($dept == "Business Studies")
{
$s11 = 'selected';
}
else if ($dept == "CCF")
{
$s12 = 'selected';
}
else if ($dept == "Music")
{
$s13 = 'selected';
}
else if ($dept == "D of E")
{
$s14 = 'selected';
}
else if ($dept == "Economics")
{
$s15 = 'selected';
}
else if ($dept == "Food")
{
$s16 = 'selected';
}
else if ($dept == "Careers")
{
$s17 = 'selected';
}
else 
{
};
//
// **************************************** Below code is to show the selected drop down box option for Main Transport Select Box (drop down) **********************************
//
$mt1 = '';
$mt2 = '';
$mt3 = '';
$mt4 = '';
$mt5 = '';
$mt6 = '';
$mt7 = '';
$mt8 = '';
$mt9 = '';
$mt10 = '';
$mt11 = '';
$mt12 = '';
$mt13 = '';
$mt14 = '';
//  if statement to set the selected value for the drop down box.
if ($pt == "NA")
{
$mt1 = 'selected';
}
else if ($pt == "Underground")
{
$mt2 = 'selected';
}
else if ($pt == "Eurostar")
{
$mt3 = 'selected';
}
else if ($pt == "Aeroplane")
{
$mt4 = 'selected';
}
else if ($pt == "Coach")
{
$mt5 = 'selected';
}
else if ($pt == "Ferry / Hovercraft")
{
$mt6 = 'selected';
}
else if ($pt == "MiniBus")
{
$mt7 = 'selected';
}
else if ($pt == "MiniBusTrailer")
{
$mt8 = 'selected';
}
else if ($pt == "Paris Metro")
{
$mt9 = 'selected';
}
else if ($pt == "Public Transport")
{
$mt10 = 'selected';
}
else if ($pt == "Train")
{
$mt11 = 'selected';
}
else if ($pt == "Walking")
{
$mt12 = 'selected';
}
else if ($pt == "Car")
{
$mt13 = 'selected';
}
else if ($pt == "Pupil")
{
$mt14 = 'selected';
}
else
{
};
//
// **************************************** Below code is to show the selected drop down box option for Payment Method Select Box (drop down) **********************************
//
$pm1 = '';
$pm2 = '';
$pm3 = '';
$pm4 = '';
if ($pm == "NA")
{
$pm1 = 'selected';
}
else if ($pm == "Cheque")
{
$pm2 = 'selected';
}
else if ($pm == "Fee")
{
$pm3 = 'selected';
}
else if ($pm == "Pay on Day")
{
$pm4 = 'selected';
}
else
{
};
//
// **************************************** Below code is to show the selected drop down box option for Coach Company Select Box (drop down) **********************************
//
$cc1 = ""; 
$cc2 = ""; 
$cc3 = ""; 
$cc4 = ""; 
$cc5 = ""; 
$cc6 = ""; 
$cc7 = ""; 
$cc8 = ""; 
$cc9 = ""; 
$cc10 = ""; 
$cc11 = ""; 
if ($cc == "NA")
{
$cc1 = 'selected';
}
else if ($cc == "Ausden Clark")
{
$cc2 = 'selected';
}
else if ($cc == "Crosswells Coaches")
{
$cc3 = 'selected';
}
else if ($cc == "Mac Pherson Coaches Ltd")
{
$cc4 = 'selected';
}
else if ($cc == "Nottingham City Coaches")
{
$cc5 = 'selected';
}
else if ($cc == "Paul S Winson")
{
$cc6 = 'selected';
}
else if ($cc == "Roberts Coaches")
{
$cc7 = 'selected';
}
else if ($cc == "Veolia Transport")
{
$cc8 = 'selected';
}
else if ($cc == "Lester Coaches")
{
$cc9 = 'selected';
}
else if ($cc == "Other")
{
$cc10 = 'selected';
}
else if ($cc == "Approved Supplier")
{
$cc11 = 'selected';
}
else
{
};
//
// **************************************** Below code is to show the selected drop down box option for Travel Company Select Box (drop down) **********************************
//
$tu1 = '';
$tu2 = '';
if ($tu == "No")
{
$tu1 = 'selected';
}
else if ($tu == "Yes")
{
$tu2 = 'selected';
}
else
{
};
//
// **************************************** Below code is to show the selected drop down box option for Mr Harker Select Box (drop down) **********************************
//
$mh1 = '';
$mh2 = '';
if ($mh == "No")
{
$mh1 = 'selected';
}
else if ($mh == "Yes")
{
$mh2 = 'selected';
}
else
{
};
?>
<body>
<tr>
<td>
<h2>Edit Pre Trip</h2>
<form action="pretrip_update.php?edittripid=<?php echo $gettripid; ?>" method="post">
<table width="60%" border="1" bordercolor="#666666" align="center">
<tr>
<td align="center">
Trip Description
</td>
<td align="center">
<input type="text" name="description" value="<?php echo $description; ?>">
</td>
</tr>
<tr>
<td align="center">
Trip ID
</td>
<td align="center">
<?php echo $gettripid; ?>
</td>
</tr>
<tr>
<td align="center">
Full Name of Trip Organiser 
</td>
<td align="center">
<input type="text" name="organiser" value="<?php echo $organiser; ?>">
</td>
</tr>
<tr>
<td align="center">
Department
</td>
<td align="center">
<select name="department">
<option value ="NA" <?php echo $s1; ?>>N/A</option>
<option value ="English & Drama" <?php echo $s2; ?>>English & Drama</option>
<option value ="Maths" <?php echo $s3; ?>>Maths</option>
<option value ="Biology" <?php echo $s4; ?>>Biology</option>
<option value ="Chemistry" <?php echo $s5; ?>>Chemistry</option>
<option value ="Art & Design" <?php echo $s6; ?>>Art & Design</option>
<option value ="History" <?php echo $s7; ?>>History</option>
<option value ="MFL" <?php echo $s8; ?>>Modern Foreign Languages</option>
<option value ="Classics" <?php echo $s9; ?>>Classics</option>
<option value ="Politics" <?php echo $s10; ?>>Politics</option>
<option value ="Business Studies" <?php echo $s11; ?>>Business Studies</option>
<option value ="CCF" <?php echo $s12; ?>>CCF</option>
<option value ="Music" <?php echo $s13; ?>>Music</option>
<option value ="D of E" <?php echo $s14; ?>>D of E</option>
<option value ="Economics" <?php echo $s15; ?>>Economics</option>
<option value ="Food" <?php echo $s16; ?>>Food</option>
<option value ="Careers" <?php echo $s17; ?>>Careers</option>
</select>
</td>
</tr>
<tr>
<td align="center">
Year Group/s
</td>
<td align="center">
<input type="text" name="YearGroup" value="<?php echo $yg; ?>">
</td>
</tr>
<tr>
<td align="center">
Proposed Numbers
</td>
<td align="center">
<input type="number" name="ProNumbers" value="<?php echo $pn; ?>">
</td>
</tr>
<tr>
<td align="center">
Departure Date & Time
</td>
<td align="center">
<input type="datetime" name="departuredate" value="<?php echo $dd;?>">
</td>
</tr>
<tr>
<td align="center">
Return Date & Time
</td>
<td align="center">
<input type="datetime" name="returndate" value="<?php echo $rd;?>">
</td>
</tr>
<tr>
<td align="center">
Proposed Location
</td>
<td align="center">
<input type="text" name="ProLocation" value="<?php echo $pl; ?>">
</td>
</tr>
<tr>
<td align="center">
Curriculum Link & Value (Up to 1000 Characters)
</td>
<td align="center">
<input type="text" name="CurriLink" value="<?php echo $cl; ?>">
</td>
</tr>
<tr>
<td align="center">
Main Method of Transportation
</td>
<td align="center">
<select name="MainTransport">
<option value ="NA" <?php echo $mt1; ?>>N/A</option>
<option value ="Underground" <?php echo $mt2; ?>>Underground</option>
<option value ="Eurostar" <?php echo $mt3; ?>>Eurostar</option>
<option value ="Aeroplane" <?php echo $mt4; ?>>Aeroplane</option>
<option value ="Coach" <?php echo $mt5; ?>>Coach</option>
<option value ="Ferry / Hovercraft" <?php echo $mt6; ?>>Ferry / Hovercraft</option>
<option value ="MiniBus" <?php echo $mt7; ?>>MiniBus</option>
<option value ="MiniBusTrailer" <?php echo $mt8; ?>>MiniBus + Trailer</option>
<option value ="Paris Metro" <?php echo $mt9; ?>>Paris Metro</option>
<option value ="Public Transport" <?php echo $mt10; ?>>Public Transport</option>
<option value ="Train" <?php echo $mt11; ?>>Train</option>
<option value ="Walking" <?php echo $mt12; ?>>Walking</option>
<option value ="Car" <?php echo $mt13; ?>>Car</option>
<option value ="Pupil" <?php echo $mt14; ?>>Pupil Making Own Way</option>
</select>
</td>
</tr>
<tr>
<td align="center">
Payment Method
</td>
<td align="center">
<select name="Paymentmethod">
<option value ="NA" <?php echo $pm1; ?>>N/A</option>
<option value ="Cheque" <?php echo $pm2; ?>>Cheque</option>
<option value ="Fee" <?php echo $pm3; ?>>Fee, subject to accountants prior approval</option>
<option value ="Pay on Day" <?php echo $pm4; ?>>Pay on Day</option>
</select>
</td>
</tr>
<tr>
<td align="center">
Name of Coach Company
</td>
<td align="center">
<select name="CoachCompany">
<option value ="NA" <?php echo $cc1; ?>>N/A</option>
<option value ="Ausden Clark" <?php echo $cc2; ?>>Ausden Clark</option>
<option value ="Crosswells Coaches" <?php echo $cc3; ?>>Crosswells Coaches</option>
<option value ="Mac Pherson Coaches Ltd" <?php echo $cc4; ?>>Mac Pherson Coaches Ltd</option>
<option value ="Nottingham City Coaches" <?php echo $cc5; ?>>Nottingham City Coaches</option>
<option value ="Paul S Winson" <?php echo $cc6; ?>>Paul S Winson</option>
<option value ="Roberts Coaches" <?php echo $cc7; ?>>Roberts Coaches</option>
<option value ="Veolia Transport" <?php echo $cc8; ?>>Veolia Transport</option>
<option value ="Lester Coaches" <?php echo $cc9; ?>>Lester Coaches</option>
<option value ="Other" <?php echo $cc10; ?>>Other</option>
<option value ="Approved Supplier" <?php echo $cc11; ?>>Travel Company Approved Supplier</option>
</select>
</td>
</tr>
<tr>
<td align="center">
Travel Company
</td>
<td align="center">
<select name="TravelCompanyYN">
<option value ="No" <?php echo $tu1; ?>>No</option>
<option value="Yes" <?php echo $tu2; ?>>Yes</option>
</select>
</td>
</tr>
<tr>
<td align="center">
Travel Company Name
</td>
<td align="center">
<input type="text" name="TravelCompanyName" value="<?php echo $tn; ?>">
</td>
</tr>
<tr>
<td align="center">
Have you sent Mr Harker a copy of your trip costings?
</td>
<td align="center">
<select name="MrHarker">
<option value ="No" <?php echo $mh1; ?>>No</option>
<option value="Yes" <?php echo $mh2; ?>>Yes</option>
</select>
</td>
</tr>
<tr>
<td align="center">
Cost to Pupil of Trip
</td>
<td align="center">
<input type="text" name="PupilCost" value="<?php echo $cp; ?>">
</td>
</tr>
<tr>
<td align="center">
Staff Accompanying
</td>
<td align="center">
<input type="text" name="StaffAcc" value="<?php echo $sa; ?>">
</td>
</tr>
<tr>
<td align="center" colspan="2">
<input type="submit" Value="Save & Exit">
</td>
</tr>
</table>
</form>
</body>
<?php include("footer_template.php"); ?>