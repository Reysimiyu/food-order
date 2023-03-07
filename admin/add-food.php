<?php include 'partials/header.php';?>

<!-- main content starts -->

<div class="main-content">
   <div class="wrapper">
    <h1>Add Food</h1>
    <?php
    
    ?><br>

    <form action="" method="POST" enctype="multipart/form-data" class="admin-form">
    <?php
    // display an error message if all the form methods are not filled
   
    if (isset($_SESSION['img-upload'])) {
        echo $_SESSION['img-upload'];
        unset($_SESSION['img-upload']);
    }

    if(isset($_SESSION['add-food'])){
        echo $_SESSION['add-food'];
        unset ($_SESSION['add-food']);
    }
    ?><br>
        <label for="Title" >Title</label>
        <input type="text" name="title"><br>
        <label for="cat_id">Category</label>
        <select name="category" >
        <!-- php script to categories from database -->
        <?php 
        $catsql="SELECT * FROM categories WHERE featured='Yes'";

        $res=mysqli_query($conn,$catsql);
        if($res==true){
            // check if there are categories in the database
            if(mysqli_num_rows($res)>0){
                while($rows=mysqli_fetch_assoc($res)){
                    $id=$rows['id'];
                    $title=$rows['title'];

                    ?>
                    
                    <option value="<?php echo $id;?>"><?php echo $title;?></option>  
                            
                  
                   
                    <?php
                }

            
            }
            else{
             ?>
             
             <option value="0">No categories added</option>
            
             
             <?php
            
        }
        }
        ?>
        
        </select><br><br>  
        <label for="image">Select Image</label>
        <input type="file" name="image">
        <label for="description" >Description</label>
        <textarea type="text" name="description"></textarea><br><br>
        <label for="price">Price</label>
        <input type="number" name="price">
       
        
        

        <table>            
            <tr>
                <td> Featured: </td>
                <td><input type="radio" name="featured" value="Yes">Yes</td>
                <td> <input type="radio" name="featured" value="No">No</td>
            </tr>

            <tr>
                <td> Active: </td>
                <td><input type="radio" name="active" value="Yes">Yes</td>
                <td><input type="radio" name="active" value="No">No </td>           
            
            </tr>           
           
        </table>  
        

        <input type="submit" name="submit" value="Add Food" class="btn-secondary btn-add-admin">
    </form>
</div>
</div>

<!-- main content ends -->

<!-- php script to add food -->

<?php

if(isset($_POST['submit'])){
    $title=mysqli_real_escape_string($conn,$_POST['title']);
    $category=mysqli_real_escape_string($conn,$_POST['category']);
    $price=mysqli_real_escape_string($conn,$_POST['price']);
    $description=mysqli_real_escape_string($conn,$_POST['description']);

    if(isset($_POST['featured'])){
        $featured=$_POST['featured'];
    }
    else{
        $featured='No';
    }

    if(isset($_POST['active'])){
        $active=$_POST['active'];
    }
    else{
        $active='No';
    }

    if(isset($_FILES['image']['name'])){
        $image_name=$_FILES['image']['name'];

        if($image_name!=""){
            // change image name
            $ext=explode('.',$image_name);
            $image_name="Food-image-".rand(000,999).".".end($ext);

            $src=$_FILES['image']['tmp_name'];
            $dst="../images/food/".$image_name;

            $upload=move_uploaded_file($src,$dst);

            // check if image is uploded successifully


            if($upload==false){
                $_SESSION['img-upload']="<div class='error'>Failed to upload image</div>";
                // redirect to same page
                header("location:".SITEURL.'admin/add-food.php');
                die();
            }

        }        
    }

    else{
        // set image to blank
        $image_name="";
    }


    $sql="INSERT INTO food_tbl SET
    title='$title',
    descriptions='$description',
    price=$price,
    image_name='$image_name',
    category_id='$category',
    featured='$featured',
    active='$active'    
    ";

    $result=mysqli_query($conn,$sql);

    if($result==true){
        $_SESSION['add-food']="<div class='success'>Food added successfuly</div>";
        // redirect to  manage-food page
        header("location:".SITEURL.'admin/manage-food.php');
    }

    else{
        $_SESSION['add-food']="<div class='error'>Request failde</div>";
        // redirect to same page
        header("location:".SITEURL.'admin/add-food.php');
    }

    
}

?>

<?php include 'partials/footer.php';?>