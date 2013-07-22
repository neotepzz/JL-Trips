<?php
include ("not_logged_in_redirect.php");
require("connect_mysql_database.php");
session_start();
if (isset($_GET['deluserid']))
{
	$delid = $_GET['deluserid'];
	$sqldelid = mysql_query("UPDATE `teachers` SET `delete`='1' WHERE `id`='$delid'");
	$message = "<h2>Deleting...</h2>";
	$redirect = "<meta http-equiv='refresh' content='5;url=admin_edit_user.php?delsuc=1'>";
}
else
{
	$delid = 0;
	$message = "<h2>Cannot delete, redirecting you...</h2>";
	$redirect = "<meta http-equiv='refresh' content='5;url=admin_edit_user.php?delsuc=2'>";
};
?>
<html>
<?php echo $redirect; ?>
<body>
<?php echo $message; ?>
</body>
</html>
