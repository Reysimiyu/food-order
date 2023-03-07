<?php include 'partials/header.php';?>

<!-- main content starts -->

<div class="main-content">
    <div class="wrapper">
    <h1>Manage categories</h1>

    <br> <br>
    <a href="<?php echo SITEURL;?>admin/add-category.php" class="btn-primary">Add Category</a>
    <br> <br>

    <?php
    // display an error message if all the form methods are not filled
    if(isset($_SESSION['add-category'])){
        echo $_SESSION['add-category'];
        unset($_SESSION['add-category']);
    }
    // display message to show if category is deleted successifully or not
    if(isset($_SESSION['del-category'])){
        echo $_SESSION['del-category'];
        unset ($_SESSION['del-category']);
    }
    // display message to show if category is updated successifully or not
    if(isset($_SESSION['upt-category'] )){
        echo $_SESSION['upt-category'];
        unset($_SESSION['upt-category'] );
    }
    // display error message if fails to delete category image
    if(isset( $_SESSION['img-delete'])){
        echo  $_SESSION['img-delete'];
        unset( $_SESSION['img-delete']);
    }
    ?><br>

    <table class="tbl">
        <tr>
        <th>S No.</th>
        <th>Title</th>
        <th>Image</th>
        <th>Featured</th>
        <th>Active</th>
        <th>Actions</th>
        </tr>

        <?php
        // create sql query to get data from category table
        
        $sql = "SELECT * FROM categories";

        $result = mysqli_query($conn, $sql);

        $sn = 1;

        if($result==true){
            if(mysqli_num_rows($result)>0){
                while ($rows=mysqli_fetch_assoc($result)) {

                    $id = $rows['id'];
                    $title = $rows['title'];
                    $image_name = $rows['image_name'];
                    $featured = $rows['featured'];
                    $active = $rows['active'];

                    ?>
                    <tr>
                        <td><?php echo $sn++ ?></td>
                        <td><?php echo $title; ?></td>
                        <td>
                            <?php 
                            // check if the image name is set or not
                            if($image_name!=""){
                                ?>
                                <!-- if set display the image -->
                                <img src="<?php echo SITEURL?>images/category/<?php echo $image_name;?>" width="80px" height="50px">
                            <?php
                            }
                            else{
                                // display error message
                                echo "<div class='error'>Image not avillable</div>";
                            }
                            
                            ?>
                            
                        </td>
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id;?>
                            "class="btn-secondary">Update Category</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>
                            "class="btn-danger">Delete Category</a>
                        </td>
                    </tr>


                    <?php
                }
            }
            else{
                ?>
                <div class='error'>No categories added</div>          
                
                <?php
            }
            
        }
        
        ?>

       
       
    </table>
    </div>

</div>

<!-- main content ends -->

<?php include 'partials/footer.php';?>