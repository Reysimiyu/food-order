<?php include 'partials/header.php';?>

<!-- main content starts -->
<?php
// get the id set in the delete url
$id = $_GET['id'];

// fetch the data of that particular of that particular user id
$sql = "SELECT * FROM admin_tbl WHERE id='$id'";
// execute the query
$result = mysqli_query($conn, $sql);


if($result==true){
    // if there is data for that id in the table get it
    if(mysqli_num_rows($result)==1){
        // create an associative array of the data
        $rows = mysqli_fetch_assoc($result);
        // assign variables to particular fields you want to fetch
        $id = $rows['id'];
        $full_name = $rows['full_name'];
        $username = $rows['username'];

    }else{
        // if the query did not succeed redirect to admin page
        header("location:" . SITEURL . 'admin/admin.php');
}
}

?>

<div class="main-content">
    <div class="wrapper">
    <h1>Update Admin</h1>

    <br> <br>
    <form action="" method="POST" class="admin-form">
        <label for="full name" >Full Name:</label>
        <!-- echo the particular user details in the form field -->
        <input type="text" name="full-name" value="<?php echo $full_name;?>">
        <label for="username" >Username</label>
        <input type="text" name="username" value="<?php echo $username;?>">           
        <input type="hidden" name="id"  value="<?php echo $id;?>">

        <input type="submit" name="submit" value="Update Admin" class="btn-secondary btn-add-admin">
    </form>
       
    </div>

</div>

<!-- main content ends -->

<!-- php script to update admin details -->

<?php
// check if the button is set to submit and if so get the user inputs from the form
if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $full_name = mysqli_real_escape_string($conn,$_POST['full-name']);
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    // update the user details using user id as the key
    $sql = "UPDATE admin_tbl SET
    full_name='$full_name',
    username='$username'
    WHERE id='$id'
    ";
    // execute update query
    $result = mysqli_query($conn, $sql);

    // if the query succeeds display a success message
    if($result==true){
        $_SESSION['update'] = "<div class='success'>Admin updated successifuly</div>";

        header("location:" . SITEURL . 'admin/admin.php');
    }
    else{
        // if the query fails display an error message
        $_SESSION['update'] = "<div class='error'>Update request faild, try again</div>";

        header("location:" . SITEURL . 'admin/admin.php');
    }


}
?>

<?php include 'partials/footer.php';?>