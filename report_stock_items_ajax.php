
<?php 
require_once('my_connection.php');
if (isset($_POST['cat_id'])) {
    $cat_id = $_POST['cat_id'];
?>
<div class="table-responsive" style="margin-left:10px; margin-right:10px;">
                      <table class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th class="text-center">Serial #</th>
                                    <th>Category</th>
                                    <th>Item Name</th>
                                    <th class="text-center">Unit</th>
                                    <th class="text-center">Minimum Quantity</th>
                                    <th class="text-center">Available Quantity</th>
                                </tr>
                                </thead>
                                <tbody>
                        <?php 
                         $select_qry2 = mysqli_query($my_connection, "SELECT aa.*,c.title as cat_title,i.item_name,i.min_quantity,i.unit from asset_available aa
                         join categories c on aa.category_id = c.id
                         join items i on aa.item_id = i.id WHERE c.id='$cat_id'") or die(mysqli_error($my_connection));
                                                         $n = 1;
                                                         while($row2 = mysqli_fetch_array($select_qry2)){
                                                         $id = $row2['id'];
                                                         $min_qty = $row2['min_quantity'];
                                                         $avail_qty = $row2['quantity'];
                                                         $cat_title  = $row2['cat_title'];
                                                         $item_name = $row2['item_name'];
                                                         $unit = $row2['unit'];
                                                         ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $n++;?></td>
                                                        <td><?php echo $cat_title;?></td>
                                                        <td><?php echo $item_name;?></td>
                                                        <td class="text-center"><?php echo $unit;?></td>
                                                        <td class="text-center"><?php echo $min_qty;?></td>
                                                        <td class="text-center"><strong><?php if($avail_qty<=$min_qty){
                                                           echo '<span style="color:red;">'.$avail_qty.'</span>';
                                                        }else{
                                                            echo $avail_qty;
                                                        }?><strong></td>
                                                    </tr>
                                                         <?php
                                                        
                                                         }
                        ?>
                        </tbody>
                        </table>
                      </div>
<?php
}
?>