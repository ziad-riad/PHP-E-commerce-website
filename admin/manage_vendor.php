<?php
ob_start();
include_once("include/header.php");
require("include/connect.php");
if(isset($_POST['submit'])){
    $v_email    = $_POST['vendoremail'];
    $v_password = $_POST['vendorpassword'];
    $v_name     = $_POST['vendorname'];

    $query = "INSERT INTO vendor (vendor_email,vendor_password,vendor_name)VALUES('$v_email','$v_password','$v_name')";
    mysqli_query($conn,$query);
    header("location:manage_vendor.php");
}
if(isset($_GET['id'])){
    $query  = "SELECT * FROM vendor WHERE vendor_id ={$_GET['id']}";
    $result = mysqli_query($conn,$query);
    $vendor = mysqli_fetch_assoc($result);
    header("location:manage_vendor.php");

}
if(isset($_POST['edit'])){
    $v_email    = $_POST['vendoremail'];
    $v_password = $_POST['vendorpassword'];
    $v_name     = $_POST['vendorname'];
    
    $query = "UPDATE vendor SET vendor_email    = '$v_email',
                                vendor_password = '$v_password',
                                vendor_name     = '$v_name' 
                                WHERE vendor_id = {$_GET['id2']}";
                                mysqli_query($conn,$query);
                                header("location:manage_vendor.php");
}
if(isset($_GET['id1'])){
    $query = "DELETE FROM vendor WHERE vendor_id = {$_GET['id1']}";
    mysqli_query($conn,$query);
    header("location:manage_vendor.php");
}

  ?>
    <div class="dashboard-wrapper" style="padding-top: 50px; ">
                        <!-- ============================================================== -->
                        <!-- validation form -->
                        <!-- ============================================================== -->
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">VENDOR EDIT </h5>
                                <div class="card-body">
                                    <form class="needs-validation" method="post" enctype="multipart/form-data" novalidate>
                                        <div class="row">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustom01">Vendor Email</label>
                                                <input type="text" name="vendoremail" class="form-control" value="<?php if(isset($_GET['id'])){echo 
                                                    $vendor['vendor_email'];} ?>" required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustom02">Vendor Password </label>
                                                <input type="password" name="vendorpassword" class="form-control"  value="<?php if(isset($_GET['id'])){echo $vendor['vendor_password'];} ?>" required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustom02">Vendor Name</label>
                                                <input type="text" name="vendorname" class="form-control"  value="<?php if(isset($_GET['id'])){echo 
                                                    $vendor['vendor_name'];} ?>" required>
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
                                                <th>Vendor ID</th>
                                                <th>Vendor Name</th>
                                                <th>Vendor Email</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query  = "SELECT * FROM vendor";
                                            $result = mysqli_query($conn,$query);
                                            while ($vendor = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                                echo "<td>{$vendor['vendor_id']}</td>";
                                                echo "<td>{$vendor['vendor_name']}</td>";
                                                echo "<td>{$vendor['vendor_email']}</td>";
                                                echo "<td><a href='manage_vendor.php?id2={$vendor['vendor_id']}' ><i class='fas fa-edit fa-2x' style='color: rgb(218,165,32)'></i></a> </td>";
                                                echo "<td><a href='manage_vendor.php?id1={$vendor['vendor_id']}' ><i class='fas fa-trash-alt fa-2x' style='color: red;'></i></a></td>"; 
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