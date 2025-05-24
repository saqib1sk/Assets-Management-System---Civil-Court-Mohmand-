<?php
require_once('session_data.php');
require_once('my_connection.php');
    $success = "";
    $subcat_data = "";

    if(isset($_GET['id']) && isset($_GET['p_no']) && isset($_GET['item_id']) && isset($_GET['cat_id'])){
        $asset_id = $_GET['id'];
        $pur_id = $_GET['p_no'];
        $item_id = $_GET['item_id'];
        $cat_id = $_GET['cat_id'];

        $select_qry ="SELECT assets.supplier_id, assets.description, assets.file_path, asset_items.category_id, asset_items.item_id, asset_items.price,
        asset_items.quantity, asset_items.total_amount, asset_items.dated,suppliers.name,items.item_name FROM assets
        JOIN asset_items ON asset_items.asset_id = assets.id
        JOIN suppliers ON suppliers.id = assets.supplier_id
        JOIN items ON items.id = asset_items.item_id
        WHERE assets.id='$asset_id' AND asset_items.category_id='$cat_id' AND asset_items.item_id='$item_id'";
         $run_select_qry = mysqli_query($my_connection,$select_qry);
         $rowData = mysqli_fetch_assoc($run_select_qry);

         $supplier_id = $rowData['supplier_id'];
         $supplier_name=$rowData['name'];
         $description = $rowData['description'];
         $file_path = $rowData['file_path'];
         $category_id = $rowData['category_id'];
         $item_id = $rowData['item_id'];
         $item_name = $rowData['item_name'];
         $price = $rowData['price'];
         $quantity = $rowData['quantity'];
         $total_amount = $rowData['total_amount'];
         $dated = $rowData['dated'];
    }
?>

<!DOCTYPE html>
<html>
<title>Update Record - Add Stock </title>
    

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
//get employees from employees table on department_id
$(document).ready(function()
{
$(".department_id").change(function()
{
  //  alert("hello");
var department_id=$(this).val();
//alert(department_id);
var dataString = 'department_id='+ department_id;
$.ajax
({
type:"POST",
url: "get_employees.php",
data: dataString,
cache: false,
success: function(html)
{
$(".employees_id").html(html);
} 
});
});
});
</script>


        </head>
        
       
        <!-- End Navigation Bar-->


        <div class="wrapper">
            <div class="container">
            
            
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group pull-right m-t-15">
                          
                        </div>

                        <h4 class="page-title"><u>Add Asset Edit</u></h4>
                        <br>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            
                            
                            <div class="row">
                           
                                <div class="col-md-12">
   <form class="" role="form" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                        <div class="form-group col-md-2">
                                            <label class="control-label">Purchase #</label>
                                            <div class="">
                                                <input type="text" class="form-control" name="pur_no" id="pur_no" value="<?php echo $pur_id;?>" readonly></input>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label class="control-label">Dated</label>
                                            <div class="">
                                                <input type="Date" class="form-control" name="demand_date" id="demand_date" value="<?php echo $dated;?>" readonly></input>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label class="control-label">Vendor</label>
                                            <div class="">
                                                <select name="vendor" class="form-control vendor" id="vendor">
                                               <option value="<?php echo $supplier_id;?>" selected><?php echo $supplier_name;?></option>
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

                                        <div class="form-group col-md-2">
                                            <label class="control-label">Item</label>
                                            <div class="">
                                                <select name="item_name" class="form-control department_id" id="item_name">
                                               <option value="<?php echo $item_id;?>" selected><?php echo $item_name;?></option>
                                              </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label class="control-label">Price/Unit</label>
                                            <div class="">
                                            <input type="price" class="form-control" name="price" id="price" value="<?php echo $price;?>" onchange="updateRemQuantity()"></input>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-1">
                                            <label class="control-label">Quantity</label>
                                            <div class="">
                                                <input type="number" class="form-control" name="quantity" id="quantity" value="<?php echo $quantity;?>"></input>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label class="control-label">Total Amount</label>
                                            <div class="">
                                            <input type="t_amount" class="form-control" name="t_amount" id="t_amount" value="<?php echo $total_amount;?>" readonly></input>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="form-group col-md-4">
                                            <label class="control-label">Description</label>
                                            <div class="">
                                            <textarea class="form-control" id="description" name="description"><?php echo $description;?></textarea>
                                            </div>
                                        </div> 
                                        <div class="form-group col-md-3">
                                          <label class=" control-label">Old Image</label>
                                          
                                       <?php
                                          if($file_path=="" || $file_path=="IMAGE NOT YET ADDED"){
                                            echo '<h4><b><u>No Image Added Before</u></b></h4>';
                                          }else{
                                           echo'<img src="'.$file_path.'" id="old_image" name="old_image" style="width:200px; height:200px;">';
                                          }
                                          ?>
                                          
                                        </div>
                                        <div class="form-group col-md-1"></div>
                                        <div class="form-group col-md-3">
                                          <label class=" control-label">Update / New Image</label>
                                                <div class="">
<input id="file" type="file" name="upload_file" onchange="showImage1(event)" t accept="image/*" class="form-control" style="overflow: hidden;" placeholder="Insert Your Image">
<img id="img" class="shadow" style="float:right; border: 1px blue solid; border-radius: 10%; margin-top: 4%" width="130px;" src="assets/images/file.PNG" height="130px" alt="Image">
                                                </div>

                                            </div>
                                        </div>
<label class=" control-label col-m-12"></label>
<div class="form-group" style="float: right;">
<button type="submit" class="btn btn-success waves-effect waves-light m-l-8 btn-md" name ="btnupdate" >UPDATE</button>
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
        </div> <!-- end wrapper -->
        <!-- jQuery  -->
       <?php require_once('jq_files.php'); ?>
        <!--End jQuery  -->    
         <!-- datatable_script_files -->
                <?php require_once('datatable_script_files.php'); ?>
                <!-- End datatable_script_files --> 
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

    function updateRemQuantity() {

        var quantityInput = document.getElementById("quantity");
        var remQuantityInput = document.getElementById("rem_quantity");
        var QuantityFullInput = document.getElementById("quantityfull");

        var quantityValue = parseFloat(quantityInput.value);
        var remQuantityValue = parseFloat(remQuantityInput.value);
        var fullQuantityValue = parseFloat(QuantityFullInput.value);

        // Subtract the value of rem_quantity from quantity
        var remainingQuantity = fullQuantityValue-quantityValue;
        
        // Update the value of the rem_quantity input
        remQuantityInput.value = remainingQuantity;
    }
  </script>