<?php
ob_start();
include_once("include/header.php");
require ("include/connect.php");

if(isset($_POST['submit'])){
    $pro_image = $_FILES['productimage']['name'];
    $random    = $pro_image;
    $tmp_name  = $_FILES['productimage']['tmp_name'];
    $path      = 'images/';

    move_uploaded_file($tmp_name,$path.$random);

    $pro_name  = $_POST['productname'];
    $pro_price = $_POST['productprice'];
    $pro_desc  = $_POST['productdescription'];
    $cat_name  = $_POST['select'];
    


    $query     = "INSERT INTO pending_product (pro_name,pro_price,pro_desc,pro_image,category_id) VALUES ('$pro_name','$pro_price','$pro_desc','$pro_image',$cat_name)";
    mysqli_query($conn,$query);
    header("location:vendor_dashboard.php"); 
 }
 if (isset($_GET['id'])) {
    $query  = "SELECT * FROM pending_product WHERE pro_id = {$_GET['id']}";
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

   $query = "UPDATE pending_product SET pro_name  = '$pro_name',
                                        pro_price = '$pro_price',
                                        pro_desc  = '$pro_desc',
                                        pro_image = '$pro_image'
                                     WHERE pro_id = {$_GET['id']} ";
                                mysqli_query($conn,$query);
                                header("location:vendor_dashboard.php");
 }
 
 if(isset($_GET['id1'])){
 $query = "DELETE FROM pending_product WHERE pro_id = {$_GET['id1']} ";
 mysqli_query($conn,$query);
 header("location:vendor_dashboard.php");
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
                                                <input type="text" name="productname" class="form-control" id="validationCustom01"  value="<?php if(isset($_GET['id'])){echo $product['pro_name'];} ?>" required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustom02">Product Price </label>
                                                <input type="text" name="productprice" class="form-control"  value="<?php if(isset($_GET['id'])){echo $product['pro_price'];} ?>" required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustom02">Product Description </label>
                                                <input type="text" name="productdescription" class="form-control"  value="<?php if(isset($_GET['id'])){echo $product['pro_desc'];} ?>" required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                               
                                                    <label for="select" class=" form-control-label">Select Category</label>
                                                
                                                
                                                    <select name="select"  class="form-control">
                                                      <!-- php code for select category -->
                                                       <?php
                                                       $se="SELECT * FROM category";
                                                       $try=mysqli_query($conn,$se);

                                                       while ($cat=mysqli_fetch_assoc($try)) {
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
                                                <input type="file" name="productimage" class="form-control"  value="<?php if(isset($_GET['id'])){echo $product['product_image'];} ?>" required>
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
                                                <th scope="col">Vendor name</th>                              
                                                <th scope="col">Product image</th>
                                                <th scope="col">Edit</th>
                                                <th scope="col">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query  = "SELECT * FROM pending_product";
                                            $result = mysqli_query($conn,$query);

                                            $in  = "SELECT category_name FROM category 
                                            INNER JOIN pending_product 
                                            ON pending_product.category_id = category.category_id";
                                            $tryy = mysqli_query($conn,$in);

                                           
                                            while ($product = mysqli_fetch_assoc($result)) {
                                              
                                                $old = mysqli_fetch_assoc($tryy);
                                                
                                                 echo "<tr>";
                                             echo "<td>{$product['pro_id']}</td>";
                                             echo "<td>{$product['pro_name']}</td>";
                                             echo "<td>{$product['pro_price']}</td>";
                                             echo "<td>{$product['pro_desc']}</td>";
                                             echo "<td>{$old['category_name']}</td>"; 
                                                  
                                              echo "<td><img src='images/{$product['pro_image']}' width=150 height=100></td>";
                                             echo "<td><a href='vendor_dashboard.php?id={$product['pro_id']}'><i class='fas fa-edit fa-2x' style='color: rgb(218,165,32)'></i></a></td>";
                                             echo "<td><a href='vendor_dashboard.php?id1={$product['pro_id']}' ><i class='fas fa-trash-alt fa-2x' style='color: red;''></i></a></td>"; 
                                                echo"</tr>";

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