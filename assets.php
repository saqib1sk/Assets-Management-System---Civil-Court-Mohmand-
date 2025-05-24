<?php
require_once('session_data.php');

    $warning = '';
    $success = '';
   // $message='';

?>


<?php
    require_once('my_connection.php');
    $warning = '';
    $success = '';
   // $message='';
    if (isset($_POST['btnsave'])) 
    {
      $purchase_order_invoice_no = $_POST['purchase_order_invoice_no'];
      $supplier_id = $_POST['supplier_id'];
      $dated = $_POST['dated'];
      $grand_total_amount = $_POST['grand_total_amount']; 
      $description = $_POST['description']; 
      $check_qry = mysqli_query($my_connection, "SELECT purchase_order_invoice_no from assets where purchase_order_invoice_no = '$purchase_order_invoice_no'") or die (mysqli_error($my_connection));
      $num_rows = mysqli_num_rows($check_qry); 


if($num_rows == 0){
 
 $target_dir = "assets_images/";
  if(@$_FILES["upload_file"]["name"][0] != null){
         
      $file_name =  $_FILES['upload_file']['name']; 
      $file_type = $_FILES['upload_file']['type']; 
      $file_size = $_FILES['upload_file']['size']; 
    $tmp_name = $_FILES['upload_file']['tmp_name'];
    $explode_file_name = explode('.',$file_name); 
    $file_extension = strtolower(end($explode_file_name));
    $file_new_name = uniqid().'.'.$file_extension;
    $path = $target_dir.$file_new_name;





   
      if($file_extension == 'jpg' or $file_extension == 'png'  or $file_extension == 'jpeg'  or $file_extension == 'PNG'  or $file_extension == 'JPG'  or $file_extension == 'JPEG'){
        
        if(move_uploaded_file($tmp_name, $path)){

      ///////////Insertion in assets table
 $query_a = "INSERT INTO `assets`(`purchase_order_invoice_no`, `supplier_id`, `grand_total_amount`, `description`, `file_path`, `dated`)
                          VALUES ('$purchase_order_invoice_no','$supplier_id','$grand_total_amount','$description','$path','$dated')";
     $run1 = mysqli_query($my_connection, $query_a);
     $last_asset_id = mysqli_insert_id($my_connection);

      $success = '<div class="alert alert-success alert-block alert-dismissible fade in iconic-alert" role="alert">
                                    <div class="alert-icon">
                                        <span class="gcon gcon-emoji-happy centered-xy"></span>
                                    </div>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><span class="mcon mcon-close"></span></span></button>
                                    <strong>Success!</strong> Record Inserted With  Image.
                            </div>';


}     //// move file insertion query close
      }   /// check extention close
      else{
$warning = '<div class="alert alert-danger alert-block alert-dismissible fade in iconic-alert" role="alert">
                                <div class="alert-icon">
                                    <span class="gcon gcon-hand centered-xy"></span>
                                </div>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><span class="mcon mcon-close"></span></span></button>
                                <strong>Oh snap!</strong> Image File Not Valid
                            </div>';

      }   /// extention not valid close 
  }    /// file not empty close

  else{
     ///////////Insertion in assets table without image
 $query_b = "INSERT INTO `assets`(`purchase_order_invoice_no`, `supplier_id`, `grand_total_amount`, `description`, `file_path`, `dated`)
                          VALUES ('$purchase_order_invoice_no','$supplier_id','$grand_total_amount','$description','IMAGE NOT YET ADDED','$dated')";
     $run1 = mysqli_query($my_connection, $query_b);
     $last_asset_id = mysqli_insert_id($my_connection);

      $success = '<div class="alert alert-success alert-block alert-dismissible fade in iconic-alert" role="alert">
                                    <div class="alert-icon">
                                        <span class="gcon gcon-emoji-happy centered-xy"></span>
                                    </div>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><span class="mcon mcon-close"></span></span></button>
                                    <strong>Success!</strong> Record Inserted With Out Image.
                            </div>';

  } /// without image insertion close


 $count = COUNT($_POST['category_id']);
      for ($i = 0; $i < $count; $i++) {
        $category_id = $_POST['category_id'][$i];
        $item_id = $_POST['item_id'][$i];
         $item_no = $_POST['item_no'][$i];
          $price = $_POST['price'][$i];
        $quantity = $_POST['quantity'][$i];
         $total_amount = $_POST['total_amount'][$i];
        
       

 /////////////Insertion Of asset_items table
        $query_c = "INSERT INTO `asset_items`(`asset_id`,`category_id`, `item_id`, `item_no`, `price`, `quantity`, `total_amount`, `dated`)
                                      VALUES ('$last_asset_id','$category_id','$item_id','$item_no','$price','$quantity','$total_amount','$dated')";
                             $last_item_no = $item_no;
          
        $run = mysqli_query($my_connection, $query_c);

         $last_asset_items_id = mysqli_insert_id($my_connection);

       $new_code = $last_item_no+1;
  $update = "UPDATE item_id SET item_id = '$new_code'";
   mysqli_query($my_connection, $update);

       
       
/////////////Insertion Of asset_available

 $select_qry = mysqli_query($my_connection, "SELECT * FROM `asset_available` WHERE item_id = '$item_id'") or die(mysqli_error($my_connection));
  $num_rows = mysqli_num_rows($select_qry); 

      if($num_rows != 0 ){

       // echo "yes matched";
       //  echo '<br>';
        $select_qry = mysqli_query($my_connection, "SELECT * FROM `asset_available` where item_id = $item_id") or die(mysqli_error($my_connection));
    $row = mysqli_fetch_assoc($select_qry);
      $get_quantity = $row['quantity']; 
  

     $new_quantity = $get_quantity + $quantity;
     $update_asset_available = "UPDATE `asset_available` SET `quantity`=$new_quantity WHERE `item_id` = $item_id"; 
    mysqli_query($my_connection, $update_asset_available) or die(mysqli_error($my_connection));


      }   /// if asset_available exist close
      else{

         $insert_new_asset_available = "INSERT INTO `asset_available`(`asset_item_id`, `category_id`, `item_id` , `quantity`) VALUES ('$last_asset_items_id','$category_id','$item_id','$quantity')"; 
    mysqli_query($my_connection, $insert_new_asset_available) or die(mysqli_error($my_connection));
         echo "not matched";
         echo '<br>';
      }  /// new insertion asset_available close

} //loop product close




}  /// check query close

else{


     $warning = '<div class="alert alert-danger alert-block alert-dismissible fade in iconic-alert" role="alert">
                                    <div class="alert-icon">
                                        <span class="gcon gcon-hand centered-xy"></span>
                                    </div>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><span class="mcon mcon-close"></span></span></button>
                                    <strong>Oh snap!</strong> Record Already exist
                                </div>';
} 

} // btn add isset post close


