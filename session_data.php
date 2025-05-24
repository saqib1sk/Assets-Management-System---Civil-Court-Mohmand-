<?php

session_start();
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
if($user_id == "" or $username == ""){
    header("location:login.php");
}

// $Current_date = date('Y-m-d');

// $expiry_date = "2023-06-24";

// if ($Current_date >= $expiry_date) {
// session_destroy();
// // unset($_SESSION['admin_pos']);
//  echo "<script>window.location.href = '../../'; </script>";
//  }

?>