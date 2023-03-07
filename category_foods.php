<?php include 'front-end-partials/menu.php';?>

<?php 
    if(isset($_GET['category_id'])){
        $category_id=$_GET['category_id'];

        $sql="SELECT title FROM categories WHERE id=$category_id";
        // execute the query
        $res=mysqli_query($conn,$sql);

        

        $row=mysqli_fetch_assoc($res);
        // fetch the title based on the selected id
        $category_title=$row['title'];

    }
    else{
        header("location:".SITEURL);
    }
   
?>

<section class="search">
    <div class="container">
        <p>Foods on <?php echo $category_title;?></p>
    </div>
</section>



<section class="explore-foods">
    <div class="container">

        <div class="menu-container">
        <h2 class="text-center">Explore Foods</h2>  
        <?php 
        // fetch data from food table
        $foodsql="SELECT * FROM food_tbl WHERE category_id=$category_id";

        // execute the query
        $result=mysqli_query($conn,$foodsql);

        // check if data is available
        if(mysqli_num_rows($result)){
            // get the data
            while($row=mysqli_fetch_assoc($result)){
                $id=$row['id'];
                $title=$row['title'];
                $description=$row['descriptions'];
                $price=$row['price'];
                $image_name=$row['image_name'];

                ?>
                <div class="food-menu">
                    <div class="food-menu-box">
                        <div class="">
                            <?php
                            if($image_name==""){
                                echo "<div class='error'>Image not available</div>";
                            }

                            else{
                                ?>
                                <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?>" alt="" class="food-menu-img  img-responsive">
                                <?php
                            }
                            ?>
                            
                        </div>
                            <div class="food-menu-desc">
                                <p class="food-desc"><?php echo $title; ?></p>
                                <p class="food-price">ksh <?php echo $price; ?></p>
                                <p class="food-desc"><?php echo $description; ?></p>                   
                                <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id?>" class="btn btn-primary">Order now</a>
                            </div>
               
                    </div>
                </div>

                <?php
            }

        }
        else{
            // food not available
            echo "<div class='error'>Food is not availlable</div>";
        }
        
        ?>  
        <div class="clear-fix"></div>
    </div>
    </div>

<?php include 'front-end-partials/footer.php';?>
          
    
    
