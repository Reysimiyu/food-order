<?php include 'partials/header.php';
include 'config/db-connect.php';
?>

<!-- main content starts -->

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
       

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
            <input type="text" name="title" class="cat-inputs">
            Image
            <input type="file" name="img-name" class="cat-inputs">

            <table class="radio-inputs">
                <tr>
                    <td>Featured:  </td>
                    <td><input type="radio" name="featured" value="Yes" class="cat-inputs">Yes</td>
                    <td><input type="radio" name="featured" value="No" class="cat-inputs">No</td>

                </tr>

                <tr>
                    <td>Active:  </td>
                    <td><input type="radio" name="active" value="Yes" class="cat-inputs">Yes</td>                    
                    <td><input type="radio" name="active" value="No" class="cat-inputs">No   </td>
                </tr>
            </table>           
             
            <input type="submit" name="submit" value="Add Category" class="btn-secondary btn-add-admin">
        </form>          
    </div>
</div>
<!-- main content ends -->

<?php
    if(isset($_POST['submit'])){
        $title = mysqli_real_escape_string($conn,$_POST['title']);
        // $img_name = $_POST['img_name'];

        if(isset($_POST['featured'])){
            $featured =$_POST['featured'];
        }

        else{
            $featured='No';
        }

        if(isset($_POST['active'])){
            $active =$_POST['active'];
        }

        else{
            $active='No';
        }

        
        // check if the image is selected or not 
           
        if(isset($_FILES['img-name']['name'])){
            $image_name = $_FILES['img-name']['name'];  

            // upload the image only if the image is selected
            if($image_name!=""){

                $ext=explode('.',$image_name);
                $image_name="category-image-".rand(000,999).".".end($ext);         

                $src=$_FILES['img-name']['tmp_name'];

                $dst="../images/category/".$image_name;

                $upload=move_uploaded_file($src, $dst);

                if($upload==false){
                    $_SESSION['img-upload'] = "<div class='error'>Failed to upload the image</div>";

                    header("location:".SITEURL.'admin/add-category.php');

                    die();
                }
            }
            else{
                $image_name = "";
                // die();
           }
        
        }    

       
        if(empty($title)||empty($featured)||empty($active)){
            $_SESSION['add-category'] = "<div class='error'>Form fields cannot be empty</div>";

            header("location:".SITEURL.'admin/add-category.php');

        }
        else{

        $sql = "INSERT INTO categories SET
        title='$title',
        image_name='$image_name',
        featured='$featured',
        active='$active'
        ";

        $res = mysqli_query($conn,$sql);

        if($res==true){
        $_SESSION['add-category'] = "<div class='success'>Added category successfully</div>";

        header("location:" . SITEURL . 'admin/manage-categories.php');
        }
        
        else{
            $_SESSION['add-category'] = "<div class='error'>Failed to add category</div>";

            header("location:" . SITEURL . 'admin/add-category.php');
        }
    }
        
                
    }

?>

<?php include 'partials/footer.php';?>