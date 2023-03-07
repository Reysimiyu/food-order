<?php include 'partials/header.php';?>

<!-- main content starts -->

<div class="main-content">
   <div class="wrapper">
    <h1>Add Admin</h1>
    <?php
    // if(isset($_SESSION['message'])){
    //     echo $_SESSION['message'];
    //     unset($_SESSION['message']);
    // }
    ?><br>

    <form action="" method="POST" class="admin-form">
    <?php
    // display an error message if all the form methods are not filled
   
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
    ?><br>
        <label for="full name" >Full Name:</label>
        <input type="text" name="full-name">
        <label for="username" >Username</label>
        <input type="text" name="username">
        <?php
         if (isset($_SESSION['username-exist'])) {
            echo $_SESSION['username-exist'];
            unset($_SESSION['username-exist']);
        }
        
        ?>      
        <label for="password">Create password</label>
        <input type="password" name="password">

        <input type="submit" name="submit" value="Add" class="btn-secondary btn-add-admin">
    </form>
</div>
</div>

<!-- main content ends -->

<?php include 'partials/footer.php';?>

<?php

// check if the button type is set to submit
if(isset($_POST['submit'])){
    // get form inputs
    $full_name = mysqli_real_escape_string($conn,$_POST['full-name']);
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $password = mysqli_real_escape_string($conn,md5($_POST['password']));

    // check if the username already exists in the database table
    $username_exist = "SELECT * FROM admin_tbl WHERE username='$username'";
    // execute the query
    $res = mysqli_query($conn, $username_exist);
    // check if there is any data in the table
    if(mysqli_num_rows($res)>0){
        $_SESSION['username-exist'] = "<div class='error'>Username already exists</div>";

    }
    
    // check if all the form input fields are field
    else if(empty($full_name)||empty($username)||empty($password)){
         // if any form input fied is empty set session to display error message 
         $_SESSION['message'] ="<div class='error'>Form fields cannot be empty!!</div>";

    
}else{
    // insert data into the admin_tbl table
    $sql = "INSERT INTO admin_tbl(full_name,username,pasword) 
    VALUES('$full_name','$username','$password')";

    // execute the query
    $result = mysqli_query($conn, $sql);

    // check if the query is executed or not
    if($result==true){
        // if the query is well executed set session to display success message
        $_SESSION['message'] = "<div class='success'>Admin added  successifully</div>";

            // submit the form and go to the admin page
            header("location:" . SITEURL . 'admin/admin.php');
    }
    else{
        // if the query is not well executed set session to display error message
        $_SESSION['message'] = "<div class='error'>Request faild</div>";
        // remain on the same page
            header("location:" . SITEURL . 'admin/add-admin.php');
    }

   
}

}

?>