<?php
require_once('session_data.php');
$user_id = $_SESSION['user_id'];

?>

<?php
    require_once('my_connection.php');
    $warning = '';
    $success = '';
   // $message='';
  if(isset($_POST['btnsave'])){
  
     $item_name = $_POST['item_name'];
     $quantity = $_POST['quantity'];
     $description = $_POST['description'];
     $dated = $_POST['dated'];
          $check_qry = mysqli_query($my_connection, "SELECT   `quantity`,`item_name`  FROM `assets` WHERE  quantity = '$quantity' and  item_name = '$item_name' and  description = '$description'") or die (mysqli_error($my_connection));
 $num_rows = mysqli_num_rows($check_qry); 
if($num_rows == 0){
 $insert_qry = "INSERT INTO `assets`(`po_no`,`item_no`, `item_name`, `unit`, `price`, `quantity`, `total_amount`, `description`, `dated`) 
                             VALUES ('$po_no','$item_no','$item_name','$unit','$price','$quantity','$total_amount','$description','$dated')"; 
    mysqli_query($my_connection, $insert_qry) or die(mysqli_error($my_connection));
    $lastInsertID = mysqli_insert_id($my_connection);
    $insert_qry = "INSERT INTO `asset_available`(`asset_id`, `quantity`) VALUES ('$lastInsertID','$quantity')"; 
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

           <script type="text/javascript">

// get user from users table by department_id

$(document).ready(function()
{
$(".country").change(function()
{
var id=$(this).val();
// alert(id);
var dataString = 'id='+ id;



$.ajax
({
type:"POST",
url: "getsub_dept.php",
data: dataString,
cache: false,
success: function(html)
{
$(".city").html(html);
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

                        <h4 class="page-title">Add Demand</h4>
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
                                            <label class=" control-label">Item Name</label>
                                            <div class="">
                                                <input type="text" class="form-control" placeholder="" name = "item_name"  required/>
                                            </div>
                                        </div>

                                       
                                        

                                          <div class="form-group col-md-3">
                                            <label class=" control-label">Quantity</label>
                                            <div class="">
                                                <input type="number" class="form-control" placeholder="" name = "quantity" required />
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label class=" control-label">Date</label>
                                            <div class="">
                                                <input type="date" class="form-control" placeholder="" name = "dated" required />
                                            </div>
                                        </div>
                                      

                                        <div class="form-group col-md-3">
                                            <label class=" control-label">Description</label>
                                            <div class="">
                                                <textarea  type="text" class="form-control" placeholder="" name = "description" required rows="" cols=""></textarea>
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
                            <h4 class="m-t-0 header-title"><b>Assets List</b></h4>
                            

                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Serial #</th>
                                    
                                    
                                  
                                    <th>Item Name</th>
                                    <th>User Name</th>
                                  
                                    <th>Quantity</th>
                                    <th>Date</th>
                                 
                                     <th>Discription</th>
                                    
                                    <!-- <th>File</th> -->
                                    
                                  
                                  <th>Actions</th>
                                </tr>
                                </thead>


                                <tbody>
                 <?php 

                   $today = date("Y-m-d");
              
 $select_qry2 = mysqli_query($my_connection, "select * from user_demand") or die(mysqli_error($my_connection));
                                $n = 1;
                                  while($row2 = mysqli_fetch_array($select_qry2)){
                                  $id = $row2['id'];

                           
                             echo ' <tr role="row" class="odd">';
                                    
                                    echo '<td> '.$n++.'</td>';
                                        
                                
                                           echo  '<td class="">';
                                          echo '<b>'.$row2['item_name'].'</b>';
                                          echo '</td>';

                                          echo  '<td class="">';
                                          echo $row2['user_id'];
                                          echo '</td>';

                                           echo  '<td class="">';
                                          echo $row2['quantity'];
                                          echo '</td>';

                                         

                                           echo  '<td class="">';
                                          echo $row2['demand_date'];
                                          echo '</td>';
                                          
                                            echo  '<td class="">';
                                          echo $row2['description'];
                                          echo '</td>';

                                      




                                          
                                       echo '<td style="width:90px;">';
                                    //  echo '</a>';
                                
                                   echo ' <a href="#" >
                                   
                                        
                             <a  href ="assets_edit.php?id='.$id.'" data-toggle="tooltip" data-placement="bottom" title="Edit" style=""> 
                                <i class="ti-pencil" style="font-size:25px; color:success; margin-top:10px; margin-left:0px;"></i>
                                 </a>
                
                                 ';
                                            echo '</td>';
                                     echo '</tr>';



                                //      &nbsp
                                //      |
                                //      &nbsp
                                //   <a  href ="task_view_history_change.php?id='.$id.'&title='.$title.'" data-toggle="tooltip" data-placement="bottom" title="View History" style=""> 
                                //      <i class="ti-list" style="font-size:30px; color:#54b558; margin-top:10px; margin-left:0px;"></i>
                                //       </a>
                                //      </a>

                            
                          
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