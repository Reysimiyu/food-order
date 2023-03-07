<?php
// include the database connection file 
include '../config/db-connect.php';

// get the id set in the delete url
$id = $_GET['id'];

// delete the particular user id
$sql = "DELETE FROM admin_tbl WHERE id=$id";

// execute the delete query
$result = mysqli_query($conn, $sql);

//if delete operation is successiful display success message and redirect to admin page
if($result==true){
    $_SESSION['delete'] = "<div class='success'>Admin deleted successifully</div>";

    header("location:" . SITEURL . 'admin/admin.php');
}
else{
    //if delete operation fails display an error message and redirect to admin page
    $_SESSION['delete'] = "<div class='error'>Dlete operation failed</div>";

    header("location:" . SITEURL . 'admin/admin.php');
}
?>