?>


  
<!DOCTYPE html>
<html>
    

<?php require_once('my_meta.php'); ?>


    <body>


        <!-- Navigation Bar-->
        <head>
        
         
         <?php require_once('my_header.php'); ?>
        
        <link href="assets/plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" type="text/css" />
           <!-- DataTables link files -->
         <?php require_once('datatable_link_files.php'); ?>
           <!-- DataTables link files end -->

           <script src="dist/jquery.js"></script>

            
  <script type="text/javascript">
      let reorderid = 1;
     
      function orderRow() {
         var item_no1 = $("#item_no1").val();
        reorderid++;
        $.ajax({
          url: 'assets_append_row.php',
          method: 'POST',
          data: {
            'count': reorderid,
            'item_no': item_no1
          },
          success(data) {
            $('#edu_new_row').append(data);
            $('.select2').select2({
              theme: 'bootstrap4'
            });
          }
        });
      }
      function remove_edu(id) {
        let div = '#edu_data_row' + id;
        $(div).remove();
        calculate_grand_total();
        // finaly_Discounts();
      }
    </script>

           <script type="text/javascript">
// get item_name from items table by category_id
// $(document).ready(function()
// {
// $(".category").change(function()
// {
   
// var id=$(this).val();
// //alert(id);
// var dataString = 'id='+ id;
// $.ajax
// ({
// type:"POST",
// url: "get_item.php",
// data: dataString,
// cache: false,
// success: function(html)
// {
// $(".item").html(html);
// } 
// });
// });
// });


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



