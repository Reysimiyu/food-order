<?php include 'front-end-partials/menu.php';?>

<!DOCTYPE html>
<html lang="en">

<body>

<form action="" method="post">
    title 
    <input type="text" name="title"><br><br>
    price 
    <input type="text" name="price"><br><br>
    quantity 
    <input type="text" name="quantity"><br><br>
    customer_name 
    <input type="text" name="customer_name"><br><br>
    order_status 
    <input type="text" name="order_status"><br><br>
    customer_contact 
    <input type="tel" name="customer_contact"><br><br>
    customer_email 
    <input type="email" name="customer_email"><br><br>
    customer_address 
    <input type="text" name="customer_address"><br><br>
    <input type="submit" name="submit" value="Confirm order">
</form>

<?php
if(isset($_POST['submit'])){    
    $title=$_POST['title'];
    $price=$_POST['price'];
    $quantity=$_POST['quantity'];
    $total=$price*$quantity;
    $order_date=date("Y-m-d h:i:sa");
    $order_status="ordered";
    $customer_name=$_POST['customer_name'];    
    $customer_contact=$_POST['customer_contact'];
    $customer_email=$_POST['customer_email'];
    $customer_address=$_POST['customer_address'];


  

    $sql="INSERT INTO oder ( food, price, quantity, total, 
    order_date, order_status, customer_name, customer_contact, customer_email, customer_address)
    VALUES ( '$title', $price, $quantity, $total, '$order_date', '$order_status', 
    '$customer_name', '$customer_contact', '$customer_email', '$customer_address')";

    $res=mysqli_query($conn,$sql);
    if($res==false){
        echo "an error occured";
    }
}
?>
    
</body>
</html>