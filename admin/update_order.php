<?php 
include 'partials/header.php'

?>

<div class="main-content">
    <div class="wrapper">
        <h4>Update Order</h4>
        <br><br>

        <?php 
        if(isset($_GET['id'])){
            $id=$_GET['id'];

            // sql query to get data
            $sql="SELECT * FROM order_tbl WHERE id=$id";

            // execute the query
            $result=mysqli_query($conn,$sql);

            // check if data is avaliable
            if(mysqli_num_rows($result)==1){
                // fetch data
                $row=mysqli_fetch_assoc($result);
                $food=$row['food'];
                $price=$row['price'];
                $quantity=$row['quantity'];
                $order_status=$row['order_status'];
                $customer_name=$row['customer_name'];
                $customer_contact=$row['customer_contact'];
                $customer_email=$row['customer_email'];
                $customer_address=$row['customer_address'];
            }
        }
        else{
            // redirect to manage order page
            header("location:".SITEURL.'nadmin/manage-order.php');
        }
        ?>
        <!-- displaying error message in case update operation fails -->
        <?php 
            if(isset($_SESSION['update-order'])){
                echo $_SESSION['update-order'];
                unset($_SESSION['update-order']);
            }
        ?>

        <form action="" method="post" class="admin-form">
            <p>Food Name:</p><?php echo $food;?>
            <p>Price:</p><?php echo $price;?><br>
            <label for="Quantity">Quantity</label>
            <input type="number" name="qty" value="<?php echo $quantity;?>">
            <label for="Status">Status</label>
            <select name="status">
                <option <?php if($order_status=="Ordered"){echo "selected";}?> value="Ordered">Ordered</option>
                <option <?php if($order_status=="On Delivery"){echo "selected";}?> value="On Delivery">On Delivery</option>
                <option <?php if($order_status=="Delivered"){echo "selected";}?> value="Delivered">Delivered</option>
                <option <?php if($order_status=="Cancelled"){echo "selected";}?> value="Cancelled">Cancelled</option>
            </select><br><br>
            
            <label for="customer Name">Customer Name</label>
            <input type="text" name="customer_name" value="<?php echo $customer_name;?>">
            <label for="customer_contact">Customer contact</label>
            <input type="text" name="customer_contact" value="<?php echo $customer_contact;?>">
            <label for="customer_email">Customer email</label>
            <input type="email" name="customer_email" value="<?php echo $customer_email;?>">
            <label for="customer_address">Customer address</label>
            <textarea name="customer_address" cols="20" rows="5"><?php echo $customer_address;?></textarea>

            <input type="hidden" name="price" value="<?php echo $price;?>">
            <input type="hidden" name="id" value="<?php echo $id;?>">
            <!-- submit button -->
            <input type="submit" name="submit" value="Update Order" class="btn-primary">
        </form>
    </div>
</div>

<!-- php script to update the order -->
<?php 
// check if the button is clicked or not
if(isset($_POST['submit'])){
    // $price=$_POST['price'];
    $qty=$_POST['qty'];
    $status=$_POST['status'];
    $customer_name=mysqli_real_escape_string($conn,$_POST['customer_name']);
    $customer_contact=mysqli_real_escape_string($conn,$_POST['customer_contact']);
    $customer_email=mysqli_real_escape_string($conn,$_POST['customer_email']);
    $customer_address=mysqli_real_escape_string($conn,$_POST['customer_address']);
    // sql query
    $sql2="UPDATE order_tbl SET
    quantity=$qty,
    order_status='$status',
    total=$qty * $price,
    customer_name='$customer_name',
    customer_contact='$customer_contact',
    customer_email='$customer_email',
    customer_address='$customer_address'
    WHERE id=$id    
    ";
   
    // execute the query
    $res=mysqli_query($conn,$sql2);

    // check if the query is executed or not
    if($res==true){
        $_SESSION['update-order']="<div class='success'>order updated successifuly</div>";
        // redirect to manage oreder page
        header("location:".SITEURL.'admin/manage-order.php');
    }

    else{
        $_SESSION['update-order']="<div class='error'>Failed to update category</div>";
        // redirect to update order page
        header("location:".SITEURL.'admin/update_order.php');
    }
}



?>



<?php include 'partials/footer.php'?>