function Purchase_Price(id) {
        var price = $('#price' + id).val();
        var quantity = $('#quantity' + id).val();
        $('#total_amount' + id).val((quantity * price).toFixed(2));
        calculate_grand_total();
        // finaly_Discounts();
      }
       function calculate_grand_total()
  {
    var grand_total_amount = 0;
    $("input[name^='row']").each(function () {
    var total_amount_input = "#total_amount" + $(this).val();
    grand_total_amount += Number($(total_amount_input).val());
    });
   // $('#paid').val((grand_total_amount).toFixed(2));
    $('#grand_total_amount').val((grand_total_amount).toFixed(2));
  }


 var showImage1 = function(event) {
  var uploadField = document.getElementById("file");
  //alert("hello");
  if (uploadField.files[0].size > 900000) {
  uploadField.value = "";
  Swal.fire(
  'Error !',
  'File Size is too big! Upload logo under 900kB !',
  'error'
  ).then((result) => {
  if (result.isConfirmed) {}
  });
  } else {
  var logoId = document.getElementById('img');
  logoId.src = URL.createObjectURL(event.target.files[0]);
  }
  }



</script>


        </head>
        
       
        <!-- End Navigation Bar-->


        <div class="wrapper" >
            <div class="container">
            
            
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group pull-right m-t-15">
                          
                        </div>

                        <h4 class="page-title">Add Stock</h4>
                        <ol class="breadcrumb">
                        
                        </ol>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box" style="background-color:#a3c3e0;">
                            
                            
                            <div class="row">
                            <?php echo $success; ?>
            <?php echo $warning; ?>

             <?php
                $query = "SELECT * FROM item_id";
                $result = mysqli_query($my_connection, $query);
                $rowData = mysqli_fetch_array($result);
                $last_item_id = $rowData['item_id'];
              ?>
                                <div class="col-md-12">
   <form class="" role="form" method="post" enctype="multipart/form-data">
                                        
                                        
                                        <div class="row">
                                           

                                            <div class="form-group col-md-2">
                                            <label class=" control-label">Purchase No</label>
                                            <div class="">
                                                <input type="text" class="form-control" placeholder="" name = "purchase_order_invoice_no" required />
                                            </div>
                                        </div>

                                          <div class="form-group col-md-2">
                                            <label class=" control-label">Date</label>
                                            <div class="">
                                                <input type="date" class="form-control" placeholder="" name = "dated"/>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-1">
                                            <label class=" control-label">Vendor</label>
                                           <!-- <span><a href="supplier_add.php"><small style="float:right; color:#2e79be;" class="text-muted" >Add Vendor</small></a></span> -->
                                            <div class="">
                                            <select name="supplier_id" class="form-control"  tabindex="">
                                            <option value="">Select Vendor</option>
                                           <?php $select_qry = mysqli_query($my_connection,"select * from suppliers") or die (mysqli_error($my_connection)); 
                                           while($row=mysqli_fetch_array($select_qry)){
                                            $id =  $row['id'];
                                            $name = $row['name'];
                                            echo "<option value = '$id'>$name</option>";
                                           }
                                           
                                            ?>
                                           </select>
                                            </div>
                                        </div>

                                       

                                        </div> <!-- of first row -->


                             <!--    <div class="" style="" id="edu_new_row">
                                <div class="" id="edu_data_row1">
                        <input type="hidden" name="row[]" value="1">
                                          </div>
                                        </div> -->



                                        <div id="edu_new_row">
                                      <div class="" id="edu_data_row1">
                                     <input type="hidden" name="row[]" value="1">

    <div class="form-group col-md-3">
    <label class="control-label">Category</label>
    <input class="form-control col-md-3" style="height:30px;" type="text" id="categorySearch" placeholder="Search categories..." onkeyup="filterCategoryDropdown()">
    <div class="slider-container">
    <div class="">
        <select multiple name="category_id[]" class="form-control category" id="category1" tabindex="" onchange="get_item(1)">
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
</div>

                                       

                                        <div class="form-group col-md-2">
                                            <label class=" control-label">Select Item</label>
                                           <!-- <span><a href="item_add.php"><small style="float:right; color:#2e79be;" class="text-muted" >Add Item</small></a></span> -->
                                           <input class="form-control col-md-2" style="height:30px;" type="text" id="itemSearch" placeholder="Search items..." onkeyup="filterCategoryDropdown1()"> 
                                           <div class="slider-container">
                                           <div class="">
                                            <select multiple name="item_id[]" class="form-control item" id="item1" tabindex="">
                                               <option value="">Select Item</option>
                                           </select>
                                            </div>
                                           </div>
                                        </div>

                                        <div class="form-group col-md-1">
                                            <label class=" control-label">Item ID</label>
                                            <div class="">
               <input type="number" class="form-control" placeholder="" name = "item_no[]" id="item_no1"  value="<?php echo $last_item_id ?>" readonly/>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label class=" control-label">Price/Unit</label>
                                            <div class="">
                                                <input type="text" class="form-control" id="price1" placeholder="" onkeyup="Purchase_Price(1)" name = "price[]"/>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-1">
                                            <label class=" control-label">Quantity</label>
                                            <div class="">
                                                <input type="text" class="form-control" id="quantity1"  onkeyup="Purchase_Price(1)" name = "quantity[]"/>
                                            </div>
                                        </div>

                                          <div class="form-group col-md-2">
                                            <label class=" control-label">T Amount</label>
                                            <div class="">
                                                <input type="text" class="form-control" id="total_amount1" placeholder="" name = "total_amount[]"readonly />
                                            </div>
                                        </div>

                                          <div class="col-md-1">
                                          <div class="form-group">
                                           <br/>
                                            <button type="button" class="btn btn-success" onclick="orderRow()"><i class="fa fa-plus"></i></button>
                                         </div>
                                         </div>
                                       </div>
                                        </div>
  <div style="clear:both;"></div>
  <div class="row">

                                        <div class="form-group col-md-2">
                                            <label class=" control-label">Grand Total Amount</label>
                                            <div class="">
                                                <input type="text" class="form-control" placeholder="" id="grand_total_amount" name = "grand_total_amount" readonly />
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label class=" control-label">Remarks</label>
                                            <div class="">
                                                <input  type="text" class="form-control" placeholder="" name = "description"  rows="" cols=""></input>
                                            </div>
                                        </div>

                                      

                                        <div class="form-group col-md-2">
                                          <label class=" control-label"></label>
                                                <div class="">                                                                                            
                                                    <!-- <input type="file" name = "upload_file" value = "" /> -->
