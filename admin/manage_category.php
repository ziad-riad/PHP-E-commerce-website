<?php
ob_start();
include_once("include/header.php");
require ("include/connect.php");
if(isset($_POST['submit'])){
    
    $cat_img  = $_FILES['categoryimage']['name'];
    $random   = $cat_img;
    $tmp_name = $_FILES['categoryimage']['tmp_name']; 
    $path     = 'images/';

    move_uploaded_file($tmp_name,$path.$random);


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
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">CATEGORY EDIT</h5>
                                <div class="card-body">
                                    <form class="needs-validation" method="post" enctype="multipart/form-data" novalidate>
                                        <div class="row">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustom01">Category Name</label>
                                                <input type="text" name="categoryname" class="form-control"   value="<?php  if(isset($_GET['id'])){echo $category['category_name'];} ?>" required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustom02">Category Image </label>
                                                <input type="file" name="categoryimage" class="form-control"  value="<?php  if(isset($_GET['id'])){echo $category['category_image'];} ?>" required>
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
                                                <button class="btn-block btn-primary"  type="submit" name="edit" style="padding: 10px;">EDIT</button>
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
                                               
                                                <th scope="col">Category id</th>
                                                <th scope="col">Category name</th>
                                                <th scope="col">Category image</th>
                                                <th scope="col">Edit</th>
                                                <th scope="col">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query    = "SELECT * FROM category";
                                            $result   = mysqli_query($conn,$query);
                                            
                                            while($category = mysqli_fetch_assoc($result)){
                                                echo "<tr>";
                                                echo "<td>{$category['category_id']} </td>";
                                                echo "<td>{$category['category_name']} </td>";
                                                echo "<td><img src='images/{$category['category_image']}' width='150' height='100'> </td>";
                                               echo "<td><a href='manage_category.php?id2={$category['category_id']}' ><i class='fas fa-edit fa-2x' style='color: rgb(218,165,32)'></i></a> </td>";
                                                echo "<td><a href ='manage_category.php?id1={$category['category_id']}'><i class='fas fa-trash-alt fa-2x' style='color: red;''></i></a> </td>";

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