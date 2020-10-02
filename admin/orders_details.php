<?php
ob_start();
include_once("include/header.php");
require ("include/connect.php");
if(isset($_POST['submit'])){
  
    $cat_name = $_POST['categoryname'];
    $query = "INSERT INTO category (category_name,category_image) VALUES ('$cat_name','$cat_img')";
    mysqli_query($conn,$query);
    header("location:manage_category.php");
}
if (isset($_GET['id'])) {
    
    $query   = "SELECT * FROM category WHERE category_id = {$_GET['id']}";
    $result  = mysqli_query($conn,$query);
    $category= mysqli_fetch_assoc($result);
    header("location:manage_category.php");
    
}
if(isset($_POST['edit'])){
    $cat_img = $category['categoryimage'];
    $cat_name= $_POST['categoryname'];

    if($_FILES['categoryimage']['error']==0){
        $cat_img = $_FILES['categoryimage']['name'];
        $tmp_name= $_FILES['categoryimage']['tmp_name'];
        $path    = 'images/';
        move_uploaded_file($tmp_name, $path.$cat_img);
    }
    $query = "UPDATE category SET category_name = '$cat_name',
                                  category_image= '$cat_img'
                                  WHERE category_id = {$_GET['id2']}";
                                  mysqli_query($conn,$query);
                                  header("location:manage_category.php");
}
if(isset($_GET['id1'])){
    $query = "DELETE FROM category WHERE category_id ={$_GET['id1']} ";
    mysqli_query($conn,$query);
    header("location:manage_category.php");
}
  ?>
    <div class="dashboard-wrapper" style="padding-top: 50px; ">
                        <!-- ============================================================== -->
                        <!-- validation form -->
                        <!-- ============================================================== -->

                   

                        <!-- ============================================================== -->
                        <!-- end validation form -->
                       
                         <div class="row">
                        <!-- ============================================================== -->
                        <!-- contextual table -->
                        <!-- ============================================================== -->
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Order Data</h5>
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr class="table-secondary">
                                               
                                                <th scope="col"> Order ID</th>
                                                <th scope="col">Order Date</th>
                                                <th scope="col">Customer ID</th>
                                                <th scope="col">Product ID</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Total</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query    = "SELECT * FROM orders";
                                            $result   = mysqli_query($conn,$query);

                                           
                                            while($details = mysqli_fetch_assoc($result)){

                                                
                                                echo "<tr>";
                                                echo "<td>{$details['order_id']} </td>";
                                                echo "<td>{$details['order_date']} </td>";
                                                echo "<td>{$details['customer_id']} </td>";
                                                echo "<td>{$details['product_id']} </td>";  
                                                echo "<td>{$details['qty']} </td>";  
                                                echo "<td>{$details['total']} </td>";  

                                             
                                                echo "<tr>";
                                            } 
                                            ?>
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
    </div>



                    <?php 
                    include_once("include/footer.php");

                    ?>