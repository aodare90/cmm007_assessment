<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("functions/sessions.php");
$pageTitle = "Create Group";
require_once("class/functions.php");
require_once("header.php");
$status='';
$coursewrkid = '';
$description = '';
$title = '';
if (isset($_POST['submitForm'])) {
    $coursewrkid = $_POST['coursewrkid'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    if ($coursewrkid=='' || $title=='' || $description=='') {
        $status='warning';
        $msg = "Please fill in all fields!";
    }else {
        $dataArray = array("coursewrkid"=>$coursewrkid,"title"=>$title, "description"=>$description, "submittedby"=>$_SESSION['myUserId']);
        $group = new group();
        $result = $group->createGroup($dataArray);
        $status = $result["status"];
        $msg = $result["msg"];
    }
}
?>
<div class="container">
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
    <div class="row">
        <div class="col-xs-12">
            <h3 class="text-left price-headline">Create a Group</h3>
        </div>
    </div>
    <hr>
    <?php
    require_once("functions/msgsalert.php");
    ?>
    <form name="create_group" action="createGroup.php" method="POST" enctype="multipart/form-data">
        <div class="form-group row">
            <label for="Coursework Name" class="col-xs-12 col-sm-2 col-form-label text-right">Coursework</label>
            <div class="form-group col-xs-12 col-sm-5">
                <select class="form-control" name="coursewrkid">
                    <option></option>
                    <?php
                    $coursework = new coursework();
                    $result = $coursework->getAllCoursework();
                    foreach ($result as $row) {
                        $id = $row['id'];
                        $name =  $row['name'];
                        $selected = '';
                        if ($row['id']==$coursewrkid) {
                            $selected = 'selected';
                        }
                        ?>
                        <option <?php echo $selected; ?> value="<?php echo $id; ?>"><?php echo $name; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="Group Name" class="col-xs-12 col-sm-2 col-form-label text-right">Name</label>
            <div class="col-xs-12 col-sm-5">
                <input class="form-control" type="text" name="title" value="<?php echo $title; ?>"/><br>
            </div>
        </div>
        <div class="form-group row">
            <label for="Description" class="col-xs-12 col-sm-2 col-form-label text-right">Description</label>
            <div class="col-xs-12 col-sm-8">
                <textarea class="form-control" cols="80" rows="5" name="description"><?php echo  $description; ?></textarea><br>
            </div>
        </div>
        <div class="row" style="margin-top:10px;">
            <div class="col-xs-2 col-sm-2">&nbsp;</div>
            <div class="col-xs-10 col-sm-10">
                <input class="btn btn-primary" type="submit" name="submitForm" value="Create Group"/>
            </div>
        </div>
    </form>
</div>
<?php
require_once("footer.php");
?>
