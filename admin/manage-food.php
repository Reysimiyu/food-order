<?php include 'partials/header.php';?>

<!-- main content starts -->

<div class="main-content">
    <div class="wrapper">
    <h1>manage foods</h1>

    <br> <br>
    <a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary">Add Food</a>
    <br> <br>
    <?php
    // dispay success or error message after add food operation
    if(isset($_SESSION['add-food'])){
        echo $_SESSION['add-food'];
        unset($_SESSION['add-food']);

    }
    // dispay success or error message after delete food operation
    if(isset($_SESSION['delete-food'])){
        echo  $_SESSION['delete-food'];
        unset($_SESSION['delete-food']);
    }
    // display error message if image is not deleted succesifully
    if(isset($_SESSION['img-delete'])){
        echo  $_SESSION['img-delete'];
        unset($_SESSION['img-delete']);
    }

    // display message if id is not set
    if(isset($_SESSION['no-category'])){
        echo $_SESSION['no-category'];
        unset($_SESSION['no-category']);
    }
    if(isset($_SESSION['update-food'])){
        echo $_SESSION['update-food'];
        unset($_SESSION['update-food']);
        
    }

    if(isset($_SESSION['img-update'])){
        echo $_SESSION['img-update'];
        unset($_SESSION['img-update']);
    }

    ?>
    <br>

    <table class="tbl">
        <tr>
        <th>S No.</th>
        <th>Title</th>
        <th>image</th>
        <th>Price</th>
        <th>Fetured</th>
        <th>Active</th>
        <th>Actions</th>
        </tr>

        <?php
        // create sql query to fetch data from the db
        $sql="SELECT * FROM food_tbl";
        $result=mysqli_query($conn,$sql);

        $sn=1;

        if($result==true){
            if(mysqli_num_rows($result)>0){
                while($rows=mysqli_fetch_assoc($result)){
                    $id=$rows['id'];
                    $title=$rows['title'];
                    $image_name=$rows['image_name'];
                    $price=$rows['price'];
                    $featured=$rows['featured'];
                    $active=$rows['active'];

                    ?>

                    <tr>
                        <td><?php echo $sn++;?></td>
                        <td><?php echo $title;?></td>
                        <td>
                            <?php
                            // check if image is available or not
                            if($image_name!=""){
                                ?>
                                <img src="<?php echo SITEURL?>images/food/<?php echo $image_name;?>" width="80px" height="50px">
                                <?php
                            }
                            else{
                                // display message if image not added
                                echo "<div class='error'>Image not available</div>";
                            }
                            ?>
                            
                        </td>
                        <td><?php echo $price;?></td>
                        <td><?php echo $featured;?></td>
                        <td><?php echo $active;?></td>
                         <td>
                            <a href="<?php echo SITEURL?>admin/update-food.php?id=<?php echo $id;?>"
                            class="btn-secondary">Update Food</a>
                            <a href="<?php echo SITEURL?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>"
                            class="btn-danger">Delete Food</a>
                        </td>
                    </tr>  


                    <?php
                }
            }
            else{
                ?>
                <div class='error'>No foods added</div>          
                
                <?php
            }
        }
        ?>

                 
    </table>

    </div>

</div>

<!-- main content ends -->

<?php include 'partials/footer.php';?>