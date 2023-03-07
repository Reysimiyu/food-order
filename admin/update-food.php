<!-- include theheader and footer files-->
<?php include 'partials/header.php';

if(isset($_GET['id'])){
    $id=$_GET['id'];

$sql="SELECT * FROM food_tbl WHERE id=$id";

$res=mysqli_query($conn,$sql);

if(mysqli_num_rows($res)==1){
    $rows=mysqli_fetch_assoc($res);

    // get data for the particular food
    $title=$rows['title'];
    $image_name=$rows['image_name'];
    $description=$rows['descriptions'];
    $current_category=$rows['category_id'];
    $price=$rows['price'];
    $featured=$rows['featured'];
    $active=$rows['active'];
}
else{
    // display message accordingly and redirect to manage foo page
    $_SESSION['no-category']="<div class='error'>No categories found</div>";
    header("location:".SITEURL.'admin/manage-food.php');

}
}
else{
    header("location:".SITEURL.'admin/manage-food.php');

}

?>



<div class="main-content">
   <div class="wrapper">
    <h1>Update Food</h1>
    <?php
    
    ?><br>

    <form action="" method="POST" enctype="multipart/form-data" class="admin-form">
    <?php
    // display an error message if all the form methods are not filled
   
    if (isset($_SESSION['img-upload'])) {
        echo $_SESSION['img-upload'];
        unset($_SESSION['img-upload']);
    }
    if(isset($_SESSION['update-food'])){
        echo $_SESSION['update-food'];
        unset($_SESSION['update-food']);
    }

    if(isset($_SESSION['img-remove'])){
        echo $_SESSION['img-remove'];
        unset($_SESSION['img-remove']);
    }


    ?><br>
        <label for="Title" >Title</label>
        <input type="text" name="title" value="<?php echo $title?>"><br>
        <label for="cat_id">Category</label>
        <select name="category" >
        <!-- php script to fetch active categories from database -->
        <?php 
        $catsql="SELECT * FROM categories WHERE active='Yes'";

        $res=mysqli_query($conn,$catsql);
        if($res==true){
            // check if there are categories in the database
            if(mysqli_num_rows($res)>0){
                while($rows2=mysqli_fetch_assoc($res)){                    
                    $category_title=$rows2['title'];
                    $category_id=$rows2['id'];

                    ?>
                    
                    <option <?php if($current_category==$category_id){echo "selected";}?> 
                    value="<?php echo $category_id;?>"><?php echo $category_title;?></option>                     
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

        <h4>Current Image</h4>
        <!-- displaying current image -->
        <?php
        if($image_name!="") {
            // image available, display the image
            ?>
             <img src="<?php echo SITEURL?>images/food/<?php echo $image_name;?>" width="80px" height="50px"> <br>
            <?php
        }
        else{
            // image not available, dispaly message
            echo "<div class='error'>No uploaded image</div>";
        }


        ?>
       
             <!--uploading new image  -->
        <label for="image">Select image</label>
        <input type="file" name="image" value="<?php echo $image_name?>">
        <label for="description" >Description</label>
        <textarea type="text" name="description" cols="20" rows="5"><?php echo $description;?></textarea><br><br>
        <label for="price">Price</label>
        <input type="number" name="price" value="<?php echo $price?>">  

        <table>
            <tr>
                <td> Featured: </td>
                <td><input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes</td>
                <td> <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No">No</td>
            </tr>

            <tr>
                <td> Active: </td>
                <td><input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes</td>
                <td><input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value="No">No </td>           
            
            </tr>           
           
        </table>  
        
        <input type="hidden" name="id" value="<?php echo $id;?>">
        <input type="hidden" name="current_image" value="<?php echo $image_name;?>">

        <input type="submit" name="submit" value="Update Food" class="btn-secondary btn-add-admin">
    </form>
    <?php 
    if(isset($_POST['submit'])){
        // get data from form fields
        $id=$_POST['id'];
        $title=mysqli_real_escape_string($conn,$_POST['title']);
        $category=mysqli_real_escape_string($conn,$_POST['category']);
        $current_image=$_POST['current_image'];
        $description=mysqli_real_escape_string($conn,$_POST['description']);
        $price=$_POST['price'];
        $featured=$_POST['featured'];
        $active=$_POST['active'];

        // upload new image
        if(isset($_FILES['image']['name'])){
            $new_image=$_FILES['image']['name'];

            // check if image is selected
            if($new_image!==""){
                // image selected, rename and upload the image
                $ext=explode(".",$new_image);
                $new_image="Food-image-".rand(000,999).".".end($ext);

                // now upload the new image
                $src_path=$_FILES['image']['tmp_name'];
                $dest="../images/food/".$new_image;

                $upload=move_uploaded_file($src_path,$dest);

                if($upload==false){
                    $_SESSION['img-update']="<div class='error'>Failed to update image.<div/>";
                    // redirect to manage food page
                    header("location:".SITEURL.'admin/manage-food.php');
                }

                if($current_image!==""){
                    // image available, remove it
                    $remove_path="../images/food/".$current_image;
                    $remove=unlink($remove_path);

                    if($remove==false){
                        $_SESSION['img-remove']="<div class='error'>Failed to update the image</div>";
                        // redirect to the same page
                        header("location:".SITEURL.'admin/update-food.php');
                    }
                }

            }
            else{
                $new_image=$current_image;
            }


        }

        else{
            // no image selected
            $new_image=$current_image;
        }
        

        // sql to update food
        $foodsql="UPDATE food_tbl SET
        title='$title',
        category_id='$category',
        image_name='$new_image',
        descriptions='$description',
        price=$price,
        featured='$featured',
        active='$active'
        WHERE id=$id
        ";       

        // execute query
        $result=mysqli_query($conn,$foodsql);
        // check if query executed or not
        if($result==true){
            // set session message and redirect to the manage food page
            $_SESSION['update-food']="<div class='success'>Food updated successfully</div>";
            
            header("location:".SITEURL.'admin/manage-food.php');
        }
        else{
            //update failled, set session message and redirect to the same page
            $_SESSION['update-food']="<div class='error'>Failed to updated food. </div>";
            
            header("location:".SITEURL.'admin/update-food.php');
        }
    }
    
    ?>
</div>
</div>


<?php include 'partials/footer.php';?>