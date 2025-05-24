

<?php
require_once('my_connection.php');
if($_POST['asset_id'])
{
$asset_id=$_POST['asset_id']; 
$sql=mysqli_query($my_connection, "select id,po_no from assets 
where id = '$asset_id'");
while($row=mysqli_fetch_array($sql))
{


$id=$row['id'];
$po_no=$row['po_no'];

 // echo '<option value="'.$po_no.'">'.$po_no .'</option>';

 echo '  <input type="number" class="form-control" id="item_id_textbox" name="item_id_textbox" value='.$po_no.' readonly />';
}
}

  
  
?>
