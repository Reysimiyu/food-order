<?php include 'front-end-partials/menu.php';?>

<?php
// fetch the search input from the user
// $search=$_POST['search'];
// securing my website
$search=mysqli_real_escape_string($conn,$_POST['search']);
?>

<section class="search">
    <div class="container">
       <h4>Search on <?php echo $search?></h4>
    </div>
</section>



<section class="explore-foods">
    <div class="container">

        <div class="menu-container">
        <h2 class="text-center">Explore Foods</h2>  
        <?php 
        if($search!=''){

        
            // fetch data from food table
            $foodsql="SELECT * FROM food_tbl WHERE title LIKE '%$search%' OR descriptions LIKE '%$search%'";

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

    }
    else{
        // redirect on the homepage
        header("location:".SITEURL);
    }

        
            ?>  
            <div class="clear-fix"></div>
        </div>
    </div>

<?php include 'front-end-partials/footer.php';?>
          
    
    
