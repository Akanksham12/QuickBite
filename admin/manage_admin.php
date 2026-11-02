<?php include('partials/menu.php'); ?>
    
        <!--Main content starts-->
        <div class="main-content">
            <div class="wrapper">
                <h1>MANAGE ADMIN</h1> 
                <br/><br/>
                <!--button to add admin-->
                <?php
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];   //Displaying Session Message
                        unset($_SESSION['add']);  //Removing Session Message
                    }
                    if(isset($_SESSION['delete'])){
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }


                    if(isset($_SESSION['update'])){
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                        
                    }

                    if(isset($_SESSION['user-not-found'])){
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']);
                    }

                    if(isset($_SESSION['pwd-not-match'])){
                        echo $_SESSION['pwd-not-match'];
                        unset($_SESSION['pwd-not-match']);
                    }

                    if(isset($_SESSION['change-pwd'])){
                        echo $_SESSION['change-pwd'];
                        unset($_SESSION['change-pwd']);
                    }
                ?>
                <br></br>
                <a href="add_admin.php" class="btn_primary">Add admin</a>
                <br/><br />
               
                <table class="tbl_full">
                 
                        <tr>
                            <th>S.No</th>
                            <th >Full name</th>
                            <th>Username</th>
                            <th>Actions</th>
                        </tr>
                    
                    <?php 
                      //Query to get all Admin
                       $sql= "select * from admin_tbl";
                       //Execute The query
                       $res=mysqli_query($conn,$sql);

                       //Check whether the query is executed of Not
                       if($res==TRUE){
                        //Count Rows to check whether we have data in database or not
                        $count=mysqli_num_rows($res); //Function to get all the the rows in the database
                        $sn=1; // create a variable and assign the value
                        //Check number of rows
                        if($count>0){
                             // we have data in databse
                             while($rows=mysqli_fetch_assoc($res)){
                                //using while loop to get all the data from the database
                                //and while loop will run as long as we have data in database

                                //get individual data
                                $id=$rows['id'];
                                $full_name=$rows['full_name'];
                                $user_name=$rows['username'];

                                //Dispaly the values in our table
                                ?>
                                 <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $full_name; ?></td>
                                    <td><?php echo $user_name; ?></td>
                                    <td>
                                    <a href="<?php echo SITEURL; ?>admin/update_password.php?id=<?php echo $id; ?>" class="btn_primary">Change Password</a>
                                    <a href="<?php echo SITEURL; ?>admin/update_admin.php?id=<?php echo $id; ?>" class="btn_secondary">Update Admin</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete_admin.php?id=<?php echo $id; ?>" class="btn_danger">Delete Admin</a>
                                    </td>
                                </tr>
                                <?php 

                            }
                        }
                        else{
                            //We do not have rows in database
                        }
                       }
                    ?>
                    
                    
                    
                </table>
            </div>  
        </div>
        <!--Main content starts-->

<?php include('partials/footer.php'); ?>