<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>MANAGE CATEGORY</h1>
        <br/><br/>

        <?php 
         
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($SESSION['failed-remove'])){
                echo $SESSION['failed-remove'];
                unset($SESSION['failed-remove']);
            }
            if(isset($_SESSION['remove'])){
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            if(isset($_SESSION['no-category-found'])){
                echo $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);
            }

            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <br><br>
                <!--button to add admin-->
                <a href="<?php echo SITEURL; ?>admin/add_category.php" class="btn_primary">Add Category</a>
                <br/><br />
                <div class="table-responsive">
                    <table class="tbl_full">
                        <tr>
                            <th>S.No</th>
                            <th>Title </th>
                            <th>Image</th>
                            <th>Featured</th>
                            <th>Active</th>
                            <th>Actions</th>
                        </tr> 

                        <?php
                            //Query to create a categories from database
                            $sql="SELECT * FRom tbl_category";

                            //Execute the query
                            $res=mysqli_query($conn,$sql);

                            //Count rows
                            $count=mysqli_num_rows($res);

                            //Create serial numbe variable and assign value as 1;
                            $sn=1;

                            //Check whether we have data in database or not
                            if($count>0){
                                //We have data in database
                                //get the data and display
                                while($row=mysqli_fetch_assoc($res)){
                                    $id=$row['id'];
                                    $title=$row['title'];
                                    $image_name=$row['image_name'];
                                    $featured=$row['featured'];
                                    $active=$row['active'];

                                ?>
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $title; ?></td>

                                    <td>
                                        <?php 
                                        //check whether the image name is available or not 
                                        if($image_name!=""){
                                            //Display the image 
                                            ?>

                                            <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name; ?>" width="100px" alt="">
                                            <?php
                                        }
                                        else{
                                            //Display the message
                                            echo "<div class='error'>Image not added.</div>";
                                        }
                                        ?>
                                    </td>

                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    
                                    <td>
                                    <a href="<?php echo SITEURL; ?>admin/update_category.php?id=<?php echo $id;?>" class="btn_secondary">Update Category</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete_category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name; ?>" class="btn_danger">Delete Category</a>
                                    </td>
                                </tr>

                                <?php
                                }
                            }
                            else{
                                //We do not have data
                                //We'l display the message inside table
                                ?>

                                <tr>
                                    <td colspan="6"><div class="error">No category Added.</div></td>
                                </tr>
                                <?php
                            }
                        ?>

                        
                        
                    </table>
                </div>
</div>
</div>

<?php include('partials/footer.php'); ?>