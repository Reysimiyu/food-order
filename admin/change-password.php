<?php include 'partials/header.php';?>

<!-- main content starts -->

<div class="main-content">
    <div class="wrapper">
    <h1>Change Password</h1>

    <br> <br>
    <?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    
    
    ?>
    <form action="" method="POST" class="admin-form">
    <?php
    // display an error message if all the form methods are not filled
   
    if (isset($_SESSION['pwd-match'])) {
        echo $_SESSION['pwd-match'] ;
        unset($_SESSION['pwd-match'] );
    }    
   
    ?><br>
        <label for="Current password" >Current password</label>
        <input type="password" name="current-password">
        <?php
         if(isset($_SESSION['pwd-incorrect'])){
            echo $_SESSION['pwd-incorrect'];
            unset($_SESSION['pwd-incorrect']);
        }
        ?>
        <label for="New Password" >New Password</label>
        <input type="password" name="new-password" required>
        <label for="confirm-password">Confirm new password</label>
        <input type="password" name="confirm-password" required>
        <?php
         if(isset($_SESSION['pwd-change'])){
            echo $_SESSION['pwd-change'];
            unset($_SESSION['pwd-change']);
        }
        ?>

        <input type="hidden" name="id" value="<?php echo $id;?>">
        <input type="submit" name="submit" value="Change Password" class="btn-secondary btn-add-admin">
    </form>
    
    </div>

</div>

<!-- main content ends -->

<!-- logic for password change -->
<?php
if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $current_password = md5($_POST['current-password']);
    $new_password =md5($_POST['new-password']);
    $confirm_password =md5($_POST['confirm-password']);

    $sql = "SELECT * FROM admin_tbl WHERE id=$id AND pasword='$current_password'";

    $res = mysqli_query($conn, $sql);

    if($res==true){
        if(mysqli_num_rows($res)==1){
            //data is available
            if($new_password==$confirm_password){
                $sqls = "UPDATE admin_tbl SET
                pasword='$new_password'
                WHERE id=$id
                ";
                $result = mysqli_query($conn, $sqls);
                if($result==true){
                    //pwd change success
                    $_SESSION['pwd-change']="<div class='success'>Password changed successfully</div>";
                    // redirect to admin page
                    header("location:" . SITEURL . 'admin/admin.php');
                }
                else{
                    //password change failed
                    $_SESSION['pwd-change']="<div class='error'>Password changed rquest failed</div>";
                    // remain on the same page
                    header("location:" . SITEURL . 'admin/change-password.php');
                }
            } 
            else{
                //password do not match
                $_SESSION['pwd-change']="<div class='error'>Passwords do not match!</div>";
                    // redirect to admin page
                    header("location:" . SITEURL . 'admin/change-password.php');

            } 
        }
        else{
            // user does not exist
            $_SESSION['pwd-incorrect']="<div class='error'>Incorrect password!</div>";
                    // redirect to admin page
                    header("location:" . SITEURL . 'admin/change-password.php');
        }
    }

}

?>
<?php include 'partials/footer.php';?>