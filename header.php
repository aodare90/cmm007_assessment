<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>ReviewMe! | <?php echo $pageTitle; ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker3.min.css">
        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/header.css">
    </head>
    <body>
<?php
if (isset($_SESSION['memberLogin']) && $_SESSION['memberLogin'] == 'assessment2020' && $_SESSION['myRole']=='admin') {
    require_once("admin_header.php");
}else if (isset($_SESSION['memberLogin']) && $_SESSION['memberLogin'] == 'assessment2020' && $_SESSION['myRole']=='student') {
    require_once("student_header.php");
}
?>