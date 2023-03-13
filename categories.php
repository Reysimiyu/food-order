<?php include 'front-end-partials/menu.php';?>

<section class="search">
    <div class="container">
        <form action="<?php echo SITEURL;?>food-search.php" method="post">
            <input type="search" name="search" placeholder="search foods here">
            <input type="submit" value="search" class="btn btn-primary" >
        </form>
    </div>
</section>
<section class="categories">
    <div class="container " >
        <h2 class="text-center">Food Categories</h2>

        <?php 
        // sql query to fetch all categories where active status is YES
        $sql="SELECT * FROM categories WHERE active='Yes'";
        // execute the query
        $res=mysqli_query($conn,$sql);

        // check if there is data in the table

        if(mysqli_num_rows($res)>0){
            // fetch data from the database
            while($rows=mysqli_fetch_assoc($res)){
                $id=$rows['id'];
                $title=$rows['title'];
                $image_name=$rows['image_name'];

                ?>
                <a href="<?php echo SITEURL;?>category_foods.php?category_id=<?php echo $id;?>">
                    <div class="box-3 float-container">
                        <?php 
                        if($image_name==""){
                            echo "<div class='error'>Image not available</div>";
                        }

                        else{
                            ?>
                                <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name; ?>" class="img-responsive cat-box-3">
                                
                            <?php
                        }
                        ?>
                        
                        <h3 class="float-text"><?php echo $title;?></h3>
                    </div></a>

                <?php
            }

        }
        
        ?>       
        <div class="clear-fix"></div>
    </div>
</section>

<?php include 'front-end-partials/footer.php';?>