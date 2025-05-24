<?php
require_once('my_connection.php');
if($_POST['category_id'])
{
$category_id=$_POST['category_id']; 
$sql=mysqli_query($my_connection, "select id,item_name from items 
where category_id = '$category_id' ORDER BY item_name ASC");
while($row=mysqli_fetch_array($sql))
{
$id=$row['id'];
$item_name=$row['item_name'];
 echo '<option value="'.$id.'">'.$item_name.'</option>';
// echo ' <input type="number" class="form-control quantity" value="'.$quantity.'" name = "quantity" readonly />';
}
}  
?>