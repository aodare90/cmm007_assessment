<?php
if (session_start()!=1) {
	session_start();
}
if (!isset($_SESSION['memberLogin']) && ($_SESSION['memberLogin']!='assessment2019')) {
	header("location:login.php");
}
?>