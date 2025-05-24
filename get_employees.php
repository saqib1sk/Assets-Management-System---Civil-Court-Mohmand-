

<?php
require_once('my_connection.php');
if($_POST['department_id'])
{
$department_id=$_POST['department_id']; 
$sql=mysqli_query($my_connection, "select id,name,designation from employees 
where department_id = '$department_id'");
while($row=mysqli_fetch_array($sql))
{


$id=$row['id'];
$name=$row['name'];
$designation=$row['designation'];

 echo '<option value="'.$id.'">'.$name .' / '.$designation.'</option>';

// echo ' <input type="number" class="form-control quantity" value="'.$quantity.'" name = "quantity" readonly />';
}
}

  
  
?>
