<?php
require_once('session_data.php');

?>

<?php
    require_once('my_connection.php');
    $success = "";
    $subcat_data = "";
    if(isset($_GET['id'])){
         $issue_item_id = $_GET['id'];

         $select_qry ="";
       //echo $id;
    $select_qry = mysqli_query($my_connection, "SELECT * FROM `issue_assets` where id = $issue_item_id") or die(mysqli_error($my_connection));
    $row = mysqli_fetch_assoc($select_qry);

  //  $get_current_qty = $row['current_qty'];
    $get_assets_id = $row['assets_id'];
    $get_department_id = $row['department_id'];
    $get_employee_id = $row['employee_id'];
    $get_issue_quantity = $row['quantity'];
    $get_issue_date = $row['issue_date'];
    $get_description = $row['description'];

    //'final Current Quantity: ' . $get_final_current_quantity = $get_current_qty - $get_issue_quantity;
   
    }




?>
 <?php if(isset($_POST['btnupdate'])){

$current_qty = $_POST['current_qty'];
$assets_id = $_POST['assets_id'];
$department_id = $_POST['department_id'];
$employee_id = $_POST['employee_id'];
$issue_quantity = $_POST['issue_quantity'];
$issue_date = $_POST['issue_date'];
$description = $_POST['description'];

'final Current Quantity: ' . $final_current_quantity = $current_qty - $issue_quantity;
  

      $file_name =  $_FILES['file_path']['name'];
      if(@$_FILES["file_path"]["name"][0] != null){

      //  echo "here is new file is attached";

         $tmp_name = $_FILES['file_path']['tmp_name'];
       $target_dir = "users_image/".$file_name;

        move_uploaded_file($tmp_name, $target_dir);

        $update_query = mysqli_query($my_connection,"") or die (mysqli_error($my_connection));

        $updtate_qry = "UPDATE `asset_available` SET `quantity`='$final_current_quantity' WHERE asset_id = $assets_id"; 
        mysqli_query($my_connection, $updtate_qry) or die(mysqli_error($my_connection));
    
   
     echo "<script>
    window.location = 'users.php?msg=updated';
</script>"; 



      }
      else{
    
     //ubdate record with out file attached...

         $update_query = mysqli_query($my_connection,"") or die (mysqli_error($my_connection));

         $updtate_qry = "UPDATE `asset_available` SET `quantity`='$final_current_quantity' WHERE asset_id = $assets_id"; 
         mysqli_query($my_connection, $updtate_qry) or die(mysqli_error($my_connection));

     echo "<script>
    window.location = 'users.php?msg=updated';
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
        
         
         <?php require_once('my_header.php'); ?>
        
        <link href="assets/plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" type="text/css" />
           <!-- DataTables link files -->
         <?php require_once('datatable_link_files.php'); ?>
           <!-- DataTables link files end -->

           <script src="dist/jquery.js"></script>
           <script type="text/javascript">
// get quantity from availible_assets table by assets_id
$(document).ready(function()
{
$(".assets").change(function()
{
   
var id=$(this).val();
//alert(id);
var dataString = 'id='+ id;
$.ajax
({
type:"POST",
url: "get_asset_quantity.php",
data: dataString,
cache: false,
success: function(html)
{
$(".current_qty").html(html);
} 
});
});
});
</script>


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

                        <h4 class="page-title">Issue Assets</h4>
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
                                            <label class=" control-label">Select Asset</label>
                                            <div class="">
                                            <select name="assets_id" class="form-control assets"  tabindex="">
                                               <option value="">Select Asset</option>
             <?php $select_qry = mysqli_query($my_connection,"select aa.*,a.item_id,i.item_name from asset_available aa 
                                                              join assets a on aa.asset_id = a.id
                                                              join items i on a.item_id = i.id") or die (mysqli_error($my_connection)); 
                                           while($row=mysqli_fetch_array($select_qry)){
                                            $id =  $row['id'];
                                            $item_name = $row['item_name'];
                                            if($get_assets_id = $id){

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
                                            <label class=" control-label">Current Quantity</label>
                                            <div class="current_qty">
                                            <input type="number" class="form-control" readonly />
                                            
                                            </div>
                                        </div>


                                        <div class="form-group col-md-3">
                                            <label class=" control-label">Issue Quantity</label>
                                            <span ><small style="float:right; color:red; display:none;" id="error_limit" >Quantity exceeds</small></span>
                                            <div class="">
                                                <input type="number" class="form-control " placeholder="" id="issue_qty" name = "issue_quantity" onchange="check_quantity()"  required/>
                                            </div>
                                        </div>
                                   

                                      <div class="form-group col-md-3">
                                            <label class=" control-label">Select Department </label>
                                            <div class="">
                                            <select name="department_id" class="form-control department_id" id="department_id"  tabindex="">
                                               <option value="">Select Department</option>
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

                                        <div class="form-group col-md-3">
                                            <label class=" control-label">Select Employee  </label> <small> (Optional)</small>
                                            <div class="">
                                            <select name="employee_id" class="form-control employees_id"  id="employees_id" tabindex="">
                                               <option value="">Select Employee</option>
            
                                           </select>
                                            </div>
                                        </div>

                                      

                                        <div class="form-group col-md-3">
                                            <label class=" control-label">Date</label>
                                            <div class="">
                                                <input type="date" class="form-control" placeholder="" name = "issue_date" required />
                                            </div>
                                        </div>

                                    


                                    
                                        <div class="form-group col-md-3">
                                            <label class=" control-label">Description</label>
                                            <div class="">
                                                <textarea  type="text" class="form-control" placeholder="" name = "description" required rows="" cols=""></textarea>
                                            </div>
                                        </div>

                                      

                                        <div class="form-group col-md-3">
                                          <label class=" control-label"></label>
                                                <div class="">                                                                                            
                                                    <!-- <input type="file" name = "upload_file" value = "" /> -->
<input id="file" type="file" name="upload_file" onchange="showImage1(event)" t accept="image/*" class="form-control" style="overflow: hidden;" placeholder="Insert Your Image">
<img id="img" class="shadow" style="float:right; border: 1px blue solid; border-radius: 10%; margin-top: 4%" width="130px;" src="assets/images/file.PNG" height="130px" alt="Image">
                                                </div>

                                            </div>


                                            <!-- <div class="form-group col-md-4">
                                            <label class=" control-label">Minimum Quantity</label>
                                            <div class="">
                                                <input type="text" class="form-control" placeholder="" name = "min_quantity" required />
                                            </div>
                                        </div> -->


                                    

                                         <!-- <div class="form-group col-md-4">
                                          <label class=" control-label">         </label>
                                                
                                                <div class="">                                                                                            
                                                    <input type="file" name = "upload_file" value = "" />
                                     
         
                                                </div>

                                            </div> -->
                                                </div>
                                        
                                        
<label class=" control-label col-m-12"></label>
<div class="form-group" style="float: right;">
<button type="submit" class="btn btn-success waves-effect waves-light m-l-8 btn-md" name ="btnsave" >ADD</button>
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

  function check_quantity() {
   // alert();
    var issue_qty = parseInt($('#issue_qty').val());
    var available_qty = parseInt($('#current_qty').val());

    if (issue_qty > available_qty) {
      //  alert("Sorry, quantity exceeds the available limit.");
        $('#issue_qty').css('border-color', 'red');
        $('#error_limit').css('display', 'block');
        $('#issue_qty').val('');
    } else {
       // alert("Yes, quantity is available.");
        $('#issue_qty').css('border-color', 'silver');
        $('#error_limit').css('display', 'none');
    }
}
  </script>