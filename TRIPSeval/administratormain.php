<?php 
include("header_template.php"); 
include("not_logged_in_redirect.php");
?>
<body>
<tr>
<td>
<h2>This is the Administrator's Page for Trips Site</h2>
<h3>User Account Area</h3>
<a href="admin_create_user.php">Create a New User Account</a>
<br>
<br>
<a href="admin_edit_user.php">View User Information & Edit a User Account</a>
<br>
<h3>Pre Trips & Trips Area</h3>
<a href="admin_viewallpretrip.php">View All Pre Trips</a>
<br>
<br>
<a href="admin_viewdeletedpretrip.php">View Deleted & Restore Pre Trips</a>
<br>
<br>
<a href="#">View all Trips</a>
<br/>
<br/>
</td>
</tr>
</body>
<?php include("footer_template.php"); ?>
</html>
