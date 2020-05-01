<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("functions/sessions.php");
$pageTitle = "Assign Student to Group";
require_once("class/functions.php");
require_once("header.php");

$status='';
$groupsid = $_GET['pid'];
$pageLink = "assign_student.php?pid=".$groupsid;
$group = new group();
$groupInfo  = $group->getGroupById($groupsid);

foreach($groupInfo as $result) {
    $groupTitle = $result["title"];
    $groupCoursework = $result['name'];
    $groupUserId = $result['usersid'];
    $groupDate = new DateTime($result['datesubmitted']);
    $groupDate = $groupDate->format('l jS F, Y');
}

if (isset($_POST['submitForm'])) {
    $usersid = $_POST['user'];
    if ($groupsid=='' || $usersid=='') {
        $status='warning';
        $msg = "Please select a student!";
    }else {
        $dataArray = array("groupsid"=>$groupsid,"usersid"=>$usersid);
        $group = new group();
        $result = $group->AssignStudent($dataArray);
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
            <h3 class="text-left price-headline">Assign Student to <?php echo"<strong>$groupTitle</strong>";?></h3>
        </div>
    </div>
    <hr>
    <?php
    require_once("functions/msgsalert.php");
    ?>
    <form name="assign_student" action="<?php echo $pageLink; ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group row">
            <label for="Student Name"  class="col-xs-12 col-sm-2 col-form-label text-right">Select Student</label>
            <div class="form-group col-xs-12 col-sm-5">
                <select class="form-control" name="user">
                    <option></option>
                    <?php
                    $coursework = new users();
                    $result = $coursework->getAllUsers();
                    foreach ($result as $row) {
                        $id = $row['id'];
                        $name =  $row['firstname'].' '.$row['lastname'];
                        ?>
                        <option value="<?php echo $id; ?>"><?php echo $name; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row" style="margin-top:10px;">
            <div class="col-xs-2 col-sm-2">&nbsp;</div>
            <div class="col-xs-10 col-sm-10">
                <input  class="btn btn-primary" type="submit" name="submitForm" value="Assign Student"/>
            </div>
        </div>
    </form>
    <br/>
    <hr>
    <div class="row">
        <div class="col-xs-12">
            <h4 class="text-left price-headline" style="font-weight:bold;">Group Members</h4>
        </div>
        <ol>
            <?php
            $selFeedback = $group->getFeedbackToGroup($groupsid);
            foreach($selFeedback as $row) {
                echo "<li>".$row['firstname'].' '.$row['lastname']."</li>";
            }
            ?>
        </ol>
    </div>
    <br/>
    <hr>
</div>
<br/>
</div>
<?php
require_once("footer.php");
?>
