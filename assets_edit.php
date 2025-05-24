<?php 
require_once('session_data.php');
?>

<?php

require_once('my_connection.php');

    $success = "";
    $subcat_data = "";
    if(isset($_GET['id'])){
         $id = $_GET['id'];
       //echo $id;
    $select_qry = mysqli_query($my_connection, "SELECT * FROM `assets` where id = $id") or die(mysqli_error($my_connection));
    $row = mysqli_fetch_assoc($select_qry);
    $get_supplier_id = $row['supplier_id'];
    $purchase_order_invoice_no = $row['purchase_order_invoice_no'];
    $get_category_id = $row['category_id'];
    $get_item_id = $row['item_id'];
    $po_no = $row['po_no'];
    // $item_no = $row['item_no'];
    $unit_price = $row['price'];
    $quantity = $row['quantity'];
    $total_amount = $row['total_amount'];
    $description = $row['description'];
    $dated = $row['dated'];
   
    }




?>
 <?php if(isset($_POST['btnupdate'])){
  $supplier_id = $_POST['supplier_id'];
    $purchase_order_invoice_no = $_POST['purchase_order_invoice_no'];
  $category_id = $_POST['category_id'];
  $item_id = $_POST['item_id'];
  $po_no = $_POST['po_no'];
  // $item_no = $_POST['item_no'];
  $unit_price = $_POST['unit_price'];
  $quantity = $_POST['quantity'];
  $total_amount = $_POST['total_amount'];
  $description = $_POST['description'];
  $dated = $_POST['dated'];

     
      $file_name =  $_FILES['file_path']['name'];
 if(@$_FILES["file_path"]["name"][0] != null){
    $tmp_name = $_FILES['file_path']['tmp_name'];
  $target_dir = "assets_images/".$file_name;
   move_uploaded_file($tmp_name, $target_dir);
   $update_query = mysqli_query($my_connection,"UPDATE `assets` SET `purchase_order_invoice_no`='$purchase_order_invoice_no',`supplier_id`='$supplier_id',`category_id`='$category_id',`po_no`='$po_no',`item_no`=' ',`item_id`='$item_id',`price`='$unit_price',`quantity`='$quantity',`total_amount`='$total_amount',`description`='$description',`file_path`='$target_dir',`dated`='$dated' WHERE id = '$id'") or die (mysqli_error($my_connection));
echo "<script>
window.location = 'assets.php?msg=updated';
</script>"; 

 }
 else{
//ubdate record with out file attached...
    $update_query = mysqli_query($my_connection,"UPDATE `assets` SET `purchase_order_invoice_no`='$purchase_order_invoice_no',`supplier_id`='$supplier_id',`category_id`='$category_id',`po_no`='$po_no',`item_no`=' ',`item_id`='$item_id',`price`='$unit_price',`quantity`='$quantity',`total_amount`='$total_amount',`description`='$description',`dated`='$dated' WHERE id = '$id'") or die (mysqli_error($my_connection));
echo "<script>
window.location = 'assets.php?msg=updated';
</script>"; 
 }
} 

   


?> 
<!DOCTYPE html>
<html>
    

<?php require_once('my_meta.php'); ?>


    <body>


        <!-- Navigation Bar-->
        <head>
        <script src="dist/jquery.js"></script>
        <script type="text/javascript">


// get item_name from items table by category_id
$(document).ready(function()
{
$(".category").change(function()
{
   
var id=$(this).val();
//alert(id);
var dataString = 'id='+ id;
$.ajax
({
type:"POST",
url: "get_item.php",
data: dataString,
cache: false,
success: function(html)
{
$(".item").html(html);
} 
});
});
});
</script>

           <script>  <link rel="stylesheet" href="assets/css/bootstrap-fileupload.min.css" /> </script>
