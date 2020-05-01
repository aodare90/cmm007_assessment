<?php
require_once("functions/sessions.php");
$pageTitle = "Edit Profile";
require_once("header.php");
require_once("class/functions.php");

$msg =  "";
$status = "";
$color = "";
$icon = "";

if (isset($_POST['submitForm'])) {
    $usersid = $_SESSION["myUserId"];
    $firstname = sanitize::clean($_POST['firstname']);
    $lastname = sanitize::clean($_POST['lastname']);
    $aboutme = sanitize::clean($_POST['aboutme']);

    if ($firstname!="" || $lastname!="") {
        $dataArray = array("usersid"=>$usersid,"firstname"=>$firstname,"lastname"=>$lastname,"aboutme"=>$aboutme);
        $user = new users();
        $result = $user->updateProfile($dataArray);
        $status = $result["status"];
        $msg = $result["message"];
    }
    else {
        $status = "error";
        $msg = "First Name and Last Name are mandatory!";
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
    <form name="update_profile" action="editProfile.php" method="POST">
        <div class="row">
            <div class="col-sm-3" style="text-align:center;border-radius:15px;"><br><br><br>
                <img src="<?php echo $myPhoto; ?>" id="userphoto" class="img-circle" width=150px" hspace="2px" align="center;"><br>
                <label for="file">
                    <input type="file" name="file" id="file" style="display:none;"/><br>
                    <div class="btn btn-primary" ><i class="fa fa-camera"></i> Change Photo</div>
                </label>
            </div>
            <div class="col-sm-9" >
                <div class="row">
                    <div class="col-sm-12 profileTitle" >
                        Edit Your Details
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
                <div class="row">
                    <div for="First Name" class="col-sm-2 profiledetails" style="background-color:#f1f1f1;">
                        <strong>First Name</strong>
                    </div>
                    <div class="col-sm-6 profiledetails-control">
                        <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $_SESSION['myFirstname']; ?>"<br>
                    </div>
                </div>
                <div class="row">
                    <div for="Last Name" class="col-sm-2 profiledetails" style="background-color:#f1f1f1;">
                        <strong>Last Name</strong>
                    </div>
                    <div class="col-sm-6 profiledetails-control">
                        <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $_SESSION['myLastname']; ?>"<br>
                    </div>
                </div>
                <div class="row">
                    <div for="Email" class="col-sm-2 profiledetails" style="background-color:#f1f1f1;">
                        <strong>Email</strong>
                    </div>
                    <div class="col-sm-6 profiledetails-control" >
                        <input type="text" readonly class="form-control" id="email" name="email" value="<?php echo $_SESSION['myEmail']; ?>" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2 profiledetails"style="background-color:#f1f1f1;" >
                        <strong>About Me</strong>
                    </div>
                    <div class="col-sm-6 profiledetails-control" >
                        <textarea class="form-control" rows="5" id="aboutme" name="aboutme"><?php echo $_SESSION['myAboutme'];  ?></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-right"><button type="submit" class="btn btn-primary editProfileBtn" role="button" name="submitForm"><i class="fa fa-database"></i> Update Profile</button> <a onclick="location.href='profile.php'" class="btn btn-warning editProfileBtn" role="button"><i class="fa fa-remove"></i> Cancel</a></div>
                </div>
            </div>
        </div>
    </form>
</div>
<?php
require_once("footer.php");
?>
<script type="text/javascript" src="js/avatar.js"></script>