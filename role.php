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
        
     $title = $_POST['title'];


$check_qry = mysqli_query($my_connection, "select title from users where title = '$title'") or die (mysqli_error($my_connection));

 $num_rows = mysqli_num_rows($check_qry); 


if($num_rows == 0){
      
      
     $insert_qry = "INSERT INTO `roles`(`title`)
   VALUES ('$title')"; 
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

         

        </head>
        
       
        <!-- End Navigation Bar-->


        <div class="wrapper">
            <div class="container">
            
            
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group pull-right m-t-15">
                          
                        </div>

                        <h4 class="page-title">Add Role</h4>
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

                                        <div class="form-group col-md-4">
                                            <label class=" control-label">Role</label>
                                            <div class="">
                                                <input type="text" class="form-control" placeholder="" name = "title" required />
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
                            <h4 class="m-t-0 header-title"><b>Role List</b></h4>
                            

                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                   <!--  <th>#</th> -->
                                    <th>Role</th>
                                </tr>
                                </thead>


                                <tbody>
                 <?php  $select_qry = mysqli_query($my_connection, "select * from roles where status = '0'") or die(mysqli_error($my_connection));
                                 
                                 $i=1;
                                  while($row = mysqli_fetch_array($select_qry)){
                                    $id = $row['id'];
                                    
                                    echo ' <tr role="row" class="odd">';
                                    
                                    // echo '<td> '.$i++.'</td>';


                                    echo '<td>';

                                echo '    
                                            <div class="media-body">
                                                <h4 class="media-heading"><a href ="role_edit.php?id='.$id.'">'.$row['title'].'</a></h4>
                                                
                                                 

                                                   
                                                   
                         <a  href ="role_delete.php?id='.$id.'" data-toggle="tooltip" data-placement="bottom" title="Delete User" style=""> 
                                <i class="ti-trash" style="font-size:20px; color:red; margin-top:5px; margin-left:0px;"></i>
                               </a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>';

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