<script src="assets/js/bootstrap-fileupload.js"></script>
        
         
         <?php require_once('my_header.php'); ?>
        
        <link href="assets/plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" type="text/css" />
              <?php require_once('datatable_link_files.php'); ?>
        </head>
        
       
        <!-- End Navigation Bar-->


        <div class="wrapper">
            <div class="container">
            
            
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group pull-right m-t-15">
                            
                        </div>

                        <h4 class="page-title">Edit Stock Details</h4>
                        <ol class="breadcrumb">
                        
                        </ol>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            
                            
                            <div class="row">
                          
                                <div class="col-md-12">
                                <form class="" role="form" method="post" enctype="multipart/form-data">
                                        
                                        
                                        <div class="row">

                                               <div class="form-group col-md-3">
                                            <label class=" control-label"> Purchase Order/Invoice No</label>
                                            <div class="">
                                                <input type="text" class="form-control" placeholder="" value="<?php echo $purchase_order_invoice_no; ?>" name = "purchase_order_invoice_no" required />
                                            </div>
                                        </div>

                                          <div class="form-group col-md-3">
                                            <label class=" control-label">Date</label>
                                            <div class="">
                                                <input type="date" class="form-control" placeholder="" name = "dated" value="<?php echo $dated; ?>" required />
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label class=" control-label">Select Vendor </label>
                                            <div class="">
                                            <select name="supplier_id" class="form-control"  tabindex="">
                                               <option value="">Select Vendor</option>
                                           <?php $select_qry = mysqli_query($my_connection,"select * from suppliers") or die (mysqli_error($my_connection)); 
                                           while($row=mysqli_fetch_array($select_qry)){
                                            $id =  $row['id'];
                                            $name = $row['name'];
                                            if($get_supplier_id == $id){
                                                echo "<option value = '$id' selected>$name</option>";
                                            }else{
                                                echo "<option value = '$id'>$name</option>";
                                            }
                                           
                                           }
                                           
                                            ?>
                                           </select>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label class=" control-label">Select Item Type </label>
                                            <div class="">
                                            <select name="category_id" class="form-control category"  tabindex="">
                                               <option value="">Select Item Type</option>
                                           <?php $select_qry = mysqli_query($my_connection,"select * from categories") or die (mysqli_error($my_connection)); 
                                           while($row=mysqli_fetch_array($select_qry)){
                                            $id =  $row['id'];
                                            $title = $row['title'];
                                            if($get_category_id == $id){
                                                echo "<option value = '$id' selected>$title</option>";
                                            }else{
                                                echo "<option value = '$id'>$title</option>";
                                            }
                                           
                                           }
                                           
                                            ?>
                                           </select>
                                            </div>
                                        </div>


                                        <div class="form-group col-md-3">
                                            <label class=" control-label">Item Name</label>
                                            <div class="">
                                            <select name="item_id" class="form-control item"  tabindex="">
                                            <option value="">Select Category</option>
                                           <?php $select_qry = mysqli_query($my_connection,"select * from items") or die (mysqli_error($my_connection)); 
                                           while($row=mysqli_fetch_array($select_qry)){
                                            $id =  $row['id'];
                                            $item_name = $row['item_name'];
                                            if($get_item_id == $id){
                                                echo "<option value = '$id' selected>$item_name</option>";
                                            }else{
                                                echo "<option value = '$id'>$item_name</option>";
                                            }
                                           
                                           }
                                           
                                            ?>
                                           </select>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label class=" control-label">Item Id</label>
                                            <div class="">
                                                <input type="text" class="form-control" placeholder="" name = "po_no" value="<?php echo $po_no; ?>" required />
                                            </div>
                                        </div>


                                   <!--      <div class="form-group col-md-3">
                                            <label class=" control-label">Item No</label>
                                            <div class="">
                                                <input type="text" class="form-control" placeholder="" name = "item_no" value="<?php echo $item_no; ?>" required />
                                            </div>
                                        </div>
 -->
                                    

                                      
                                        
                                        <div class="form-group col-md-3">
                                            <label class=" control-label">Price Per Unit</label>
                                            <div class="">
                                                <input type="text" class="form-control" placeholder="" name = "unit_price" id="price" value="<?php echo $unit_price; ?>"  required/>
                                            </div>
                                        </div>

                                          <div class="form-group col-md-3">
                                            <label class=" control-label">Quantity</label>
                                            <div class="">
                                                <input type="text" class="form-control" placeholder="" name = "quantity" id="quantity" value="<?php echo $quantity; ?>" required onkeyup="calculate_amount()" />
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label class=" control-label">Total Amount</label>
                                            <div class="">
                                                <input type="text" class="form-control" placeholder="" name = "total_amount" id="total_amount" value="<?php echo $total_amount; ?>" required readonly />
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label class=" control-label">Remarks</label>
                                            <div class="">
                                                <textarea  type="text" class="form-control" placeholder="" name = "description" required rows="" cols=""><?php echo $description; ?></textarea>
                                            </div>
                                        </div>


                                        <div class="form-group col-md-3">
                                        <label class="control-label">Old Image</label>
                                          <div class=""> 
                                        <?php 
                                      //  echo "select path from product_images where product_id = '$id'";
                                        $id = $_GET['id'];
                                        $select_qry2 = mysqli_query($my_connection, "select id,file_path from assets where id = '$id'") 
                                        or die(mysqli_error($my_connection));                                
        $num_rows = mysqli_num_rows($select_qry2);
       if($num_rows == 0){
        $file_path = "file_path";
       }
       else{    
       while($row2 = mysqli_fetch_assoc($select_qry2))
           {
            $image_id = $row2['id'];
            $file_path = $row2['file_path'];
            echo '<div class="img-wrap" style=" width:100; height:100;">
    <img src="'.$file_path.'" data-id="'.$image_id.'" width="100" height="100" 
  style="object-fit: fill" alt="Image Not Yet Added"/>
</div>
';   
           }  
           }
            ?>      
                  </div>       
                 </div>

                                         <div class="form-group col-md-3">
                                          <label class=" control-label"> New Image</label>
                                                <div class="">                                                                                            
                                                    <!-- <input type="file" name = "upload_file" value = "" /> -->
<input id="file" type="file" name="file_path" onchange="showImage1(event)" t accept="image/*" class="form-control" style="overflow: hidden;" placeholder="Insert Your Image">
<img id="img" class="shadow" style="float:right; border: 1px blue solid; border-radius: 10%; margin-top: 4%" width="130px;" src="assets/images/child.jpg" height="130px" alt="Image">
                                                </div>

                                            </div>
                                    

                                        
                                                </div>
                                        
                                        
<label class=" control-label col-m-12"></label>
<div class="form-group" style="float: right;">
<button type="submit" class="btn btn-success waves-effect waves-light m-l-8 btn-md" name ="btnupdate" >Update</button>
</div>

                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <?php require_once('my_footer.php'); ?>
                <!-- End Footer -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->
 <!-- jQuery  -->
       <?php require_once('jq_files.php'); ?>
        <!--End jQuery  -->
         <!-- datatable_script_files -->
                <?php require_once('datatable_script_files.php'); ?>
                <!-- End datatable_script_files --> 
        
  <!--inputmask Plugins js -->
        <script src="assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
        <script src="assets/plugins/autoNumeric/autoNumeric.js" type="text/javascript"></script>
          <!--end inputmask Plugins js -->

    </body>

</html>
<script>
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


  function calculate_amount() {
    var price = parseInt($('#price').val());
    var quantity = parseInt($('#quantity').val());
    if (isNaN(quantity)) {
        $('#total_amount').val('');
    } else {
        var total = price * quantity;
        $('#total_amount').val(total);
    }

}
  </script>