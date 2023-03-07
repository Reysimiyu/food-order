<?php
include '../config/db-connect.php';

if(!isset($_SESSION['user'])){
    $_SESSION['not-logged-in'] = "<div class='error'>Please login to access Admin panel</div>";
    header("location:".SITEURL.'admin/admin-login.php');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin-site</title>
    <link rel="stylesheet" href="../css/admin-style.css">
</head>
<body>

<!-- menu header starts -->
<div class="menu center-text">
    <div class="wrapper">
        <ul>
            <li><a href="<?php echo SITEURL;?>admin/index.php">Home</a></li>
            <li><a href="<?php echo SITEURL;?>admin/admin.php">Admin</a></li>
            <li><a href="<?php echo SITEURL;?>admin/manage-categories.php">Categories</a></li>
            <li><a href="<?php echo SITEURL;?>admin/manage-food.php">Foods</a></li>
            <li><a href="<?php echo SITEURL;?>admin/manage-order.php">Orders</a></li>
            <li><a href="<?php echo SITEURL;?>admin/admin-logout.php">Logout</a></li>
        </ul>
    </div>


</div>

<!-- menu header ends -->