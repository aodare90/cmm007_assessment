<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("functions/sessions.php");
$pageTitle = "Students Feedback";
require_once("class/functions.php");
require_once("header.php");

$group = new group();
$archive = '';
$archive = $group->GroupsWithFeedback();
$totalInArchive = $archive->num_rows;

$userRole = '';
if ($_SESSION['myRole']=='admin') {
    $userRole = 'Administrator';
}else {
    header("location:login.php");
}
?>
    <div class="container">
        <br/>
        <div class="row">
            <div class='col-xs-12'>
                <div>
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#students" aria-controls="students" role="tab" data-toggle="tab"><strong>Student Feedback (<?php echo $totalInArchive; ?>)</strong></a></li>
                    </ul>
                    <div role="tabpanel" class="tab-pane active" id="students">
                        <br/>
                        <?php
                        foreach($archive as $row) {
                            $photo = "";
                            if ($row['photo']!='') {
                                $photo = 'assets/img/avatars/'.$row['photo'];
                            }
                            else{
                                $photo = "assets/img/avatars/avatar.png";
                            }
                            $code1 = 'oDdpnVaWwgdsjhMFiyIeLjJjSUCThpJUxfUVwTGnNSGeMLToTq';
                            $code2 = 'FoltjKlLKnBdPvQfPQi!oLU!lStPXzTyZomFgktMQluhRbCDHe';
                            ?>
                            <div class='row'>
                                <div class='col-xs-12'>
                                    <?php
                                    echo "<div ><strong><i class='fa fa-users'></i> <a href='group_details.php?pid=".$row['groupsid']."'>".$row['title']."</a></strong><div style='padding-top:10px;'>".nl2br($row['comment'])."</div></div><br/>";
                                    echo "<div><i class='fa fa-paperclip'></i> <a href='uploads/".$row['feedbackfile']."'>".$row['feedbackfile']."</a></div><br/>";
                                    echo "<div style='text-align:left;'><img class='img-circle' style='width:50px;height:50px;' src='".$photo."'> <a href='users_info.php?mp=".$code1.'-'.$row['usersid'].'-'.$code2."'>".$row['firstname'].' '.$row['lastname']."</a><br/><br/></div>"
                                    ?>
                                </div>
                            </div>
                            <hr>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
require_once("footer.php");
?>