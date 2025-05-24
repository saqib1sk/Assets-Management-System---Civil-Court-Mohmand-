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
       $name = $_POST['name'];
        $mobile = $_POST['mobile'];
         $cnic = $_POST['cnic'];
          $email = $_POST['email'];
    //die();

$check_qry = mysqli_query($my_connection, "select mobile from suppliers where mobile = '$mobile'") or die (mysqli_error($my_connection));

$num_rows = mysqli_num_rows($check_qry); 
 //Die();

if($num_rows == 0){

   $target_dir = "supplier_images/";
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
        // $remove_character = substr($path, 3);

      
     $insert_qry = "INSERT INTO `suppliers`(`name`, `mobile`, `cnic`, `email`, `image_path`)
                                    VALUES ('$name','$mobile','$cnic','$email','$path')"; 
    mysqli_query($my_connection, $insert_qry) or die(mysqli_error($my_connection));
    
        
        $success = '<div class="alert alert-success alert-block alert-dismissible fade in iconic-alert" role="alert">
                                    <div class="alert-icon">
                                        <span class="gcon gcon-emoji-happy centered-xy"></span>
                                    </div>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><span class="mcon mcon-close"></span></span></button>
                                    <strong>Success!</strong> Record Inserted.
                            </div>'; 
                            
                
}
}
else{   
 $warning = '<div class="alert alert-danger alert-block alert-dismissible fade in iconic-alert" role="alert">
                                    <div class="alert-icon">
                                        <span class="gcon gcon-hand centered-xy"></span>
                                    </div>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><span class="mcon mcon-close"></span></span></button>
                                    <strong>Oh snap!</strong> Image Not Supported!, Use Jpg, Jpeg & Png Images.
                                </div>';  
 
}      
}
else{

$insert_qry1 = "INSERT INTO `suppliers`(`name`, `mobile`, `cnic`, `email`, `image_path`)
VALUES ('$name','$mobile','$cnic','$email','IMAGE NOT YET ADDED')"; 
$run_q1=mysqli_query($my_connection, $insert_qry1) or die(mysqli_error($my_connection));
if($run_q1){
    $success = '<div class="alert alert-success alert-block alert-dismissible fade in iconic-alert" role="alert">
                                    <div class="alert-icon">
                                        <span class="gcon gcon-emoji-happy centered-xy"></span>
                                    </div>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><span class="mcon mcon-close"></span></span></button>
                                    <strong>Success!</strong> Record Inserted With Out Image.
                            </div>';
}else{
    $warning = '<div class="alert alert-danger alert-block alert-dismissible fade in iconic-alert" role="alert">
    <div class="alert-icon">
        <span class="gcon gcon-hand centered-xy"></span>
    </div>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><span class="mcon mcon-close"></span></span></button>
    <strong>Oh snap!</strong> Record Not Inserted, Try Again!</div>';
}
}    
       
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

                        <h4 class="page-title">Add Vendor</h4>
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
            <?php
            
//             if(isset($_GET['msg']) == 'updated' ){
//                 echo '<div class="alert alert-info alert-block alert-dismissible fade in iconic-alert" role="alert">
//                                     <div class="alert-icon">
//                                         <span class="gcon gcon-hand centered-xy"></span>
//                                     </div>
//                                     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><span class="mcon mcon-close"></span></span></button>
//                                     <strong>Success </strong> Record updated
//                                 </div>';
//             }
//             elseif (isset($_GET['msg']) == 'user_deleted') {
//                 // code...
//                  echo '<div class="alert alert-danger alert-block alert-dismissible fade in iconic-alert" role="alert">
//                                     <div class="alert-icon">
//                                         <span class="gcon gcon-hand centered-xy"></span>
//                                     </div>
//                                     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><span class="mcon mcon-close"></span></span></button>
//                                     <strong></strong> Record deleted
//                                 </div>';

    
//             }

// else
//             {
                
//             }
            
             ?>
                                <div class="col-md-12">
   <form class="" role="form" method="post" enctype="multipart/form-data">
                                        
                                        
                                        <div class="row">

                                       

                                        <div class="form-group col-md-2">
                                            <label class=" control-label">Name</label>
                                            <div class="">
                                                <input type="text" class="form-control" placeholder="" name = "name" required/>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label class=" control-label">Mobile</label>
                                            <div class="">
                                                <input type="number" class="form-control" placeholder="" name = "mobile"/>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label class=" control-label">CNIC</label>
                                            <div class="">
                                                <input type="number" class="form-control" placeholder="" name = "cnic"/>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group col-md-2">
                                            <label class=" control-label">Email</label>
                                            <div class="">
                                                <input type="email" class="form-control" placeholder="" name = "email"/>
                                            </div>
                                        </div>

                                         

                                         <div class="form-group col-md-3">
                                          <label class=" control-label"></label>
                                                <div class="">                                                                                            
                                                    <!-- <input type="file" name = "upload_file" value = "" /> -->
<input id="file" type="file" name="upload_file" onchange="showImage1(event)" t accept="image/*" class="form-control" style="overflow: hidden;" placeholder="Insert Your Image">
<img id="img" class="shadow" style="float:right; border: 1px blue solid; border-radius: 10%; margin-top: 4%" width="130px;" src="assets/images/child.jpg" height="130px" alt="Image">
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
                            <h4 class="m-t-0 header-title"><b>Vendors List</b></h4>
                            

                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Serial #</th>
                                    
                                    
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>CNIC</th>
                                    <th>Email</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>


                                <tbody>
                 <?php 

                   $today = date("Y-m-d");

//                    SELECT t1.*, t2.column_name
// FROM table1 t1
// JOIN table2 t2 ON t1.common_column = t2.common_column;
              
 $select_qry2 = mysqli_query($my_connection, "select sup.* from suppliers  sup") or die(mysqli_error($my_connection));
                                $n = 1;
                                  while($row2 = mysqli_fetch_array($select_qry2)){
                                  $id = $row2['id'];

                           
                             echo ' <tr role="row" class="odd">';
                                    
                                    echo '<td> '.$n++.'</td>';
                                        
                                    echo  '<td class="">';
                                    echo '<b>'.$row2['name'].'</b>';
                                    echo '</td>';
                                          echo  '<td class="">';
                                          echo $row2['mobile'];
                                          echo '</td>';

                                           echo  '<td class="">';
                                          echo $row2['cnic'];
                                          echo '</td>';

                                           echo  '<td class="">';
                                           echo $row2['email'];
                                          echo '</td>';

                                         
                                          
                                            echo  '<td class="">';
                                        //  echo $row2['image_path'];

                                        //   echo ' <a  href ="'.$row2['image_path'].'" style="margin-left:18px; align:bottom;" data-toggle="tooltip" data-placement="bottom" title="Download/View File">
                                        //    <i class="fa fa-image" style="font-size:30px;color:#094769; margin-top:0px;"></i>';
          echo ' <div class="media-left">
          <a href="#"> <img class="media-object img-circle" alt="Image Not yet Added" src="'.$row2['image_path'].'" style="width: 74px; height: 74px;"> </a>
      </div>';

                                          echo '</td>'; 
                                       echo '<td style="width:90px;">';
                                    //  echo '</a>';
                                
                                   echo ' <a href="#" >
                                   
                                        
                             <a  href ="supplier_edit.php?id='.$id.'" data-toggle="tooltip" data-placement="bottom" title="Edit" style=""> 
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