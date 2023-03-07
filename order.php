<?php include 'front-end-partials/menu.php';?>
<?php
// check if food id is id
if(isset($_GET['food_id'])){
    // get the foood id
    $food_id=$_GET['food_id'];

    // get data from the food table based on the selected id
    $foodsql="SELECT * FROM food_tbl WHERE id=$food_id";

    // execute the query
    $res=mysqli_query($conn,$foodsql);

    // check if data is avaible
    if(mysqli_num_rows($res)==1){
        // data is avaible
        $rows=mysqli_fetch_assoc($res);
        $title=$rows['title'];
        $price=$rows['price'];
        $image_name=$rows['image_name'];

    }
    else{
        // data is not available
        echo "<div class='error'>Food not available</div>";
    }
}
?>

<div class="orders-page">
    
<form action="" method="POST">
    <fieldset class="field-set">
        <legend>Selected food</legend>

            <div class="food-menu delivery-food-box">
                <div class="food-menu-box">
                    <div class="food-img">
                        <?php
                        // check if the image is available or not
                        if($image_name==""){
                            // image not avalabel display message
                            echo "<div class='error'>Image not available</div>";
                        }
                        else{
                            // image available
                            ?>
                            <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" alt="" class="food-menu-img  img-responsive">
                            <?php
                        }
                        
                        ?>
                
                                
                    </div>
                    <div class="food-menu-desc">
                        <p class="food-price"><?php echo $title;?></p>
                        <input type="hidden" name="title" value="<?php echo $title;?>">
                        <p class="food-price">ksh <?php echo $price;?></p>
                        <input type="hidden" name="price" value="<?php echo $price;?>">
                        <p class="food-desc">Quantinty</p>
                        <input type="number" name="qty" class="food-price"><br>             
                    
                    </div>
                    <div class="clear-fix"></div>
                
                </div>
        
            </div>
        

     </fieldset>

    <div class="delivery-form">
        <fieldset class="field-set">
            <legend>Delivery details</legend>    
            Full Name <br>
            <input type="text" name="full_name" ><br><br>
            Phone Number<br>
            <input type="tel" name="contact" ><br><br>
            Email<br>
            <input type="email" name="client_email" ><br><br>
            Address<br>
            <textarea name="client-address" id="" cols="30" rows="5"></textarea><br><br>
            <input type="submit"  name="submit" value="Confirm Order" class="btn btn-primary">
        </fieldset>
    </div>
</form> 



<!-- php script to submit an order -->
<?php 
// check if the button is clicked or not
if(isset($_POST['submit'])) {
    // get the delivery form datails
    $food_title=$_POST['title'];
    $price=$_POST['price'];
    $quantity=$_POST['qty'];
    $total=$price*$quantity;//total=price time the quantity
    $order_date=date("Y-m-d h:i:sa");
    $status="Ordered";
    $customer_name=$_POST['full_name'];
    $customer_contact=$_POST['contact'];
    $customer_email=$_POST['client_email'];
    $customer_address=$_POST['client-address'];

//    insert data into the database
    $sql="INSERT INTO order_tbl ( food, price, quantity, total, 
    order_date, order_status, customer_name, customer_contact, customer_email, customer_address)
    VALUES ( '$title', $price, $quantity, $total, '$order_date', '$status', 
    '$customer_name', '$customer_contact', '$customer_email', '$customer_address')";

    // execute the query
    $results=mysqli_query($conn,$sql);
    // check if the query is executed successiful or not
    if($results==true){
        $_SESSION['order']="<div class='success text-center'>Your order has been submitted successfully.</div>";
        // redirect to homepage
        header("location:".SITEURL);
    }
    else{
        $_SESSION['order']="<div class='error text-center'>Failed top place the order.</div>";
        // redirect to homepage
        header("location:".SITEURL);
    }    
}


?>
</div>
<?php include 'front-end-partials/footer.php';?>