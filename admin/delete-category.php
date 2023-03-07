<?php
include '../config/db-connect.php';
// check if the image and id are available
if(isset($_GET['id'])AND isset($_GET['image_name'])){
    // get the id and image name values

    $id = $_GET['id'];
    $image_name=$_GET['image_name'];

    if($image_name !=""){
        // give the path to the image in the directory
        $img_path="../images/category/".$image_name;
        // delet the image
        $delete_image=unlink($img_path);

        if($delete_image==false){
            $_SESSION['img-delete']="<div class='error'>Failed to delete the image</div>";
            // redirect on manage category page
            header("location:" . SITEURL . 'admin/manage-categories.php'); 

            // stop the delete process
            die();

        }
    }
    $sql = "DELETE FROM categories WHERE id=$id";

    $result = mysqli_query($conn, $sql);

    if($result==true){
        $_SESSION['del-category'] = "<div class='success'>Category deleted successifuly</div>";

    header("location:" . SITEURL . 'admin/manage-categories.php');   

    }
    else{
        $_SESSION['del-category'] = "<div class='error'>Failed to delete category</div>";

        header("location:" . SITEURL . 'admin/manage-categories.php');   

}
}
else{
    // redirect on manage category page
    header("location:" . SITEURL . 'admin/manage-categories.php'); 

}

?>