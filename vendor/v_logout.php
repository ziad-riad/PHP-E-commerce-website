<?php
session_start();
unset($_SESSION['id']);
header("location:pages/login_vendor.php");
?>