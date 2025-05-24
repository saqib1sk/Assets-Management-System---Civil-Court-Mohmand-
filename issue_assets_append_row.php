<?php
  require_once('my_connection.php');
if(isset($_POST['count']))
{
  $count= $_POST['count'];
   // $item_no = ($_POST['item_no']+$count)-1;
//echo $count;
?>


<div class="col-md-12" id="edu_data_row<?php echo $count ?>">
  <input type="hidden"  name="row[]" value="<?php echo $count ?>">
  <div class="row"><hr>
  <div class="form-group col-md-2">
    <label class="control-label">Category</label>
    <input class="form-control col-md-3" style="height:30px;" type="text" id="categorySearch" placeholder="Search categories..." onkeyup="filterCategoryDropdown()">
    <div class="slider-container">
        <select multiple name="category_id[]" class="form-control category" id="category<?php echo $count ?>" tabindex="" onchange="get_item(<?php echo $count ?>)">
            <option value="">Select Category</option>
            <?php 
                $select_qry = mysqli_query($my_connection, "SELECT * FROM categories ORDER BY title ASC") or die(mysqli_error($my_connection)); 
                while ($row = mysqli_fetch_array($select_qry)) {
                    $id =  $row['id'];
                    $title = $row['title'];
                    echo "<option value='$id'>$title</option>";
                }
            ?>
        </select>
    </div>
</div>
<div class="form-group col-md-2">
                                            <label class=" control-label">Select Item</label>
                                            <input class="form-control col-md-2" type="text" id="search" placeholder="Search items..." onkeyup="filteritems()">
                                            <div class="slider-container">
                                            <div class="">
 <select multiple style="width:164px;" name="item_id[]" class="form-control item" id="item<?php echo $count ?>" onchange="get_asset_quantity(this, <?php echo $count ?>),get_category_id(<?php echo $count ?>)">
                                               <option value="">Select Item</option>
                                           </select>
                                            </div>
                                          </div>
                                        </div>
 

                                        
                                        <div class="form-group col-md-2">
    <label class="control-label">Current Quantity</label>
    <div class="current_qty">
        <input type="number" name="current_qty[]" class="form-control" id="current_qty<?php echo $count ?>" readonly />
    </div>
</div>

                                       <!--  <div class="form-group col-md-2" style="display:block;">
                                            <label class=" control-label">Category Id</label>
                                            <div class="category_id" id="category_id<?php echo $count ?>">
                                            <input type="number" class="form-control category_id" id="category_id<?php echo $count ?>" name="category_id[]" />
                                            
                                            </div>
                                        </div> -->


                                        <div class="form-group col-md-2">
                                            <label class=" control-label">Quantity</label>
                                            <span ><small style="float:right; color:red; display:none;" id="error_limit" >Quantity exceeds</small></span>
                                            <div class="">
                                                <input type="number" class="form-control " placeholder="" id="issue_qty<?php echo $count ?>" name = "issue_qty[]" onchange="check_quantity(<?php echo $count ?>)"/>
                                            </div>
                                        </div>

                                          
                        
 


                                       

                                         
                                         <div class="col-md-1">
                                          <div class="form-group">
                                           <br/>
                                             <button type="button" class="btn btn-danger shadow" onclick="remove_edu(<?php echo $count ?>)"><i
      class="fa fa-minus"></i></button>
                                         </div>
                                         </div>


<script>
function filteritems() {
    var input, filter, select, options, option, i, item_name;
    input = document.getElementById('search');
    filter = input.value.toUpperCase();
    select = document.getElementById('item_id1');
    options = select.getElementsByTagName('option');

    for (i = 0; i < options.length; i++) {
        option = options[i];
        item_name = option.textContent || option.innerText;
        if (item_name.toUpperCase().indexOf(filter) > -1) {
            option.style.display = '';
        } else {
            option.style.display = 'none';
        }
    }
}

function get_item(id) {
    var category_ids = $("#category"+id).val();  // Retrieve an array of selected category IDs
    // Convert the array to a comma-separated string
    var category_id_string = category_ids ? category_ids.join(',') : '';

    $.ajax({
        url: "get_item_simple.php",
        type: "POST",
        data: {
            'category_id': category_id_string  // Send the comma-separated string of IDs
        },
        success: function(data) {
            $("#item"+id).html(data);
        }
    });
}

</script>
  </div>
</div>

<?php } ?>