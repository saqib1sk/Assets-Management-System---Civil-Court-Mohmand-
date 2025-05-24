<?php
require_once('session_data.php');

?>

<?php
    require_once('my_connection.php');
    $success = "";
    $subcat_data = "";
    if(isset($_GET['id']) && isset($_GET['item_id']) && isset($_GET['cat_id'])){
         $issue_id = $_GET['id'];
         $item_id = $_GET['item_id'];
         $cat_id = $_GET['cat_id'];


         $select_qry ="SELECT issue_assets.demand_report_no, issue_assets.demand_date, issue_assets.description, issue_assets.file_path, issue_asset_details.quantity_issue, items.id AS item_id, items.item_name,
         departments.id AS dep_id, departments.title AS dep_title, categories.id AS cat_id, categories.title AS cat_title, employees.id AS emp_id, employees.name, asset_available.quantity AS rem_qty FROM issue_assets
         JOIN issue_asset_details ON issue_asset_details.issue_asset_id = issue_assets.id
         JOIN asset_available ON asset_available.id = issue_asset_details.available_asset_id
         JOIN items ON items.id = asset_available.item_id
         JOIN categories ON categories.id = asset_available.category_id
         JOIN departments ON departments.id = issue_assets.department_id
         JOIN employees ON employees.id = issue_assets.employee_id
         WHERE issue_assets.id = '$issue_id' AND items.id='$item_id' AND categories.id = '$cat_id'";

         $run_select_qry = mysqli_query($my_connection,$select_qry);
         $rowData = mysqli_fetch_assoc($run_select_qry);

         $dmd_id = $rowData['demand_report_no'];
         $demand_date = $rowData['demand_date'];
         $description = $rowData['description'];
         $file_path = $rowData['file_path'];
         $quantity_issue = $rowData['quantity_issue'];
         $rem_qty = $rowData['rem_qty'];
         $item_id = $rowData['item_id'];
         $item_name = $rowData['item_name'];
         $dep_id = $rowData['dep_id'];
         $dep_title = $rowData['dep_title'];
         $cat_id = $rowData['cat_id'];
         $cat_title = $rowData['cat_title'];
         $emp_id = $rowData['emp_id'];
         $emp_name = $rowData['name'];

    }
