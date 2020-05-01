<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("functions/sessions.php");
$pageTitle = "Add Student";
require_once("class/functions.php");
require_once("header.php");
$status='';
if (isset($_POST['submitForm'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    if ($firstname=='' || $lastname=='' || $email=='' || $password=='' || $role=='') {
        $status='warning';
        $msg = "Please fill in all fields!";
    }else {
        $user = new users();
        $result = $user->createUsers($firstname,$lastname,$email,$password,$role);
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
            <h3 class="text-left price-headline">Add Student</h3>
        </div>
    </div>
    <hr>
    <?php
    require_once("functions/msgsalert.php");
    ?>
    <form name="create_student" action="addStudent.php" method="POST">
        <div class="form-group row">
            <label for="First Name" class="col-xs-12 col-sm-2 col-form-label text-right">First Name</label>
            <div class="col-xs-12 col-sm-5">
                <input class="form-control" type="text" name="firstname"/>
            </div>
        </div>
        <div class="form-group row">
            <label for="Last Name" class="col-xs-12 col-sm-2 col-form-label text-right">Last Name</label>
            <div class="col-xs-12 col-sm-5">
                <input class="form-control" type="text" name="lastname"/>
            </div>
        </div>
        <div class="form-group row">
            <label for="Email" class="col-xs-12 col-sm-2 col-form-label text-right">Email</label>
            <div class="col-xs-12 col-sm-5">
                <input class="form-control" type="email" name="email" required/>
            </div>
        </div>
        <div class="form-group row">
            <label for="Password" class="col-xs-12 col-sm-2 col-form-label text-right">Password</label>
            <div class="col-xs-12 col-sm-5">
                <input class="form-control" type="password" name="password" minlength="6" required/>
            </div>
        </div>
        <div class="form-group row">
            <label for="role" class="col-xs-12 col-sm-2 col-form-label text-right">Role</label>
            <div class="form-group col-xs-12 col-sm-5">
                <select class="form-control" name="role">
                    <option value='student'>Student</option></select><br/>
                <input  class="btn btn-primary" type="submit" name="submitForm" value="Add Student"/>
            </div>
        </div>
    </form>
</div>
<?php
require_once("footer.php");
?>