<input id="file" type="file" name="upload_file" onchange="showImage1(event)" t accept="image/*" class="form-control" style="overflow: hidden;" placeholder="Insert Your Image">
<!-- 
<img id="img" class="shadow" style="float:right; border: 1px blue solid; border-radius: 10%; margin-top: 4%" width="130px;" src="assets/images/file.PNG" height="130px" alt="Image">
                                                
                                                --></div>

                                            </div>
<div class="form-group" style="float: right; margin-top:20px; width:148px;">
<button type="submit" class="btn btn-success waves-effect waves-light m-l-8 btn-md" name ="btnsave" style="width:100px;"><b>ADD</b></button>
</div>
                                            </div>
                                        

                                   </form>
                                
                                </div>

                             

                            </div>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive" style="background-color:silver;">
                            <h4 class="m-t-0 header-title"><b>Stock List</b></h4>
                            

                            <table id="datatable" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th width='5%'>S.No</th>
            <th width='5%'>Purchase Invoice</th>
            <th width='5%'>Delivery Date</th>
            <th width='50%'>Vendor</th>
            <th width='10%' >Items Details</th>
            <th width='10%'>Grand Total</th>
            <th width='10%'>Remarks</th>
           
            <th>File</th>
            <!-- <th>Actions</th> -->
        </tr>
    </thead>
    <tbody>
        <?php
        $today = date("Y-m-d");
        $select_qry2 = mysqli_query($my_connection, "SELECT a.*, s.name FROM assets a
                                                    JOIN suppliers s ON a.supplier_id = s.id ORDER BY a.id DESC") or die(mysqli_error($my_connection));
        $n = 1;
        while ($row2 = mysqli_fetch_array($select_qry2)) {
            $id = $row2['id'];
            $p_no=$row2['purchase_order_invoice_no'];
            echo '<tr role="row" class="odd">';
            echo '<td>' . $n++ . '</td>';
            echo '<td class=""><b>' . $row2['purchase_order_invoice_no'] . '</b></td>';
            echo '<td style="width:120px;" class="">' . date("j F, Y", strtotime($row2['dated'])) . '</td>';
            echo '<td class=""><b>' . $row2['name'] . '</b></td>';
            echo '<td class="">';
            echo '<table class="table table-striped table-bordered">';
            echo '<tr>
            <th>Category</th>
            <th>Item</th>';
            //<th>ID</th>
           echo' <th>Price</th>
            <th>Qty</th>
            <th>Amount</th>
            <th>Action</th>
                </tr>';
            $select_qry = mysqli_query($my_connection, "SELECT ai.*,c.title,i.item_name FROM asset_items ai
                                                        join categories c on ai.category_id = c.id
                                                        join items i on ai.item_id = i.id
                                                        WHERE ai.asset_id = $id") or die(mysqli_error($my_connection));
            while ($row = mysqli_fetch_assoc($select_qry)) {
                $category_id = $row['category_id'];
                $title = $row['title'];
                $item_id = $row['item_id'];
                $item_name = $row['item_name'];
                $item_no = $row['item_no'];
                $price = $row['price'];
                $quantity = $row['quantity'];
                $total_amount = $row['total_amount'];
                echo '<tr>
                        <td>' . $title . '</td>
                        <td>'.$item_name . '</td>';
                      //  <td>' .$item_no. '</td>
                       echo' <td>' . $price .  '  </td>
                        <td>' . $quantity . '</td>
                        <td>' . $total_amount . '</td>
                        <td><a href="assets_edit_new.php?id='.$id.'&p_no='.$p_no.'&item_id='.$item_id.'&cat_id='.$category_id.'" title="Edit"><i class="ti-pencil-alt" style="font-size:18px; color:blue; margin-top:10px; margin-left:0px;"></i></a>
                        <a href="" title="Delete"><i class="ti-trash" style="font-size:20px; color:red; margin-top:10px; margin-left:0px;"></i></a></td>
                    </tr>';
            }
            echo '</table>';
            echo '</td>';
           
            echo '<td class="">' . $row2['grand_total_amount'] . '</td>';
            echo '<td class="">' . $row2['description'] . '</td>';
            echo '<td class=""><a href="' . $row2['file_path'] . '" download>Download</a></td>';
            // echo '<td style="width:90px;">';
            // echo 'main edit is here';
            // // <a href="assets_delete.php?id='.$id.'&item_no='.$row2['item_no'].'&quantity='.$row2['quantity'].'&purchase_order_invoice_no='.$row2['purchase_order_invoice_no'].'&price='.$row2['price'].'" data-toggle="tooltip" data-placement="bottom" title="Delete" style="">
            // //     <i class="ti-trash" style="font-size:25px; color:red; margin-top:10px; margin-left:0px;"></i>
            // // </a>';
            // echo '</td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>

                        </div>
                    </div>
                </div>
                
                <!-- Footer -->
                <?php require_once('my_footer.php'); ?>
                <!-- End Footer -->

            </div> <!-- end container -->
        </div> <!-- end wrapper -->
        <!-- jQuery  -->
       <?php require_once('jq_files.php'); ?>
        <!--End jQuery  -->
         <!-- datatable_script_files -->
                <?php require_once('datatable_script_files.php'); ?>
                <!-- End datatable_script_files --> 
<script>
    function filterCategoryDropdown() {
        var input, filter, select, options, i;
        input = document.getElementById('categorySearch');
        filter = input.value.toUpperCase();
        select = document.getElementById('category1');
        options = select.getElementsByTagName('option');

        for (i = 0; i < options.length; i++) {
            if (options[i].textContent.toUpperCase().indexOf(filter) > -1) {
                options[i].style.display = '';
            } else {
                options[i].style.display = 'none';
            }
        }
    }

    function filterCategoryDropdown1() {
    var input, filter, select, options, i;
    input = document.getElementById('itemSearch');
    filter = input.value.toUpperCase();
    select = document.getElementById('item1');
    options = select.getElementsByTagName('option');

    for (i = 0; i < options.length; i++) {
        if (options[i].textContent.toUpperCase().indexOf(filter) > -1) {
            options[i].style.display = '';
        } else {
            options[i].style.display = 'none';
        }
    }
}

</script>
</body>
</html>
