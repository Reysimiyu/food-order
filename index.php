<?php include 'front-end-partials/menu.php';?>

<section class="search">
    <div class="container">
        <form action="<?php echo SITEURL;?>food-search.php" method="post">
            <input type="search" name="search" placeholder="search foods here">
            <input type="submit" value="search" class="btn btn-primary btn-search" >
        </form>
    </div>
</section>
<?php 
if(isset($_SESSION['order'])){
    echo $_SESSION['order'];
    unset($_SESSION['order']);
}
?>

<!-- php script to fetch catgory data from the database -->

<section class="categories">
    <div class="container " >
        <div class="menu-container">
            <h2 class="text-center">Food Categories</h2>
            <?php
            $sql="SELECT * from categories WHERE featured='Yes' AND active='Yes' LIMIT 3";

            $res=mysqli_query($conn,$sql);

            if(mysqli_num_rows($res)>0){
                while($rows=mysqli_fetch_assoc($res)){
                    $id=$rows['id'];
                    $title=$rows['title'];
                    $image_name=$rows['image_name'];

                    ?>
                    <a href="<?php echo SITEURL;?>category_foods.php?category_id=<?php echo $id;?>">
                    <div class="box-3 float-container">
                        <?php 
                        if($image_name==""){
                            echo "<div class='error'>Image is not added.</div>";    

                        }

                        else{
                            ?>
                            <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>" alt="" class="img-responsive">

                            <?php
                        }
                        ?>
                        
                        <h3 class="float-text"><?php echo $title; ?></h3>
                    </div>
                </a>
                

                    <?php
                }
            }
            
            else{
                echo "<div class='error'>No categories added.</div>";
            }
            ?>            
            <div class="clear-fix"></div>
        </div>
    </div>
</section>

<section class="explore-foods">
    <div class="container">

        <div class="menu-container">
        <h2 class="text-center">Explore Foods</h2>  
        <?php 
        // fetch data from food table
        $foodsql="SELECT * FROM food_tbl WHERE featured='Yes' AND active='Yes' LIMIT 6";

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
                                <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id?>" class="btn btn-primary" >Order Now</a>
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