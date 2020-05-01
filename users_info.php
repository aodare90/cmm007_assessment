<?php
require_once("functions/sessions.php");
$pageTitle = "Profile";
require_once("class/functions.php");
if (!(isset($_GET['mp']) &&  $_GET['mp']!='')) {
    header("location:login.php");
}
$mp = trim($_GET['mp']);
$mp = explode('-', $mp);
$usersid = $mp[1];
$code1 = $mp[0];
$code2 = $mp[2];
$user = new users();
$userInfo = (object) $user->getUserById($usersid);
$userPhoto = $userInfo->photo;
if ($userPhoto!='') {
    $userPhoto = 'assets/img/avatars/'.$userInfo->photo;
}else{
    $userPhoto = 'assets/img/avatars/avatar.png';
}
require_once("header.php");
$myUserId = $_SESSION['myUserId'];
?>
<br/><br/>
<div class="container">
    <div class="row">
        <div class="col-sm-3" style="text-align:center;border-radius:15px;">
            <img src="<?php echo $userPhoto; ?>" id="userphoto" class="img-circle" width=150px" height='150px' hspace="2px" align="center;" ><br/>
        </div>
        <div class="col-sm-9" >
            <div class="row">
                <div class="col-xs-12">
                    <div>
                        <h3 style="font-weight: bold"><?php echo $userInfo->firstname.' '.$userInfo->lastname; ?></h3><br><h3><i class='fa fa-envelope-o'></i> Contact Email</h3><hr>
                        <?php echo nl2br($userInfo->email); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require_once("footer.php");
?>
<script type="text/javascript" src="js/avatar.js"></script>