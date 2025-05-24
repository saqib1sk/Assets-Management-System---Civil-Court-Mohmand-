<?php
require_once('session_data.php');
?>
<?php
    require_once('my_connection.php');
    $warning = '';
    $success = '';
   // $message='';
  if(isset($_POST['btnsave'])){
    $title = $_POST['title'];
   
          $check_qry = mysqli_query($my_connection, "SELECT   `title` FROM `categories` WHERE  title = '$title'") or die (mysqli_error($my_connection));
 $num_rows = mysqli_num_rows($check_qry); 
if($num_rows == 0){
 $insert_qry = "INSERT INTO `categories`(`title`)  VALUES ('$title')"; 
    mysqli_query($my_connection, $insert_qry) or die(mysqli_error($my_connection));
    // $lastInsertID = mysqli_insert_id($my_connection);
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
<title>Assets Management System</title>
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
                        <h4 class="page-title">Add Category</h4>
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
                                            <label class=" control-label">Category Name</label>
                                            <div class="">
                                                <input type="text" class="form-control" placeholder="Enter Category Name" name = "title" required />
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
                            <h4 class="m-t-0 header-title"><b>Category Type List</b></h4>
                            

                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Serial #</th>
                                    <th>Category Name</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                 <?php 

                   $today = date("Y-m-d");
 $select_qry2 = mysqli_query($my_connection, "select * from categories") or die(mysqli_error($my_connection));
                                $n = 1;
                                  while($row2 = mysqli_fetch_array($select_qry2)){
                                  $id = $row2['id'];
                             echo ' <tr role="row" class="odd">';
                                    
                                    echo '<td> '.$n++.'</td>';
                                        
                                    echo  '<td class="">';
                                    echo '<b>'.$row2['title'].'</b>';
                                    echo '</td>';                                          
                                       echo '<td style="width:90px;">';
                                   echo ' <a href="#" >  
                             <a  href ="category_edit.php?id='.$id.'" data-toggle="tooltip" data-placement="bottom" title="Edit" style=""> 
                                <i class="ti-pencil" style="font-size:25px; color:success; margin-top:10px; margin-left:0px;"></i>
                                 </a>';
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