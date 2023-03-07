<?php include 'partials/header.php';?>

<!-- main content starts -->

<div class="main-content">
    <div class="wrapper">
    <h1>Manage Admin</h1>
    <br> 
    <!-- diplay an error if the admin is added successifuly -->
    <?php 
    if(isset($_SESSION['message'])){
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
// check if admin is deleted successifully or not and display an error or success message acprdingly
    if(isset($_SESSION['delete'])){
        echo $_SESSION['delete'];
        unset($_SESSION['delete']);
    }
    // check if admin is updated successifully or not and display an error or success message acprdingly
    if(isset($_SESSION['update'])){
        echo $_SESSION['update'];
        unset($_SESSION['update']);
    }

    if(isset($_SESSION['pwd-change'])){
        echo $_SESSION['pwd-change'];
        unset($_SESSION['pwd-change']);
    }
    ?>
    <br><br>
    <a href="add-admin.php" class="btn-primary">Add Admin</a>
    <br> <br>

    <table class="tbl">
        <tr>
        <th>S No.</th>
        <th>Full Name</th>
        <th>Username</th>
        <th>Actions</th>
        </tr>

        <?php
        // fetching data fro the admin table
        $sql = "SELECT * FROM admin_tbl";

        // execute the query
        $result = mysqli_query($conn, $sql);   
        
        // check if the query is executed or not
        if($result==true){
            // count the number of rows in the admin table
            $count = mysqli_num_rows($result);
            
            // check if there is any data(rows) in the table
            if($count>0){

                $sn = 1;
            // if there is data(rows) loop through them and display them on the page
                while($rows=mysqli_fetch_assoc($result)){  
                
            ?>
            <tr>
                <td><?php echo $sn++?></td>
                <td><?php echo $rows['full_name']?></td>
                <td><?php echo $rows['username']?></td>
                <td>

                <!-- change password url -->

                <a href="<?php echo SITEURL; ?>admin/change-password.php?id=<?php echo $rows['id'];?>"
                    class="btn-secondary">Change Password</a>
                    <!-- url to update page of the particular user id selected -->
                    <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $rows['id'];?>"
                    class="btn-secondary">Update Admin</a>
                    
                     <!-- url to delete page of the particular user id selected -->
                    <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $rows['id'];?>"
                    class="btn-danger">Delete Admin</a>
                </td>
                
            </tr>
        <tr>

            <?php

            }
        }
        else{

        }

        }
        
        
        ?>     
    </table>


    </div>

</div>

<!-- main content ends -->

<?php include 'partials/footer.php';?>