<?php
ob_start();
include_once("include/header.php");
require ("include/connect.php");

if(isset($_POST['submit'])){
    $pro_image = $_FILES['productimage']['name'];
    $random    = $pro_image;
    $tmp_name  = $_FILES['productimage']['tmp_name'];
    $path      = 'images/';

    move_uploaded_file($tmp_name, $path.$random);

    $pro_name  = $_POST['productname'];
    $pro_price = $_POST['productprice'];
    $pro_desc  = $_POST['productdescription'];
    $cat_name  = $_POST['select'];
    $query     = "INSERT INTO product (product_name,product_price,product_desc,product_image,category_id) VALUES ('$pro_name','$pro_price','$pro_desc','$pro_image','$cat_name')";
    mysqli_query($conn,$query);
    header("location:manage_product.php"); 
 }


 if (isset($_GET['id'])) {
    $query  = "SELECT * FROM product WHERE product_id = {$_GET['id']}";
    $result = mysqli_query($conn,$query);
    $product= mysqli_fetch_assoc($result);
     # code ...
 }


 if(isset($_POST['edit'])){
   $pro_name     = $_POST['productname'];
   $pro_price    = $_POST['productprice'];
   $pro_desc     = $_POST['productdescription'];
   $pro_image    = $product['product_image'];
   $cat_name     = $_POST['select'];
if ($_FILES['productimage']['error']==0) {
    # code...
     $pro_image =$_FILES['productimage']['name'];
     $tmp_name   =$_FILES['productimage']['tmp_name'];
     $path       ='images/';

     move_uploaded_file($tmp_name,$path.$pro_image);

}
   $query = "UPDATE product SET product_name  = '$pro_name',
                                product_price = '$pro_price',
                                product_desc  = '$pro_desc',
                                product_image = '$pro_image'
                                WHERE product_id ={$_GET['id']}";
                                mysqli_query($conn,$query);
                                header("location:manage_product.php");
 }


 if(isset($_GET['id1'])){
 $query = "DELETE FROM product WHERE product_id = {$_GET['id1']} ";
 mysqli_query($conn,$query);
 header("location:manage_product.php");
 }

 if(isset($_GET['id2'])){
    $query = "SELECT * FROM pending_product WHERE pro_id = {$_GET['id2']}";
    $res   = mysqli_query($conn,$query);
    $prod  = mysqli_fetch_assoc($res);

 }


 
 if(isset($_GET['id3'])){
   $query1 ="SELECT * FROM pending_product WHERE pro_id={$_GET['id3']}"; 

    $res   = mysqli_query($conn,$query1);
    $prod  = mysqli_fetch_assoc($res);

   $pro_name     = $prod['pro_name'];
   $pro_price    = $prod['pro_price'];
   $pro_desc     = $prod['pro_desc'];
   $pro_image    = $prod['pro_image'];
   $ven_id       = $prod['vendor_id'];
   $cat_id       = $prod['category_id'];

   $query = "INSERT INTO product(product_name,product_price,product_desc,product_image,vendor_id,category_id)
   VALUES ('$pro_name','$pro_price','$pro_desc','$pro_image','$ven_id','$cat_id')";

    //print_r($query);
   // die;
   mysqli_query($conn,$query);

   $query2 = "DELETE FROM pending_product WHERE pro_id={$_GET['id3']}";
   mysqli_query($conn,$query2);

   header("location:manage_product.php");


 }
 if(isset($_GET['id4'])){
 $query = "DELETE FROM pending_product WHERE pro_id = {$_GET['id4']} ";
 mysqli_query($conn,$query);
 header("location:manage_product.php");
 }


  ?>
    <div class="dashboard-wrapper" style="padding-top: 50px; ">
                        <!-- ============================================================== -->
                        <!-- validation form -->
                        <!-- ============================================================== -->
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">PRODUCT EDIT</h5>
                                <div class="card-body">
                                    <form class="needs-validation" method="post" enctype="multipart/form-data" novalidate>
                                        <div class="row">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustom01">Product Name</label>
                                                <input type="text" name="productname" class="form-control" id="validationCustom01"  value="<?php if(isset($_GET['id'])){echo $product['product_name'];} ?>" required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustom02">Product Price </label>
                                                <input type="text" name="productprice" class="form-control" id="validationCustom02" value="<?php if(isset($_GET['id'])){echo $product['product_price'];} ?>" required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustom02">Product Description </label>
                                                <input type="text" name="productdescription" class="form-control" id="validationCustom02" value="<?php if(isset($_GET['id'])){echo $product['product_desc'];} ?>" required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                               
                                                    <label for="select" class=" form-control-label">Select Category</label>
                                                
                                                
                                                    <select name="select" id="select" class="form-control">
                                                      <!-- php code for select category -->
                                                       <?php
                                                       $se="SELECT * FROM category";
                                                       $tryy=mysqli_query($conn,$se);

                                                       while ($cat=mysqli_fetch_assoc($tryy)) {
                                                        echo "<option value='$cat[category_id]'>
                                                        $cat[category_name]</option>";
                                                         
                                                       }


                                                       ?>

                                                    </select>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                            

                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustom02">Product Image </label>
                                                <input type="file" name="productimage" class="form-control" id="validationCustom02" value="<?php if(isset($_GET['id'])){echo $product['product_image'];} ?>" required>
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
                                                <th scope="col">Product id</th>
                                                <th scope="col">Product name</th>
                                                <th scope="col">Product price</th>
                                                <th scope="col">Product description</th>
                                                <th scope="col">Category name</th>
                                                <th scope="col">Product image</th>
                                                <th scope="col">Edit</th>
                                                <th scope="col">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query  = "SELECT * FROM product";
                                            $result = mysqli_query($conn,$query);

                                            $in  = "SELECT category_name FROM category 
                                            INNER JOIN product 
                                            ON product.category_id = category.category_id";
                                            $try = mysqli_query($conn,$in);
                                             
                                            while ($product = mysqli_fetch_assoc($result)) {
                                                # code...
                                              $old = mysqli_fetch_assoc($try);  

                                             echo "<tr>";
                                             echo "<td>{$product['product_id']}</td>";
                                             echo "<td>{$product['product_name']}</td>";
                                             echo "<td>{$product['product_price']}</td>";
                                             echo "<td>{$product['product_desc']}</td>";
                                             echo "<td>{$old['category_name']}</td>";
                                              echo "<td><img src='images/{$product['product_image']}' width=150 height=100 ></td>";
                                             echo "<td><a href='manage_product.php?id={$product['product_id']}'><i class='fas fa-edit fa-2x' style='color: rgb(218,165,32)'></i></a> </td>";
                                             echo "<td><a href='manage_product.php?id1={$product['product_id']}' ><i class='fas fa-trash-alt fa-2x' style='color: red;''></i></a></td>"; 
                                                echo"</tr>";

                                            }

                                            ?>
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                              <div class="dashboard-wrapper">
                         <div class="row">
                        <!-- ============================================================== -->
                        <!-- contextual table -->
                        <!-- ============================================================== -->
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Pending Table</h5>
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr class="table-secondary">
                                                <th scope="col">Product id</th>
                                                <th scope="col">Product name</th>
                                                <th scope="col">Product price</th>
                                                <th scope="col">Product description</th>
                                                <th scope="col">Category name</th>
                                                <th scope="col">Product image</th>
                                                <th scope="col">Edit</th>
                                                <th scope="col">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query1  = "SELECT * FROM pending_product";
                                            $result1 = mysqli_query($conn,$query1);

                                            $inn  = "SELECT category_name FROM category 
                                            INNER JOIN pending_product 
                                            ON pending_product.category_id = category.category_id";
                                            $tryy = mysqli_query($conn,$inn);
                                             
                                            while ($pro = mysqli_fetch_assoc($result1)) {
                                                # code...
                                              $old1 = mysqli_fetch_assoc($tryy);  

                                             echo "<tr>";
                                             echo "<td>{$pro['pro_id']}</td>";
                                             echo "<td>{$pro['pro_name']}</td>";
                                             echo "<td>{$pro['pro_price']}</td>";
                                             echo "<td>{$pro['pro_desc']}</td>";
                                             echo "<td>{$old1['category_name']}</td>";        
                                              echo "<td><img src='images/{$pro['pro_image']}' width=150 height=100 ></td>";
                                             echo "<td><a href='manage_product.php?id3={$pro['pro_id']}'><button type='button' class='btn btn-success'>Accept</button></a> </td>";
                                             echo "<td><a href='manage_product.php?id4={$pro['pro_id']}' ><i class='fas fa-trash-alt fa-2x' style='color: red;''></i></a></td>"; 
                                                echo"</tr>";

                                            }

                                            ?>
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

    </div>



                    <?php 
                    include_once("include/footer.php");

                    ?>