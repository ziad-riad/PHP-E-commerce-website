<?php
ob_start();
include_once("include/header.php");
require ("include/connect.php");
if(isset($_POST['submit'])){
     $image_name = $_FILES['customerimage']['name'];
     $random     = time().$image_name;
     $tmp_name   = $_FILES['customerimage']['tmp_name'];
     $path       = 'images/';

     move_uploaded_file($tmp_name, $path.$image_name);
     
     $cust_name  = $_POST['customername'];
     $cust_email = $_POST['customeremail'];
     $password   = $_POST['customerpassword'];
     $phone      = $_POST['customerphone'];
     $address    = $_POST['customeraddress'];


     $query = "INSERT INTO customer (customer_name,customer_email,customer_password,customer_phone,customer_address,customer_image)
                              VALUES('$cust_name','$cust_email','$password','$phone','$address','$image_name')";
                              mysqli_query($conn,$query);
                          
                          header("location:manage_customer.php");

}
 if(isset($_GET['id'])){

      $query ="SELECT * FROM customer WHERE customer_id={$_GET['id']}";
      $result= mysqli_query($conn,$query);
      $customer = mysqli_fetch_assoc($result); 

    }
    if(isset($_POST['edit'])){

     $cust_name  = $_POST['customername'];
     $cust_email = $_POST['customeremail'];
     $password   = $_POST['customerpassword'];
     $phone      = $_POST['customerphone'];
     $address    = $_POST['customeraddress'];
     $image_name = $customer['customerimage'];

      if($_FILES['customerimage']['error']==0){
    
     $image_name =$_FILES['customerimage']['name'];
     $tmp_name   =$_FILES['customerimage']['tmp_name'];
     $path       ='images/';

     move_uploaded_file($tmp_name, $path.$image_name);

     }
     $query      = "UPDATE customer SET customer_name     = '$cust_name',
                                        customer_email    = '$cust_email',
                                        customer_password = '$password',
                                        customer_phone    = '$phone',
                                        customer_address  = '$address',
                                        customer_image    = '$image_name'
                                        WHERE customer_id = {$_GET['id']} ";
                                        mysqli_query($conn,$query);
                                        header("location:manage_customer.php");


    }
    if(isset($_GET['id1'])){
        $query = "DELETE FROM customer WHERE customer_id = {$_GET['id1']}";
        mysqli_query($conn,$query);
        header("location:manage_customer.php");
    }


?>
<div class="dashboard-wrapper" style="padding-top: 50px; ">
    <!-- ============================================================== -->
    <!-- validation form -->
    <!-- ============================================================== -->
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">CUSTOMER EDIT</h5>
            <div class="card-body">
                <form class="needs-validation" method="post" enctype="multipart/form-data" novalidate>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                            <label for="validationCustom01">Customer Name</label>
                            <input type="text" name="customername" class="form-control" id="validationCustom01"  value="<?php if(isset($_GET['id'])){echo $customer['customer_name'];} ?>" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                            <label for="validationCustom02">Customer Email </label>
                            <input type="email" name="customeremail" class="form-control" id="validationCustom02" value="<?php if(isset($_GET['id'])){echo $customer['customer_email'];} ?>" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                            <label for="validationCustom02">Customer Password </label>
                            <input type="password" name="customerpassword" class="form-control" id="validationCustom02" value="<?php if(isset($_GET['id'])){echo $customer['customer_password'];} ?>" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                            <label for="validationCustom02">Customer Phone </label>
                            <input type="phone" name="customerphone" class="form-control" id="validationCustom02" value="<?php if(isset($_GET['id'])){echo $customer['customer_phone'];} ?>" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                            <label for="validationCustom02">Customer Address</label>
                            <input type="text" name="customeraddress" class="form-control" id="validationCustom02" value="<?php if(isset($_GET['id'])){echo $customer['customer_address'];} ?>" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                            <label for="validationCustom02">Customer Image </label>
                            <input type="file" name="customerimage" class="form-control" id="validationCustom02" value="<?php if(isset($_GET['id'])){echo $customer['customer_image'];} ?>" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                    </div>

                    <br>
                    <br>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                        <button class="btn-block btn-primary" name="submit" type="submit"style="padding: 10px;">SAVE</button>
                    </div>
                    <br>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                        <button class="btn-block btn-primary" name="edit" type="submit" style="padding: 10px;">EDIT</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<!-- ============================================================== -->
<!-- end validation form -->
<!-- ============================================================== -->
<div class="dashboard-wrapper" style="padding-top: 50px; ">
   <div class="row">
    <!-- ============================================================== -->
    <!-- contextual table -->
    <!-- ============================================================== -->
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Basic Data</h5>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr class="table-secondary">
                            <th scope="col">Customer id</th>
                            <th scope="col">Customer name</th>
                            <th scope="col">Customer email</th>
                            <th scope="col">customer phone</th>
                            <th scope="col">customer address</th>
                            <th scope="col">customer image</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                          $query    = "SELECT * FROM customer";
                          $result   = mysqli_query($conn,$query);
                          
                          while ($customer = mysqli_fetch_assoc($result)) {
                              
                            echo "<tr>";
                            echo "<td>{$customer['customer_id']}</td>";
                            echo "<td>{$customer['customer_name']}</td>";
                            echo "<td>{$customer['customer_email']}</td>";
                            echo "<td>{$customer['customer_phone']}</td>";
                            echo "<td>{$customer['customer_address']}</td>";
                            echo "<td><img src='images/{$customer['customer_image']}' width= 150 height=100 ></td>";
                            echo "<td><a href='manage_customer.php?id={$customer['customer_id']}'><i class='fas fa-edit fa-2x' style='color: rgb(218,165,32)'></i></a> </td>";
                            echo "<td><a href='manage_customer.php?id1={$customer['customer_id']}' ><i class='fas fa-trash-alt fa-2x' style='color: red;''></i></a></td>"; 
                            echo "</tr>";
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