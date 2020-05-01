<?php
session_start();
require_once("../class/users.php");
require_once("../class/dbconfig.php");
require_once("../class/query.php");
header("Content-Type:text/html");
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
    $user = new users();
    $avatar = $user->uploadAvatar();
    $status = $avatar["status"];
    $name = $avatar["name"];
    $location = $avatar["location"];    
    echo $location;
    if ($status) {
    	 $user->updateAvatar($name,$location);
    }
}	
else {
	header("location:../home.php");
}
?>