<?php
include '../config/db-connect.php'

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin login</title>
    <link rel="stylesheet" href="../css/admin-style.css">
</head>
<body>




<center><div class="login">
<h2>Food Order Website Admin Panel</h2>

 <form action="" method="POST" class="admin-form">
 <h2>Login</h2>
    <?php
    // display an error message if all the form methods are not filled
    if(isset($_SESSION['user-login'] )){
        echo $_SESSION['user-login'];
        unset($_SESSION['user-login']);
    }
    if(isset($_SESSION['not-logged-in'])){
        echo $_SESSION['not-logged-in'];
        unset($_SESSION['not-logged-in']);
    }

    ?><br>       
        <label for="username" >Username</label>
        <input type="text" name="username" required>   
        <label for="password">Password</label>
        <input type="password" name="password" required>

        <input type="submit" name="submit" value="Login" class="btn-secondary btn-add-admin">
        <br>
        <p>Developde by: <Strong>Simiyu Rey</Strong></p>
    </form>
    <hr width="60%" >
    </div></center>
    
</body>
</html>

<?php
if(isset($_POST['submit'])){
    // securing the input fields from hackers
    $username =mysqli_real_escape_string($conn,$_POST['username']);
    $raw_password = md5($_POST['password']);
    $password=mysqli_real_escape_string($conn,$raw_password);

    $sql = "SELECT * FROM admin_tbl WHERE username='$username' AND pasword='$password'";

    $res = mysqli_query($conn, $sql);

    if($res==true){
        if(mysqli_num_rows($res)==1){
            $_SESSION['user-login'] = "<div class='success'>Login successfully</div>";
            $_SESSION['user'] = $username;

            header("location:" . SITEURL . 'admin/');
        }
        else{
            $_SESSION['user-login'] = "<div class='error'>Invalid username or password</div>";
            header("location:" . SITEURL . 'admin/admin-login.php');

        }
    }


}


?>