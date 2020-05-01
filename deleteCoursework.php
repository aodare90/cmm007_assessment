<?php
require_once("class/functions.php");
if (!isset($_GET['id']) || $_GET['id']=='') {
	header("location:viewCourseworks.php");
}
$coursewrkid = $_GET['id'];
$coursework = new coursework();
$coursework->deleteCoursework($coursewrkid);
header("location:viewCourseworks.php");
?>
