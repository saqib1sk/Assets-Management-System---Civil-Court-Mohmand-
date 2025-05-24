

<?php
require_once('my_connection.php');
if($_POST['item_id'])
{
$item_id=$_POST['item_id']; 
$sql=mysqli_query($my_connection, "select category_id from asset_available 
where id = '$item_id'");
while($row=mysqli_fetch_array($sql))
{


//$id=$row['asset_id'];
$category_id=$row['category_id'];
// echo '<option value="">Select Designation</option>';

echo ' <input type="number" class="form-control category_id" id="category_id" value="'.$category_id.'" name = "category_id" readonly />';

}
}
?>
