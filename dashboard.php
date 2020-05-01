<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("functions/sessions.php");
$pageTitle = "Dashboard";
require_once("class/functions.php");
require_once("header.php");

$group = new group();
$groupinfo = '' ;
$feedback = '';

if ($_SESSION['myRole']=='admin') {
    $groupinfo = @$group->getAllCreatedGroups();
    $feedback = $group->getAllActiveGroups();
}
if ($_SESSION['myRole']=='student') {
    $feedback = $group->StudentAssignedToActiveGroups($_SESSION['myUserId']);
}

$totalGroups = @$groupinfo->num_rows;
$totalGroupsWithFeedback = @$feedback->num_rows;

?>
    <div class="row">
        <div class="col-xs-12 text-right">
            <?php
            $userRole = '';
            if ($_SESSION['myRole']=='admin') {
                $userRole = 'Administrator';
            }
            else if ($_SESSION['myRole']=='student') {
                $userRole = 'Student';
            }
            ?>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class='col-xs-12'>
            <div>
                <ul class="nav nav-tabs" role="tablist">
                    <?php
                    if ($_SESSION['myRole']=='admin'){
                        echo "<li role=\"presentation\" class=\"active\"><a href=\"#home\" aria-controls=\"home\" role=\"tab\" data-toggle=\"tab\"><strong>Groups ($totalGroups)</strong></a></li>";
                    }else{
                        echo "<li role=\"presentation\"><a href=\"#feedback\" aria-controls=\"feedback\" role=\"tab\" data-toggle=\"tab\"><strong>Feedback ($totalGroupsWithFeedback)</strong></a></li>";
                    }
                    ?>
                </ul>
                <?php
                if ($_SESSION['myRole']=='admin') {
                    echo '<div class="tab-content">
                                     <div role="tabpanel" class="tab-pane active" id="home">
                                     <br/>
                                  <div class=\'row\'>
                                      <div class=\'col-xs-4\'>
                                          <strong>Coursework</strong>
                                      </div>
                                      <div class=\'col-xs-4\'>
                                          <strong>Group</strong>
                                      </div>
                                  </div>
                                  <hr>';
                    foreach ($groupinfo as $row) {
                        $assign = '';
                        if ($row['status'] == 'GA' || $row['status'] == 'GA') {
                            $assign = "<a href='assign_student.php?pid=".$row['id']."'><strong style='color: red'>Assign Student</strong></a>";
                        }
                        echo '<div class=\'row\'>
                              <div class=\'col-xs-4\'>';
                        echo "<i class='fa fa-university'></i> <a href='viewCourseworks.php'>".$row['name']."</a><br/>";
                        echo '</div>
                              <div class=\'col-xs-4\'> <i class=\'fa fa-users\'></i>' ;
                        echo "  <a href='group_details.php?pid=".$row['id']."'>".$row['title']."</a><br>".$assign;
                        echo '</div>
                              </div>
                              <hr>';
                    }
                    echo '</div> <br/>';}?>
                <div role="tabpanel" class="tab-pane" id="messages">
                    <br/>
                    <div class="row">
                        <div class="col-xs-4">
                            <strong>Coursework</strong>
                        </div>
                    </div>
                    <br/>
                    <?php
                    foreach($feedback as $res) {
                        $groupsid = $res['id'];
                        ?>
                        <div class="row">
                            <div class="col-xs-4">
                                <i class='fa fa-university'></i>
                                <?php echo "<a href='#'>".$res['name']."</a>"; ?>
                            </div>
                            <div class="col-xs-3">
                                <?php
                                echo "<strong><a href='leave_feedback.php?pid=".$res['id']."'>Leave Group Feedback</a></strong>";
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
<?php
require_once("footer.php");
?>