?>
<?php 
if (isset($_POST['btnupdate'])) 
    {
      $demand_report_no = $_POST['demand_no'];
      $demand_date = $_POST['demand_date'];
      $item_id = $_POST['item_name'];
      $qty = $_POST['quantity'];
      $qty_full = $_POST['quantityfull'];
      $qty_rem = $_POST['rem_quantity'];
      $dep_id = $_POST['department_id'];

      $emp_id = $_POST['employee_id'];
      $desc = $_POST['description'];

      //$file = $_POST['upload_file'];
 
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

    $query_a = "UPDATE `issue_assets` SET `department_id`='$dep_id', `employee_id`='$emp_id', `description`='$desc',`file_path`='$path' WHERE `demand_report_no`='$demand_report_no'";
    $run1 = mysqli_query($my_connection, $query_a);

     $query_get_issue_asset_id = "SELECT id FROM issue_assets WHERE demand_report_no='$demand_report_no'";
     $run_query_get_issue_asset_id=mysqli_query($my_connection, $query_get_issue_asset_id);
     $query_get_issue_asset_idData=mysqli_fetch_array($run_query_get_issue_asset_id);
     $get_issue_asset_id = $query_get_issue_asset_idData['id'];

     
     $query_get_asset_available_id = "SELECT available_asset_id FROM issue_asset_details WHERE issue_asset_id='$get_issue_asset_id' LIMIT 1";
     $run_query_get_asset_available_id=mysqli_query($my_connection, $query_get_asset_available_id);
     $query_get_asset_available_idData=mysqli_fetch_array($run_query_get_asset_available_id);
     $get_asset_available_id = $query_get_asset_available_idData['available_asset_id'];


     $query_b = "UPDATE `issue_asset_details` SET `quantity_issue`='$qty' WHERE `issue_asset_id`='$get_issue_asset_id' AND `available_asset_id`='$get_asset_available_id'";
     $run1 = mysqli_query($my_connection, $query_b);


     $query_c = "UPDATE `asset_available` SET `quantity`='$qty_rem' WHERE `id`='$get_asset_available_id' AND `category_id`='$cat_id' AND `item_id`='$item_id'";
     $run1 = mysqli_query($my_connection, $query_c);

      $success = '<div class="alert alert-success alert-block alert-dismissible fade in iconic-alert" role="alert">
                                    <div class="alert-icon">
                                        <span class="gcon gcon-emoji-happy centered-xy"></span>
                                    </div>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><span class="mcon mcon-close"></span></span></button>
                                    <strong>Success!</strong> Record Updated With  Image.
                            </div>';

}
    }
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
     ///////////Insertion in issue_assets table without image
     $query_a = "UPDATE `issue_assets` SET `department_id`='$dep_id', `employee_id`='$emp_id', `description`='$desc' WHERE `demand_report_no`='$demand_report_no'";
     $run1 = mysqli_query($my_connection, $query_a);
 
      $query_get_issue_asset_id = "SELECT id FROM issue_assets WHERE demand_report_no='$demand_report_no'";
      $run_query_get_issue_asset_id=mysqli_query($my_connection, $query_get_issue_asset_id);
      $query_get_issue_asset_idData=mysqli_fetch_array($run_query_get_issue_asset_id);
      $get_issue_asset_id = $query_get_issue_asset_idData['id'];
 
      
      $query_get_asset_available_id = "SELECT available_asset_id FROM issue_asset_details WHERE issue_asset_id='$get_issue_asset_id' LIMIT 1";
      $run_query_get_asset_available_id=mysqli_query($my_connection, $query_get_asset_available_id);
      $query_get_asset_available_idData=mysqli_fetch_array($run_query_get_asset_available_id);
      $get_asset_available_id = $query_get_asset_available_idData['available_asset_id'];
 
 
      $query_b = "UPDATE `issue_asset_details` SET `quantity_issue`='$qty' WHERE `issue_asset_id`='$get_issue_asset_id' AND `available_asset_id`='$get_asset_available_id'";
      $run1 = mysqli_query($my_connection, $query_b);
 
 
      $query_c = "UPDATE `asset_available` SET `quantity`='$qty_rem' WHERE `id`='$get_asset_available_id' AND `category_id`='$cat_id' AND `item_id`='$item_id'";
      $run1 = mysqli_query($my_connection, $query_c);
 
       $success = '<div class="alert alert-success alert-block alert-dismissible fade in iconic-alert" role="alert">
                                     <div class="alert-icon">
                                         <span class="gcon gcon-emoji-happy centered-xy"></span>
                                     </div>
                                     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><span class="mcon mcon-close"></span></span></button>
                                     <strong>Success!</strong> Record Updated.
                             </div>';

  } /// without image insertion close

}
?>

  
<!DOCTYPE html>
<html>
<title>Update Record - Deduct Stock</title>
    

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

                        <h4 class="page-title"><u>Deduct Asset Edit</u></h4>
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
                                            <label class="control-label">Demand #</label>
                                            <div class="">
                                                <input type="text" class="form-control" name="demand_no" id="demand_no" value="<?php echo $dmd_id;?>"readonly></input>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label class="control-label">Dated</label>
                                            <div class="">
                                                <input type="Date" class="form-control" name="demand_date" id="demand_date" value="<?php echo $demand_date;?>" readonly></input>
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
                                            <label class="control-label">Quantity</label>
                                            <div class="">
                                            <input type="hidden" class="form-control" name="quantityfull" id="quantityfull" value="<?php echo $quantity_issue+$rem_qty;?>"></input>
                                                <input type="number" class="form-control" name="quantity" id="quantity" value="<?php echo $quantity_issue;?>" onchange="updateRemQuantity()"></input>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-1">
                                            <label class="control-label">Rem QTY</label>
                                            <div class="">
                                                <input type="number" class="form-control" name="rem_quantity" id="rem_quantity" value="<?php echo $rem_qty;?>" readonly></input>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label class=" control-label">Court/Office/Other</label>
                                            <div class="">
                                            <select name="department_id" class="form-control department_id" id="department_id">
                                               <option value="<?php echo $dep_id;?>"><?php echo $dep_title;?></option>
             <?php $select_qry = mysqli_query($my_connection,"select d.* from departments d ") or die (mysqli_error($my_connection)); 
                                           while($row=mysqli_fetch_array($select_qry)){
                                            $id =  $row['id'];
                                            $title = $row['title'];
                                            echo "<option value = '$id'>$title</option>";
                                           }
                                           
                                            ?>
                                           </select>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label class=" control-label">Receiver Name</label>
                                            <div class="">
                                            <select name="employee_id" class="form-control employees_id"  id="employees_id" tabindex="">
                                            <option value="<?php echo $emp_id;?>"><?php echo $emp_name;?></option>
            
                                           </select>
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