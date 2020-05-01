<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("functions/sessions.php");
$pageTitle = "Leave Group Feedback";
require_once("class/functions.php");
require_once("header.php");

$status='';
$groupsid = $_GET['pid'];
$pageLink = "leave_feedback.php?pid=".$groupsid;
$group = new group();
$groupInfo = $group->getGroupById($groupsid);

foreach($groupInfo as $result) {
    $groupsid = $result['id'];
    $groupTitle = $result['title'];
    $groupCoursework = $result['name'];
    $groupDescription = $result['description'];
    $groupDateSubmitted = $result['datesubmitted'];
    $groupStatus = $result['status'];
}
$coursewrkid = '';
$comment = '';
$title = '';

if (isset($_POST['submitForm'])) {
    $comment = $_POST['comment'];
    if ($comment=='') {
        $status='warning';
        $msg = "You must leave a comment!";
    }else {
        $dataArray = array("groupsid"=>$groupsid,"comment"=>$comment,"file"=>$_SESSION['uploadedFile'],"submittedby"=>$_SESSION['myUserId']);
        $group = new Group();
        $result = $group->submitFeedback($dataArray);
        $status = $result["status"];
        $msg = $result["msg"];
        $comment = '';
        unset($_SESSION['uploadedFile']);
    }
}

if (isset($_POST['uploadFile'])) {
    $usersid = $_SESSION['myUserId'];
    $comment = $_POST['comment'];
}
?>

<style>
    .btn-default {
        color: #333;
        background-color: #ccc;!important;
        border-color: #ccc;
    }
    .btn:hover{
        background-color: #31c3ef;!important;
    }
</style>
<div class="container">
    <div class="col-xs-12 text-right">
        <?php
        $userRole = '';
        if ($_SESSION['myRole']=='admin') {
            $userRole = 'Administrator';
        }else if ($_SESSION['myRole']=='student') {
            $userRole = 'Student';
        }
        ?>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <h3 class="text-left price-headline">Group Feedback</h3>
        </div>
    </div>
    <hr>
    <?php
    require_once("functions/msgsalert.php");
    ?>
    <form name="upload_feedback" action="<?php echo $pageLink; ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group row">
            <label for="Group Name"  class="col-xs-12 col-sm-2 col-form-label text-right">Group Name</label>
            <div class="col-xs-12 col-sm-7">
                <i class='fa fa-users'></i>
                <?php
                echo "<a target='_blank' href='group_details.php?pid=".$groupsid."'>".$groupTitle."</a>";
                ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="Comment"  class="col-xs-12 col-sm-2 col-form-label text-right">Comment</label>
            <div class="col-xs-12 col-sm-8">
                <textarea class="form-control" cols="80" rows="5" name="comment"><?php echo  $comment; ?></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-3"></div>
            <div class="col-xs-9">
                <?php
                if (isset($_POST['uploadFile'])) {
                    echo "<strong>";
                    require_once("uploadFile.php");
                    echo "</strong><br/><br/>";
                }
                ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="Add File" class="col-xs-12 col-sm-2 col-form-label text-right">Add File</label>
            <div class="col-xs-7 col-sm-5">
                <input type="file" name="fileToUpload">
                <input type="submit" name="uploadFile" value="Upload File" class="btn btn-default btn-sm">
            </div>
        </div>
        <div class="row" style="margin-top:10px;">
            <div class="col-xs-2 col-sm-2">&nbsp;</div>
            <div class="col-xs-10 col-sm-10">
                <input class="btn btn-primary" type="submit" name="submitForm" value="Submit Feedback"/>
            </div>
        </div>
    </form>
</div>
<?php
require_once("footer.php");
?>
