<?php
require_once('session_data.php');

?>

<?php
  
    require_once('my_connection.php');

  if(isset($_GET['id'])){
   // echo 'here is  me'; die();
      $item_id = $_GET['id'];
      $select_qry = mysqli_query($my_connection, "SELECT * FROM `items` where id = $item_id") or die(mysqli_error($my_connection));
      $row = mysqli_fetch_assoc($select_qry);
      $get_category_id = $row['category_id'];
      $item_name = $row['item_name'];
       $min_quantity = $row['min_quantity'];
        $unit = $row['unit'];
      }

if(isset($_POST['btnupdate'])){
     $category_id = $_POST['category_id'];
     $item_name = $_POST['item_name'];
     $min_quantity = $_POST['min_quantity'];
      $unit = $_POST['unit'];
    
//die();
        $update_query = mysqli_query($my_connection,"UPDATE `items` SET `category_id`='$category_id',`item_name`='$item_name',`min_quantity`='$min_quantity',`unit`='$unit'  WHERE id = '$item_id'") or die (mysqli_error($my_connection));
    
   
     echo "<script>
    window.location = 'item_add.php?msg=updated';
</script>"; 

 //  header('location:user_registration.php?msg=updated');


      }
      else{
    
     


      }


   

?>
  
<!DOCTYPE html>
<html>
<title>Find Child</title>
    

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
        </head>
        <div class="wrapper">
            <div class="container">
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group pull-right m-t-15">
                          
                        </div>

                        <h4 class="page-title">Update Item</h4>
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
                                            <label class=" control-label">Select Category </label>
                                            <div class="">
                                            <select name="category_id" class="form-control"  tabindex="">
                                               <option value="">Select Category</option>
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
                                                <input type="text" class="form-control" placeholder="" name = "item_name" value="<?php echo $item_name; ?>" required />
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label class=" control-label">Min Quantity</label>
                                            <div class="">
                                                <input type="number" class="form-control" placeholder="" name = "min_quantity" value="<?php echo $min_quantity; ?>"  required/>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label class=" control-label">Unit</label>
                                            <div class="">
                                                <input type="text" class="form-control" placeholder="Enter Unit" name = "unit" value="<?php echo $unit; ?>"  required/>
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
  </script>