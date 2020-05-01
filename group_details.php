<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("functions/sessions.php");
$pageTitle = "Group Details";
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
    $groupDesc = $result["description"];
}

if (isset($_POST['submitForm'])) {
    $usersid = $_POST['users'];
    if ($groupsid=='' || $usersid=='') {
        $status='warning';
        $msg = "Please fill out all fields!";
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
            <h3 class="text-left price-headline">Group Details</h3>
        </div>
    </div>
    <hr>
    <?php
    require_once("functions/msgsalert.php");
    ?>
    <br/>
    <div class="row" >
        <div class="col-xs-12">
            <strong>Coursework</strong>
            <?php
            echo "<br/><a href='viewCourseworks.php'>" .$groupCoursework."</a><br/></br>";
            ?>
        </div>
        <div class="col-xs-12">
            <strong>Group Name</strong>
            <?php
            echo "<br/>$groupTitle<br/><br/>";
            ?>
        </div>
        <div class="col-xs-12">
            <strong>Description</strong>
            <?php
            echo "<br/>".$groupDesc."<br/><br/>";
            ?>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xs-12">
            <h4 class="text-left price-headline" style="font-weight:bold;">Group Members</h4>
        </div>
        <ol>
            <?php
            $selFeedback = $group->getFeedbackToGroup($groupsid);
            foreach($selFeedback as $row) {echo "<ol>".$row['firstname'].' '.$row['lastname']."</ol>";}
            ?>
        </ol>
    </div>
    <br/>
    <hr>
</div>
<?php
require_once("footer.php");
?>
