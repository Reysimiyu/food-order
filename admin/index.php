<?php include 'partials/header.php';?>

<!-- main content starts -->

<div class="main-content">
    <div class="wrapper">
    <h1>Dashboard</h1><br>
    <?php
    if(isset($_SESSION['user-login'] )){
        echo $_SESSION['user-login'];
        unset($_SESSION['user-login']);
    }
    
    ?>

    <br>
    <a href="<?php echo SITEURL;?>admin/manage-categories.php">
        <div class="col-4 center-text">
            <?php
            // sql query to fetch data from categories table
            $catsql="SELECT * FROM categories"; 
            // execute the query
            $catresult=mysqli_query($conn,$catsql);
            // count the number of categories added
            $cat_count=mysqli_num_rows($catresult);
            ?>
            
            <h5><?php echo $cat_count;?></h5>
            <br>
            <p>Categories</p>
        </div>
        </a>

        <a href="<?php echo SITEURL;?>admin/manage-food.php">    
        <div class="col-4 center-text">
            <?php
            // sql query to fetch data from categories table
            $foodsql="SELECT * FROM food_tbl"; 
            // execute the query
            $foodresult=mysqli_query($conn,$foodsql);
            // count the number of categories added
            $food_count=mysqli_num_rows($foodresult);
            ?>
            
            <h5><?php echo $food_count;?></h5>
            <br>
            <p>Foods</p>
        </div>
        </a>

        <a href="<?php echo SITEURL;?>admin/manage-order.php">  
        <div class="col-4 center-text">
            <?php
            // sql query to fetch data from order table
            $ordersql="SELECT * FROM order_tbl"; 
            // execute the query
            $orderresult=mysqli_query($conn,$ordersql);
            // count the number of categories added
            $order_count=mysqli_num_rows($orderresult);
            ?>
            
            <h5><?php echo $order_count;?></h5>
            <br>
            <p>Orders</p>
        </div>
        </a>


        <div class="col-4 center-text">
            <!-- php script to calculate total revenue generated -->
            <?php 
            // sql query
            $sql="SELECT SUM(total) AS Total FROM order_tbl WHERE order_status='Delivered'";
            // execute the query
            $res=mysqli_query($conn,$sql);
            // fetch data
            $row=mysqli_fetch_assoc($res);
            $total=$row['Total'];


            ?>
            
            <h5>ksh. <?php echo $total;?></h5>
            <br>
            <p>Revenue Generated</p>
        </div>
        <div class="clear-fix"></div>
    </div>
    


</div>

<!-- main content ends -->
<?php include 'partials/footer.php';?>

