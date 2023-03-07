<?php

include 'config/db-connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    

</head>
<body>
<section class="navbar">
    <div class="container">
        <div class="logo">
          <a href="<?php echo SITEURL;?>"> <img src="images/web-logo.jpg" alt="logo"></a> 
        </div>
        <div class="menu">
            <ul>
                <li>
                    <a href="<?php echo SITEURL;?>">Home</a>
                </li>
                <li>
                    <a href="<?php echo SITEURL;?>foods.php">Foods</a>
                </li>
                <li>
                    <a href="<?php echo SITEURL;?>categories.php">Categories</a>
                </li>
                <li>
                    <a href="#">Contact us</a>
                </li>
                <li>
                    <a href="<?php echo SITEURL;?>admin">Admin</a>
                </li>
            </ul>
            
        </div>
        <div class="clear-fix"></div>
        
    </div>
    
</section>
