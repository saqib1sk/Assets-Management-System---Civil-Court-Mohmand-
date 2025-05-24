<?php
require_once('session_data.php');
?>
<?php

require_once('my_connection.php');

    $success = "";
 
    if(isset($_GET['id'])){
         $id = $_GET['id'];
       //echo $id;
    $select_qry = mysqli_query($my_connection, "SELECT * FROM `categories` where id = $id") or die(mysqli_error($my_connection));
    $row = mysqli_fetch_assoc($select_qry);
    $title = $row['title']; 
    }




?>
 <?php if(isset($_POST['btnupdate'])){
     $title = $_POST['title'];
    

        $update_query = mysqli_query($my_connection,"UPDATE `categories` SET `title`='$title'  WHERE id = '$id'") or die (mysqli_error($my_connection));
    
   
     echo "<script>
    window.location = 'category_add.php?msg=updated';
</script>"; 

 //  header('location:user_registration.php?msg=updated');


      }
      else{
    
     


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
                        <h4 class="page-title">Update Category Type</h4>
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
                                      <div class="form-group col-md-4">
                                            <label class=" control-label">Category Name</label>
                                            <div class="">
                                                <input type="text" class="form-control" placeholder="Enter Category Name" name = "title" value="<?php echo $title; ?>" required />
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