<?php
require_once('session_data.php');
?>

<?php
  
    require_once('my_connection.php');
    $warning = '';
    $success = '';
   // $message='';
  if(isset($_POST['btnsave'])){
   // echo 'here is  me'; die();
      $category_id = $_POST['category_id'];
       $item_name = $_POST['item_name'];
        $min_quantity = $_POST['min_quantity'];
         $unit = $_POST['unit'];

$check_qry = mysqli_query($my_connection, "select category_id,item_name from items where category_id = '$category_id' and item_name = '$item_name'") or die (mysqli_error($my_connection));

  $num_rows = mysqli_num_rows($check_qry); 
 //Die();

if($num_rows == 0){ 
$insert_qry = "INSERT INTO `items`(`category_id`, `item_name`, `min_quantity`, `unit`) VALUES ('$category_id','$item_name','$min_quantity','$unit')"; 
mysqli_query($my_connection, $insert_qry) or die(mysqli_error($my_connection));
$success = '<div class="alert alert-success alert-block alert-dismissible fade in iconic-alert" role="alert">
                                    <div class="alert-icon">
                                        <span class="gcon gcon-emoji-happy centered-xy"></span>
                                    </div>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><span class="mcon mcon-close"></span></span></button>
                                    <strong>Success!</strong> Record Inserted.
                            </div>';              
}
else{
$warning = '<div class="alert alert-danger alert-block alert-dismissible fade in iconic-alert" role="alert">
                                    <div class="alert-icon">
                                        <span class="gcon gcon-hand centered-xy"></span>
                                    </div>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><span class="mcon mcon-close"></span></span></button>
                                    <strong>Oh snap!</strong> Record Already exist
                                </div>';  
 

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
        </head>
        <div class="wrapper">
            <div class="container">
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group pull-right m-t-15">
                          
                        </div>

                        <h4 class="page-title">Add Item</h4>
                        <ol class="breadcrumb">
                        
                        </ol>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <div class="row">
                            <?php echo $success; ?>
            <?php echo $warning; ?>
            
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
                                            echo "<option value = '$id'>$title</option>";
                                           }
                                           
                                            ?>
                                           </select>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label class=" control-label">Item Name</label>
                                            <div class="">
                                                <input type="text" class="form-control" placeholder="" name = "item_name"/>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label class=" control-label">Min Quantity</label>
                                            <div class="">
                                                <input type="number" class="form-control" placeholder="" name = "min_quantity"/>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label class=" control-label">Unit</label>
                                            <div class="">
                                                <input type="text" class="form-control" placeholder="Enter Unit" name = "unit"/>
                                            </div>
                                        </div>
                                        
                    
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
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <h4 class="m-t-0 header-title"><b>Item List</b></h4>
                            

                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Serial #</th>
                                    <th>Item Name</th>
                                    <th>Category</th>
                                    <th>Min Quantity</th>
                                    <th>Unit</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>


                                <tbody>
                 <?php 

                   $today = date("Y-m-d");

//                    SELECT t1.*, t2.column_name
// FROM table1 t1
// JOIN table2 t2 ON t1.common_column = t2.common_column;
              
 $select_qry2 = mysqli_query($my_connection, "select i.*,c.title as category_name from items i 
                                              join 
                                              categories as c
                                              on i.category_id = c.id ") or die(mysqli_error($my_connection));
                                $n = 1;
                                  while($row2 = mysqli_fetch_array($select_qry2)){
                                  $id = $row2['id'];

                           
                             echo ' <tr role="row" class="odd">';
                                    
                                    echo '<td> '.$n++.'</td>';
                                        
                                    echo  '<td class="">';
                                    echo '<b>'.$row2['item_name'].'</b>';
                                    echo '</td>';
                                           echo  '<td class="">';
                                          echo '<b>'.$row2['category_name'].'</b>';
                                          echo '</td>';

                                          echo  '<td class="">';
                                          echo $row2['min_quantity'];
                                          echo '</td>';

                                           echo  '<td class="">';
                                          echo $row2['unit'];
                                          echo '</td>';

                                          
                                       echo '<td style="width:90px;">';
                                    //  echo '</a>';
                                
                                   echo ' <a href="#" >
                                   
                                        
                             <a  href ="item_edit.php?id='.$id.'" data-toggle="tooltip" data-placement="bottom" title="Edit" style=""> 
                                <i class="ti-pencil" style="font-size:25px; color:success; margin-top:10px; margin-left:0px;"></i>
                                 </a>
                
                                 ';
                                            echo '</td>';
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