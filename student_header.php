<?php
require_once("functions/avatar.php");
?>
<style>
    body {
        background-image: url('assets/img/tech/back2.jpg') !important;
        background-repeat: no-repeat !important;
        background-attachment: fixed !important;
        background-size: cover !important;
    }
</style>
<div class="wrapper d-flex align-items-stretch">
    <nav id="sidebar">
        <div class="p-4 pt-5">
            <a href="profile.php" class="img logo rounded-circle mb-5" style="background-image:url('<?php echo $myPhoto;?>');"></a>
            <?php echo "<strong id='name'>" . $_SESSION['myFirstname'] . ' ' . $_SESSION['myLastname'] . "</strong><br>";
            $userRole = 'Student';
            echo $userRole;?>
            <br><br>
            <ul class="list-unstyled components mb-5">
                <li>
                    <a href="dashboard.php">Home</a>
                </li>
                <li>
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Feedback</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="my_feedback.php">View Feedback</a>
                        </li>
        </div>
    </nav>
    <div id="content" class="p-4 p-md-5">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                </button>
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Log Out</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>