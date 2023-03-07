<?php include 'db-connect.php'?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>categories</title>
</head>
<body>

<form action="" method="post">
Full Name:
<input type="text" name="full_name"><br><br>
username:
<input type="text" name="username"><br><br>


password
<input type="password" name="password"><br><br>

<input type="submit" name="submit">


</form>

<?php

if(isset($_POST['submit'])){
    $full_name = $_POST['full_name'];    
    $username = $_POST['username'];    
    $password = $_POST['password'];
    
    $sql = "INSERT INTO admin_tbl(full_name,username,pasword) 
    VALUES('$full_name','$username','$password')";
    $res = mysqli_query($conn, $sql);


    if($res=true){
        echo 'an error has occured';
    }
    else {
        echo 'you are stupid';
    }
}


?>
    
</body>
</html>

