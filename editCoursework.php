<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("functions/sessions.php");
$pageTitle = "Edit Coursework";
require_once("class/functions.php");
require_once("header.php");
require_once("admin_header.php");

if (!isset($_GET['id']) && $_GET['id']!='') {
    header("location:viewCourseworks.php");
}

$coursewrkid = $_GET['id'];
$pageUrl = "editCoursework.php?id=".$coursewrkid;
$status='';

if (isset($_POST['submitForm'])) {
    $fullname = $_POST['fullname'];
    $codename = $_POST['codename'];

    if ($fullname=='' || $codename=='') {
        $status='warning';
        $msg = "Please fill in all fields!";
    }else {
        $coursework = new coursework();
        $result = $coursework->updateCoursework($coursewrkid,$fullname,$codename);
        $status = $result["status"];
        $msg = $result["msg"];
    }
}
$coursework = new coursework();
$acoursework = $coursework->getCourseworkById($coursewrkid);

foreach ($acoursework as $row) {
    $name = $row['name'];
    $code = $row['code'];
}
?>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <h3 class="text-left price-headline">Edit Coursework</h3>
        </div>
    </div>
    <hr>
    <?php
    require_once("functions/msgsalert.php");
    ?>
    <form name="edit_coursework" action="<?php echo $pageUrl; ?>" method="POST">
        <div class="form-group row">
            <label for="Coursework Name" class="col-xs-12 col-sm-2 col-form-label text-right">Coursework Name</label>
            <div class="col-xs-12 col-sm-10">
                <input class="form-control" type="text" name="fullname" value="<?php echo $name;?>" />
            </div>
        </div>
        <div class="form-group row">
            <label for="Coursework Code"  class="col-xs-12 col-sm-2 col-form-label text-right">Coursework Code</label>
            <div class="col-xs-12 col-sm-5">
                <input class="form-control" type="text" name="codename" value="<?php echo $code; ?>"/>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-xs-12 col-sm-2"></div>
            <div class="col-xs-12 col-sm-10">
                <input  class="btn btn-primary" type="submit" name="submitForm" value="Submit"/>
            </div>
        </div>
    </form>
</div>
<?php
require_once("footer.php");
?>
