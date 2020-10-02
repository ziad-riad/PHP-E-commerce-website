<?php
session_start();
unset($_SESSION['id']);
header("locaton:pages/login.php/");
?>