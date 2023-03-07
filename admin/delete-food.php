<?php
include '../config/db-connect.php';


if(isset($_GET['id']) AND isset($_GET['image_name'])){
    // get the image name and id values 
$id=$_GET['id'];
$image_name=$_GET['image_name'];

// check if the image is available
if($image_name!=""){
    // give the image path in directory
    $img_path="../images/food/".$image_name;
    // delete the image
    $img_delete=unlink($img_path);
    // check if image is deleted successfully or noyt
    if($img_delete==false){
        // set an error message
        $_SESSION['img-delete']="<div class='error'>Failed to delete the image</div>";

        // stop the delete process
        header("location:".SITEURL.'admin/manage-food.php');
        die();
    }
}

// create sql query

$sql="DELETE FROM food_tbl WHERE id=$id";
// execute delete query
$result=mysqli_query($conn,$sql);

if($result==true){
    // display succes message and redirect to manage food page
    $_SESSION['delete-food']="<div class='success'>Food deleted successifuly</div>";

    header("location:".SITEURL.'admin/manage-food.php');
}

else{
    // display error message and rredirect to manage-food page
    $_SESSION['delete-food']="<div class='error'>Request failed</div>";

    header("location:".SITEURL.'admin/manage-food.php');
}

}
else{
    // redirect to the current manage food page
    header("location:".SITEURL.'admin/manage-food.php');
}


?>