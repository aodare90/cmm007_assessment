<?php
require_once("functions/sessions.php");
$pageTitle = "Change Password";
require_once("header.php");
require_once("class/functions.php");
$msg =  "";
$status = "";
$color = "";
$icon = "";
if (isset($_POST['submitForm'])) {
    $memberid = $_SESSION["myUserId"];
    $current_password = sanitize::clean($_POST['current_password']);
    $new_password = sanitize::clean($_POST['new_password']);
    $confirm_password = sanitize::clean($_POST['confirm_password']);

    if ($current_password!="" && $new_password!="" && $confirm_password!='') {
        $lenthOfNewPassword = strlen($new_password);
        if ($lenthOfNewPassword<6) {
            $status = "error";
            $msg = "Password must be six characters or more!";
        }
        else {
            if ($new_password==$confirm_password) {
                $user = new users();
                $result = $user->changePassword($memberid,$current_password,$new_password);
                $status = $result["status"];
                $msg = $result["msg"];
            }else{
                $status = "error";
                $msg = "The passwords do not match!";
            }
        }
    }
    else
    {
        $status = "error";
        $msg = "Please fill in all fields!";
    }
}
?>
<style>
    .profileTitle {
        border-bottom: 5px solid #f1f1f1; !important;
        margin-top: 5px; !important;
        margin-bottom: 7px; !important;
        font-family: "Poppins", Arial, sans-serif; !important;
        font-size: 28px; !important;
    }
    .editProfileBtn {
        font-size: initial !important;
    }
    .profiledetails-control {
        margin-top: 10px; !important;
        margin-bottom: 10px; !important;
        padding: 5px; !important;
        vertical-align: middle; !important;
    }
    .profiledetails {
        margin-top: 10px; !important;
        margin-bottom: 10px; !important;
        padding: 12px; !important;
        vertical-align: middle; !important;
    }
</style>
<div class="container">
    <form name="change_password" action="change_password.php" method="POST">
        <div class="row">
            <div class="col-sm-3" style="text-align:center;border-radius:15px;"><br><br><br>
            </div>
            <div class="col-sm-9" >
                <div class="row">
                    <div class="col-sm-12 profileTitle" >
                        Change Password
                    </div>
                </div>
                <?php
                if (isset($_POST['submitForm'])) {
                    if ($status=="error") {
                        $color= "color:red";
                        $icon = "<i class='fa fa-warning' aria-hidden='true'></i>";
                    }
                    elseif($status=="success") {
                        $color= "color:green";
                        $icon = "<i class='fa fa-check' aria-hidden='true'></i>";
                    }
                    ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <?php echo "<div style='".$color."'>".$icon."&nbsp;&nbsp;".$msg."</div>"; ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div class="row"><br>
                    <div for="Current Password" class="col-sm-2 profiledetails" style="background-color:#f1f1f1;">
                        <strong>Current Password</strong>
                    </div>
                    <div class="col-sm-6 profiledetails-control" >
                        <input type="password" class="form-control" id="current_password" name="current_password" required><br>
                    </div>
                </div>
                <div class="row">
                    <div for ="New_password" class="col-sm-2 profiledetails" style="background-color:#f1f1f1;">
                        <strong>New Password</strong>
                    </div>
                    <div class="col-sm-6 profiledetails-control"  >
                        <input type="password" class="form-control" id="new_password" name="new_password"><br>
                    </div>
                </div>
                <div class="row">
                    <div for="email" class="col-sm-2 profiledetails" style="background-color:#f1f1f1;">
                        <strong>Confirm Password</strong>
                    </div>
                    <div class="col-sm-6 profiledetails-control" >
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password"><br><br>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 text-right"><button type="submit" class="btn btn-primary editProfileBtn" role="button" name="submitForm"><i class="fa fa-database"></i> Update Password</button> <a onclick="location.href='profile.php'" class="btn btn-warning editProfileBtn" role="button"><i class="fa fa-remove"></i> Cancel</a></div>
        </div>
    </form>
</div>
<?php
require_once("footer.php");
?>
<script type="text/javascript" src="js/avatar.js"></script>