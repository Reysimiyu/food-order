<?php include 'partials/header.php';?>

<!-- main content starts -->

<div class="main-content">
    <div class="wrapper">
    <h1>Manage orders</h1>
    <br> <br>
    <?php 
    if(isset($_SESSION['update-order'])){
        echo $_SESSION['update-order'];
        unset($_SESSION['update-order']);
    }
    ?>
    <br>
        <table class="tbl">
        <tr>
        <th>S No.</th>
        <th>Food Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total Price</th>
        <th>Date</th>
        <th>Order-status</th>
        <th>Customer Name</th>
        <th>Customer contact</th>
        <th>Customer Email</th>
        <th>Customer Address</th>        
        <th>Actions</th>
        </tr>

        <?php 
        // feth data fro the ider table
        $sql="SELECT * FROM order_tbl ORDER BY id DESC";
        // execute the query
        $result=mysqli_query($conn,$sql);
        
        $sn=1;
        // check if data is available in the database
        if(mysqli_num_rows($result)>0){
            // data is available
            // fetch the data 
            while($rows=mysqli_fetch_assoc($result)){
                $id=$rows['id'];
                $food=$rows['food'];
                $price=$rows['price'];
                $quantity=$rows['quantity'];
                $total=$rows['total'];
                $order_date=$rows['order_date'];
                $order_status=$rows['order_status'];
                $customer_name=$rows['customer_name'];
                $customer_contact=$rows['customer_contact'];
                $customer_email=$rows['customer_email'];
                $customer_address=$rows['customer_address'];

                ?>

                <tr>
                    <td><?php echo $sn++;?></td>
                    <td><?php echo $food;?></td>
                    <td>ksh <?php echo $price;?></td>
                    <td><?php echo $quantity;?></td>
                    <td><?php echo $total;?></td>
                    <td><?php echo $order_date;?></td>

                    <?php 
                    if($order_status=="Ordered"){
                        echo "<td style= 'color:black'>$order_status</td>";

                    }
                    elseif($order_status=="On Delivery"){
                        echo "<td style= 'color:blue' >$order_status</td>";

                    }
                    elseif($order_status=="Delivered"){
                        echo "<td style= 'color:green' >$order_status</td>";

                    }
                    else{
                        echo "<td style= 'color:red' >$order_status</td>";
                    }
                    ?>
                    


                    <td><?php echo $customer_name;?></td>
                    <td><?php echo $customer_contact;?></td>
                    <td><?php echo $customer_email?></td>
                    <td><?php echo $customer_address;?></td>
                    
                    <td>
                        <a href="<?php echo SITEURL;?>admin/update_order.php?id=<?php echo $id?>"class="btn-secondary">Update Order</a>
                        
                    </td>
                </tr>
                <?php

            }
        }
        else
        {
            // data is not available
            echo "<div class='error'>No oedres submitted</div>";

        }

        ?>

       
        
    </table>
    </div>

</div>

<!-- main content ends -->

<?php include 'partials/footer.php';?>