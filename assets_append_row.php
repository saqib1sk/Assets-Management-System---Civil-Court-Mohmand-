<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('my_connection.php');
if(isset($_POST['count']))
{
    $count= $_POST['count'];
    $item_no = ($_POST['item_no']+$count)-1;
//echo $count;
?>


<div class="col-md-12" id="edu_data_row<?php echo $count ?>">
  <input type="hidden"  name="row[]" value="<?php echo $count ?>">
  <div class="row">
     <div class="form-group col-md-3">
                                            <label class=" control-label">Select Category </label>
                                            <input class="form-control col-md-3" style="height:30px;" type="text" id="categorySearch" placeholder="Search categories..." onkeyup="filterCategoryDropdown()">
                                            <div class="slider-container">
                                            <!-- <span><a href="category_add.php"><small style="float:right; color:#2e79be;" class="text-muted" >Add Category</small></a></span> -->
                                            <div class="">
                                            <select multiple name="category_id[]" class="form-control category" id="category<?php echo $count ?>" onchange="get_item(<?php echo $count ?>)" tabindex="">
                                               <option value="">Select Category</option>
                                           <?php $select_qry = mysqli_query($my_connection,"select * from categories") or die (mysqli_error($my_connection)); 
                                           while($row=mysqli_fetch_array($select_qry)){
                                            $id =  $row['id'];
                                            $title = $row['title'];
                                            echo "<option value = '$id'>$title</option>";
                                           }
                                           
                                            ?>
                                           </select>
                                            </div>
                                            </div>
                                        </div>

                                            <div class="form-group col-md-2">
                                            <label class=" control-label">Select Item</label>
                                            <input class="form-control col-md-3" style="height:30px;" type="text" id="itemSearch" placeholder="Search Items..." onkeyup="filterCategoryDropdown1()">
                                            <div class="slider-container">
                                            <div class="">
                                            <select multiple name="item_id[]" class="form-control item" id="item<?php echo $count ?>" tabindex="">
                                               <option value="">Select Item</option>
                                           </select>
                                          </div>
                                            </div>
                                        </div>


                                            <div class="form-group col-md-1">
                                            <label class=" control-label">Item ID</label>
                                            <div class="">
                         <input type="number" class="form-control" placeholder="" name = "item_no[]" id="item_no1" value="<?php echo $item_no ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label class=" control-label">Price Per Unit</label>
                                            <div class="">
    <input type="text" class="form-control" id="price<?php echo $count ?>"  onkeyup="Purchase_Price(<?php echo $count ?>)"  name = "price[]"/>
                                            </div>
                                        </div>
                                          <div class="form-group col-md-1">
                                            <label class=" control-label">Quantity</label>
                                            <div class="">
<input type="text" class="form-control" id="quantity<?php echo $count ?>"  onkeyup="Purchase_Price(<?php echo $count ?>)" name = "quantity[]"/>
                                            </div>
                                        </div>
                                           <div class="form-group col-md-2">
                                            <label class=" control-label">Total Amount</label>
                                            <div class="">
                    <input type="text" class="form-control" id="total_amount<?php echo $count ?>" placeholder="" name = "total_amount[]" readonly/>
                                            </div>
                                        </div>
                                         <div class="col-md-1">
                                          <div class="form-group">
                                           <br/>
                                             <button type="button" class="btn btn-danger shadow" onclick="remove_edu(<?php echo $count ?>)"><i
      class="fa fa-minus"></i></button>
                                         </div>
                                         </div>
</div>
</div>
<?php } ?>