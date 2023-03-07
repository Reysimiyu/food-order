<?php include 'partials/header.php';
include 'config/db-connect.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql = "SELECT * FROM categories WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    if($res==true){
        if(mysqli_num_rows($res)==1){
            $rows = mysqli_fetch_assoc($res);
            // get the data
            $title=$rows['title'];
            $current_image=$rows['image_name'];
            $featured=$rows['featured'];
            $active=$rows['active'];
            
        }
    }
}
else{
    // redirect to manage categories page if id is not set
    header("location:".SITEURL.'admin/manage-categories.php');
}
?>


<!-- main content starts -->

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
       

        <form action="" method="POST" enctype="multipart/form-data" class="admin-form">
        <?php
        if(isset($_SESSION['add-category'])){
            echo $_SESSION['add-category'];
            unset($_SESSION['add-category']);
        }

        if(isset($_SESSION['img-upload'])){
            echo $_SESSION['img-upload'];
            unset ($_SESSION['img-upload']);
        }
        ?><br>
            Title
            <input type="text" name="title" value="<?php echo $title;?>">
            current image:<br><br>
            <?php 
            if($current_image!=""){
                // image available
                ?>
                <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image;?>" alt="" width="120px"><br><br>
                <?php
            }
            else{
                echo "<div class='error'>Image not available</div>";
            }
            ?>
            
            select New image
                <input type="file" name="img_name">

            <table>                
                <tr>
                    <td> Featured</td>
                    <td><input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes</td>
                    <td><input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No">No</td>
                </tr>

                <tr>
                    <td>Active</td>
                    <td><input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes</td>
                    <td><input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value="No">No</td>

                </tr>  
            
            </table>
            <input type="hidden" name="id" value="<?php echo $id;?>"> 
            <input type="hidden" name="current_image" value="<?php echo $current_image;?>"> 
            
            
            <input type="submit" name="submit" value="Update Category" class="btn-secondary btn-add-admin">
        </form>          
    </div>
</div>
<!-- main content ends -->

<?php
if(isset($_POST['submit'])){
    $id=$_POST['id'];
    $title = mysqli_real_escape_string($conn,$_POST['title']);
    $current_image=$_POST['current_image'];
    $featured=$_POST['featured'];
    $active=$_POST['active'];

    if(isset($_FILES['img_name']['name'])){
        $image_name = $_FILES['img_name']['name'];
        // check if the image is selected
        if($image_name!=""){
            // get the extensio
            $ext=explode(".",$image_name);
            // rename the image
            $image_name="category-image-".rand(000,999).".".end($ext);

            $src=$_FILES['img_name']['tmp_name'];
            $dst="../images/category/".$image_name;

            $upload=move_uploaded_file($src,$dst);

            // check if image is uploded successifully

            if($upload==false){
                $_SESSION['img-upload']="<div class='error'>Failed to upload image</div>";
                // redirect to same page
                header("location:".SITEURL.'admin/manage-categories.php');
                die();
            }
        }    
        else{
            $image_name=$current_image;
        }
            // check if the current image exits  
        if($current_image!=""){
            // set the path to remove the current image
            $remove_path="../images/category/".$current_image;
            // now remove the image
            $remove=unlink($remove_path);

            if($remove==false){
                $_SESSION['failed_remove']="<div class='error'>Failed to update image</div>";
                // redirect to manage_categories page
                header("location:".SITEURL.'admin/update-category.php');
                die();
                    
            }

        }
        
        
        
    }
    else{
        $image_name=$current_image;
    }
    

    $sql2 = "UPDATE categories SET 
    title='$title',
    image_name='$image_name', 
    featured='$featured', 
    active='$active'
    WHERE id=$id";

    $result = mysqli_query($conn, $sql2);

    if($result==true){
        $_SESSION['upt-category'] = "<div class='success'>Category updated successifully</div>";

        header("location:" . SITEURL . 'admin/manage-categories.php');
    }

    else{
        $_SESSION['upt-category'] = "<div class='error'>Failed to update category</div>";

        header("location:" . SITEURL . 'admin/update-category.php');
    }
}


?>



<?php include 'partials/footer.php';?>


