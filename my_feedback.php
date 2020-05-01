<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("functions/sessions.php");
$pageTitle = "My Feedback";
require_once("class/functions.php");
require_once("header.php");
$status='';
$group = new group();
$list = $group->GroupFeedbackByStudents($_SESSION['myUserId']);
$totalFeedback = $list->num_rows;
?>
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
            <h3 class="text-left price-headline">My Feedback (<?php echo $totalFeedback; ?>)</h3>
        </div>
    </div>
    <hr>
    <?php
    foreach($list as $row) {
        $datesubmitted = new DateTime($row['datesubmitted']);
        $datesubmitted = $datesubmitted->format('l jS F, Y');
        if ($row['status']=='GF' || $row['status']=='GA') {
        }
        ?>
        <div class="row" >
            <div class="col-xs-4" style='border-radius:5px;padding-top:10px;padding-bottom:15px;border-style: outset;'>
                <?php
                echo "<br/><i class='fa fa-university'></i> <a href='viewCourseworks.php'><strong>" .$row['name']."</strong></a>";
                ?>
                <br/>
                <?php
                echo "<br/><i class='fa fa-users'></i> <a href='group_details.php?pid=".$row['groupsid']."'><strong>".$row['title']."</strong></a><br/>";
                ?>
                <br/>
            </div>
            <div class="col-xs-8">
                <?php
                $completed= $group->FeedbackByStudent($row['groupsid'],$_SESSION['myUserId']);
                foreach($completed as $rec) {
                    $comment = $rec['comment'];
                    $datecreated= new DateTime($rec['datecreated']);
                    $datecreated = $datecreated->format('l jS F, Y');
                    ?>
                    <div class='row' >
                        <div class='col-xs-12'>
                            <?php
                            echo "<small>".$datecreated."</small>";
                            echo "<div style='margin-top:10px;margin-bottom:10px;'>".nl2br($comment)."<br><i class='fa fa-paperclip'></i> <a href='uploads/".$rec['file']."'>".$rec['file']."</a></div><hr>";
                            ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <hr>
        <?php
    }
    ?>
</div>
<?php
require_once("footer.php");
?>
