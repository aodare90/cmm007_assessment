<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("functions/sessions.php");
$pageTitle = "Create Coursework";
require_once("class/functions.php");
require_once("header.php");
$status='';
if (isset($_POST['submitForm'])) {
    $fullname = $_POST['fullname'];
    $codename = $_POST['codename'];
    if ($fullname=='' || $codename=='') {
        $status='warning';
        $msg = "Please fill in all fields!";
    }else {
        $coursework = new coursework();
        $result = $coursework->createCoursework($fullname,$codename);
        $status = $result["status"];
        $msg = $result["msg"];
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12 text-right">
            <?php
            $userRole = '';
            if ($_SESSION['myRole']=='admin') {
                $userRole = 'Administrator';
            }else {
                header("location:login.php");
            }
            ?>
        </div>
        <div class="col-xs-12">
            <h3 class="text-left price-headline">Create Coursework</h3>
        </div>
    </div>
    <hr>
    <?php
    require_once("functions/msgsalert.php");
    ?>
    <form name="create_coursework" action="createCoursework.php" method="POST">
        <div class="form-group row">
            <label for="Coursework Name" class="col-xs-12 col-sm-2 col-form-label text-right">Coursework Name</label>
            <div class="col-xs-12 col-sm-5">
                <input class="form-control" type="text" name="fullname"/>
            </div>
        </div>
        <div class="form-group row">
            <label for="Coursework Code" class="col-xs-12 col-sm-2 col-form-label text-right">Coursework Code</label>

            <div class="col-xs-12 col-sm-5">
                <input class="form-control" type="text" name="codename"/>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-12 col-sm-2"></div>
            <div class="col-xs-12 col-sm-10">
                <input  class="btn btn-primary" type="submit" name="submitForm" value="Create Coursework"/>
            </div>
        </div>
    </form>
</div>
<?php
require_once("footer.php");
?>
