<?php 
session_start(); // Must start session first thing
if (isset($_SESSION['id'])) {
} else {
	header("Location: please_log_in.php");
	exit;
}

?>
