<?php
$myPhoto = "";
if ($_SESSION["myPhoto"]!="") {
    $myPhoto = $_SESSION["myPhoto"];
}
else {
    $myPhoto = "assets/img/avatars/avatar.png";
}
$myPhoto = "assets/img/avatars/".$myPhoto;
?>