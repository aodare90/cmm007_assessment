<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("functions/sessions.php");
$pageTitle = "Manage Coursework";
require_once("class/functions.php");
require_once("header.php");
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
                <h3 class="text-left price-headline">Courseworks</h3>
            </div>
        </div>
        <hr>
        <div class="row">
            <?php
            $coursework = new coursework();
            $allCourseworks = $coursework->getAllCoursework();
            foreach($allCourseworks as $row) {
                $id = $row['id'];
                $name = $row['name'];
                $code = $row['code'];
                $datecreated = new DateTime($row['datecreated']);
                $datecreated = $datecreated->format('l jS F, Y');

                $editUrl="<a href='editCoursework.php?id=".$id."'>Edit</a>";
                $deleteUrl = "<a href='deleteCoursework.php?id=".$id."'>Delete</a>";
                ?>
                <div class="row">
                    <div class="col-xs-12">
                        <?php
                        echo "<strong><i class='fa fa-university'></i> ".$name."</strong><br/><small><i class='fa fa-edit'></i> ".$editUrl." &nbsp; &nbsp;| &nbsp;&nbsp; <i class='fa fa-trash-o'></i> ".$deleteUrl."</small>";
                        ?>
                    </div>
                </div>
                <hr>
                <?php
            }
            ?>
        </div>
    </div>
<?php
require_once("footer.php");
?>