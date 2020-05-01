<?php
require_once("functions/sessions.php");
$pageTitle = "" . $_SESSION['myFirstname'] . ' ' . $_SESSION['myLastname'] . ".'s Profile";
require_once("class/functions.php");
require_once("header.php");
?>
<style>
    .profileTitle {
        border-bottom: 5px solid #f1f1f1; !important;
        margin-top: 5px; !important;
        margin-bottom: 7px; !important;
        font-family: "Poppins", Arial, sans-serif; !important;
        font-size: 28px; !important;
    }
    .profiledetails {
        margin-top: 10px; !important;
        margin-bottom: 10px; !important;
        padding: 12px; !important;
        vertical-align: middle; !important;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-sm-12 text-right"><button onclick="window.location.href='editprofile.php'" class="btn btn-primary editProfileBtn" role="button" border="0" ><i class="fa fa-edit"></i> Edit Profile</div>
    </div>
    <div class="row">
        <div class="col-sm-3" style="text-align:center;border-radius:15px;"><br><br><br>
            <img src="<?php echo $myPhoto; ?>" id="userphoto" class="img-circle" width="150px" height="150px" hspace="2px" align="center;"><br><br>
            <label for="file">
                <input type="file" name="file" id="file" style="display:none;"/>
                <div class="btn btn-primary" ><i class="fa fa-camera"></i> Change Photo</div>
            </label>
        </div>
        <div class="col-sm-9" >
            <div class="row">
                <div class="col-sm-12 profileTitle">
                    Account Information
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2 profiledetails" style="background-color:#f1f1f1;">
                    <strong>First Name</strong>
                </div>
                <div class="col-sm-6 profiledetails" >
                    <?php echo $_SESSION['myFirstname']; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2 profiledetails" style="background-color:#f1f1f1;">
                    <strong>Last Name</strong>
                </div>
                <div class="col-sm-6 profiledetails">
                    <?php echo $_SESSION['myLastname']; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2 profiledetails" style="background-color:#f1f1f1;">
                    <strong>Email</strong>
                </div>
                <div class="col-sm-6 profiledetails" >
                    <?php echo $_SESSION['myEmail']; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2 profiledetails"style="background-color:#f1f1f1;" >
                    <strong>About Me</strong>
                </div>
                <div class="col-sm-6 profiledetails" >
                    <?php echo $_SESSION['myAboutme']; ?>
                </div>
            </div>
            <br/><br/>
        </div>
    </div>
    <div class="row">
    </div>
</div>
<?php
require_once("footer.php");
?>
<script type="text/javascript" src="js/avatar.js"></script>