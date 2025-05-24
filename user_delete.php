<?php
 require_once('my_connection.php');
 
//  echo "HEllo";
//  Die();

  if(isset($_GET['id'])){
        $id = $_GET['id'];
 //die();
 
$sql=mysqli_query($my_connection, "UPDATE `users` SET `status`='1' where id = '$id'")  or die(mysqli_error($my_connection));




 header('location:users.php?msg=user_deleted');
}

                                                                               
?>