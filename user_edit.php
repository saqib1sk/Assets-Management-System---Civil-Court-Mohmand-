<?php 
require_once('session_data.php');
?>

<?php

require_once('my_connection.php');

//  function password_generate($chars) 
// {
    
    
//   $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
//   return substr(str_shuffle($data), 0, $chars);
// }



    $success = "";
    $subcat_data = "";
    if(isset($_GET['id'])){
         $id = $_GET['id'];
       //echo $id;
    $select_qry = mysqli_query($my_connection, "SELECT * FROM `users` where id = $id") or die(mysqli_error($my_connection));
    $row = mysqli_fetch_assoc($select_qry);
    // echo $title = $row['title']; 
     
      $get_role_id = $row['role_id'];
     $name = $row['name'];
      $password = $row['password'];
     $email = $row['email'];
      $mobile = $row['mobile'];
        $cnic = $row['cnic'];
   
    }




?>
 <?php if(isset($_POST['btnupdate'])){

     $role_id = $_POST['role_id'];
      
     $name = $_POST['name'];
      $password = $_POST['password'];
     $email = $_POST['email'];
      $mobile = $_POST['mobile'];
     $cnic = $_POST['cnic'];
  

      $file_name =  $_FILES['file_path']['name'];
      if(@$_FILES["file_path"]["name"][0] != null){
        //here is new file attached...

      //  echo "here is new file is attached";

         $tmp_name = $_FILES['file_path']['tmp_name'];
       $target_dir = "users_image/".$file_name;

        move_uploaded_file($tmp_name, $target_dir);

        $update_query = mysqli_query($my_connection,"UPDATE `users` SET `role_id`='$role_id',`name`='$name',`password`='$password',`email`='$email',`mobile`='$mobile',`cnic`='$cnic',`image_path`='$target_dir' WHERE id = '$id'") or die (mysqli_error($my_connection));
    
   
     echo "<script>
    window.location = 'users.php?msg=updated';
</script>"; 

 //  header('location:user_registration.php?msg=updated');


      }
      else{
    
     //ubdate record with out file attached...

         $update_query = mysqli_query($my_connection,"UPDATE `users` SET `role_id`='$role_id',`name`='$name',`password`='$password',`email`='$email',`mobile`='$mobile',`cnic`='$cnic' WHERE id = '$id'") or die (mysqli_error($my_connection));
          

          //echo "here is new file is  not attached";

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

           <script>  <link rel="stylesheet" href="assets/css/bootstrap-fileupload.min.css" /> </script>
<script src="assets/js/bootstrap-fileupload.js"></script>
        
         
         <?php require_once('my_header.php'); ?>
        
        <link href="assets/plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" type="text/css" />
              <?php require_once('datatable_link_files.php'); ?>
        </head>
        
       
        <!-- End Navigation Bar-->


        <div class="wrapper">
            <div class="container">
            
            
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group pull-right m-t-15">
                            
                        </div>

                        <h4 class="page-title">Edit User Details</h4>
                        <ol class="breadcrumb">
                        
                        </ol>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            
                            
                            <div class="row">
                          
                                <div class="col-md-6">
                                   <form id="jvalidate" role="form" class="form-horizontal" action="#" novalidate="novalidate" method="post" enctype="multipart/form-data">
                                        
                                      <!-- <?php  echo    $image_path =$row["image_path"]; ?> -->
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Name</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="" name = "name" value="<?php echo $name; ?>">
                                            </div>
                                        </div>
                                      
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Password</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="" name = "password" value="<?php echo $password; ?>">
                                            </div>
                                        </div>

                                       

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Email</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="" name = "email" value="<?php echo $email; ?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Mobile</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="" data-mask="9999 9999999" name = "mobile" value="<?php echo $mobile; ?>">
                                            </div>
                                        </div>

 <div class="form-group">
                                            <label class="col-md-2 control-label">CNIC</label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" placeholder="" data-mask="9999-9999999-9" name = "cnic" value="<?php echo $cnic; ?>">
                                            </div>
                                        </div>
                                       
                                     

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Select Role </label>
                                            <div class="col-md-10">
                                            <select name="role_id" class="form-control"  tabindex="">
                                               <option value="">Select Role</option>
                                           <?php $select_qry = mysqli_query($my_connection,"select * from roles where status = 0") or die (mysqli_error($my_connection)); 
                                           while($row=mysqli_fetch_array($select_qry)){
                                            $role_id =  $row['id'];
                                            $title = $row['title'];
                                           if ($role_id == $get_role_id){
                                               // echo "<option value = '$id'>$title</option>";
                                                echo '<option value = "'.$role_id.'" selected >'.$title.'</option>';

                                            }
                                            else{
                                               echo '<option value = "'.$role_id.'">'.$title.'</option>';

                                            }
                                           
                                           }
                                           
                                            ?>
                                           </select>
                                            </div>
                                        </div>
                                       <div class="form-group showimages">
                                        <label class="col-md-2 control-label">Old Image</label>
                                        <br />
                                          <div class="col-md-4"> 
                                        <?php 
                                      //  echo "select path from product_images where product_id = '$id'";
                                        $id = $_GET['id'];
                                        $select_qry2 = mysqli_query($my_connection, "select id,image_path from users where id = '$id'") 
                                        or die(mysqli_error($my_connection));                                
        $num_rows = mysqli_num_rows($select_qry2);
       if($num_rows == 0){
        $image_path = "image_path";
       }
       else{    
       while($row2 = mysqli_fetch_assoc($select_qry2))
           {
            $image_id = $row2['id'];
            $image_path = $row2['image_path'];
            echo '<div class="img-wrap" style=" width:100; height:100;">
    <img src="'.$image_path.'" data-id="'.$image_id.'" width="100" height="100" 
  style="object-fit: fill" alt="Image Not Yet Added"/>
</div>
';   
           }  
           }
            ?>      
                  </div>       
                 </div>
                                         <div class="form-group">
                                                <label class="col-md-2 control-label">Add New Image</label>
                                                <div class="col-md-8"> 

                                                                                                                  
                                                    <input type="file" name = "file_path"/>
                                                    
                                                </div>

                                            </div>
                                        
<label class="col-md-2 control-label"></label>
<div class="form-group">
<button type="submit" class="btn btn-success waves-effect waves-light m-l-10 btn-md" name ="btnupdate" >Update</button>
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
        </div>
        <!-- end wrapper -->
 <!-- jQuery  -->
       <?php require_once('jq_files.php'); ?>
        <!--End jQuery  -->
         <!-- datatable_script_files -->
                <?php require_once('datatable_script_files.php'); ?>
                <!-- End datatable_script_files --> 
        
  <!--inputmask Plugins js -->
        <script src="assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js" type="text/javascript"></script>
        <script src="assets/plugins/autoNumeric/autoNumeric.js" type="text/javascript"></script>
          <!--end inputmask Plugins js -->

    </body>

</html>