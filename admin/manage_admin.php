<?php
ob_start();
include_once("include/header.php");
require ("include/connect.php");
 if (isset($_POST['submit'])) {
 	$email    = $_POST['adminemail'];
 	$password = $_POST['adminpassword'];
 	$name     = $_POST['fullname'];
 	$query    = "INSERT INTO admin(admin_email,admin_password,full_name) VALUES ('$email','$password','$name') ";
 	mysqli_query($conn,$query);
 	header("location:manage_admin.php");
 }
 if(isset($_GET['id'])){

 	$query  = " SELECT * FROM admin WHERE admin_id = {$_GET['id']}";
 	$result = mysqli_query($conn,$query);
 	$admin  = mysqli_fetch_assoc($result);
 }
 if(isset($_POST['edit'])){
    $email    = $_POST['adminemail'];
 	$password = $_POST['adminpassword'];
 	$name     = $_POST['fullname'];
 	$query = "UPDATE admin SET admin_email    = '$email',
 	                           admin_password = '$password',
 	                           full_name      = '$name'
 	                           WHERE admin_id = {$_GET['id']}";
 	                           mysqli_query($conn,$query);
 	                           header("location:manage_admin.php");
 }
 if(isset($_GET['id1'])){

  $query="DELETE FROM admin WHERE admin_id={$_GET['id1']}";
mysqli_query($conn,$query);

header("location: manage_admin.php");
}


  ?>
    <div class="dashboard-wrapper" style="padding-top: 50px; ">
                        <!-- ============================================================== -->
                        <!-- validation form -->
                        <!-- ============================================================== -->
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">ADMIN EDIT</h5>
                                <div class="card-body">
                                    <form class="needs-validation" method="post" enctype="multipart/form-data" novalidate>
                                        <div class="row">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustom01">Admin Email</label>
                                                <input type="text" name="adminemail" class="form-control" id="validationCustom01"  value="<?php  if(isset($_GET['id'])){echo $admin['admin_email'];} ?>"  required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustom02">Admin Password </label>
                                                <input type="password" name="adminpassword" class="form-control" id="validationCustom02" value="<?php  if(isset($_GET['id'])){echo $admin['admin_password'];} ?>" required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <label for="validationCustom02">Full Name</label>
                                                <input type="text" name="fullname" class="form-control" id="validationCustom02" value="<?php  if(isset($_GET['id'])){echo $admin['full_name'];} ?>" required>
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
                                            	<th scope="col">Admin ID</th>
                                                <th scope="col">Admin Email</th>
                                                <th scope="col">Admin Name</th>
                                                <th scope="col">Edit</th>
                                                <th scope="col">Delete</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                         <?php
                                        	$query="SELECT * FROM admin";
                                        	$result=mysqli_query($conn,$query);
                                        	
                                        	while ($admin =mysqli_fetch_assoc($result)) {
                                        	 echo "<tr>";
                                        	 echo "<td>{$admin['admin_id']}</td>";
                                        	 echo "<td>{$admin['admin_email']}</td>";
                                        	 echo "<td>{$admin['full_name']}</td>";
                                        	 echo "<td><a href='manage_admin.php?id={$admin['admin_id']}'><i class='fas fa-edit fa-2x' style='color: 	rgb(218,165,32)'></i></a> </td>";
                                        	 echo "<td><a href='manage_admin.php?id1={$admin['admin_id']}' ><i class='fas fa-trash-alt fa-2x' style='color: red;''></i></a></td>"; 
                                        	 	echo"</tr>";
                                                
                                        	 	# code...
                                        	 } 

                                            ?>
                                                  
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
    </div>
</div>
  <?php 
                    include_once("include/footer.php");
?>