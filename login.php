<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
session_destroy();
$pageTitle = "Login";
require_once("class/functions.php");

$msg = "";
$status = "";
$content = "";

if (isset($_COOKIE['username']) && $_COOKIE['password']) {
    loginFunction($_COOKIE['username'],$_COOKIE['password']);
}

if (isset($_POST['submitForm'])) {
    $usernm = sanitize::clean($_POST['username']);
    $password = sanitize::clean($_POST['password']);

    if ($usernm!="" && $password!="") {
        if (!empty($_POST['remember_me'])) {
            setcookie("username",$usernm,time()+3600);
            setcookie("password",$password, time()+3600);
        }
        else{
            setcookie("username",'');
            setcookie("password",'');
        }
        loginFunction($usernm,$password);
    }else{
        $status = "error";
        $msg = "Please enter Username and Password!";
    }
}
function loginFunction($username,$password){
    $users = new users();
    $dataArray = array("username"=>$username,"password"=>$password);
    $result =  $users->login($dataArray);

    if ($result['status']=="success"){
        session_start();
        $_SESSION['memberLogin'] = 'assessment2020';
        $_SESSION['myUserId'] = $result["id"];
        $_SESSION['myFirstname'] = $result["firstname"];
        $_SESSION['myLastname'] = $result["lastname"];
        $_SESSION["myEmail"] = $result["email"];
        $_SESSION["myPhoto"] = $result["photo"];
        $_SESSION['myAboutme'] = $result['aboutme'];
        $_SESSION['myRole'] = $result['role'];
        header("location:dashboard.php");
    }
    else{
        $status = $result["status"];
        $msg = $result["message"];
    }}
?>
<head>
    <title>ReviewMe! | Login</title>
    <link rel="icon" type="image/png" href="assets/img/icons/favicon.ico"/>
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <img src="assets/img/img-01.png" alt="IMG">
            </div>
            <form class="login100-form validate-form" method="POST" action="login.php">
                <span class="login100-form-title"> LOGIN </span>
                <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                    <input class="input100" type="email" name="username" placeholder="Username">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
                </div>
                <div class="wrap-input100 validate-input" data-validate = "Password is required">
                    <input class="input100" type="password" name="password" placeholder="Password" required>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
                </div>
                <div class="text-right">
                    <input type="checkbox" name="remember_me"> Remember me<small></small>
                </div>
                <div class="container-login100-form-btn">
                    <button class="login100-form-btn" type="submit" name="submitForm" value="Login">
                        Login
                    </button>
                </div>
                <div class="text-center p-t-136">
                </div>
            </form>
        </div>
    </div>
</div>
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="vendor/bootstrap/js/popper.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="vendor/select2/select2.min.js"></script>
<script src="vendor/tilt/tilt.jquery.min.js"></script>
<script >
    $('.js-tilt').tilt({
        scale: 1.1
    })
</script>
<script src="js/main.js"></script>