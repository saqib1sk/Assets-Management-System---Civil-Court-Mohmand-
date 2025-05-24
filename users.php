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
        
     $role_id = $_POST['role_id'];
   
     $name = $_POST['name'];
      $password = $_POST['password'];
     $email = $_POST['email'];
      $mobile = $_POST['mobile'];
       $cnic = $_POST['cnic'];

$check_qry = mysqli_query($my_connection, "select mobile from users where mobile = '$mobile'") or die (mysqli_error($my_connection));

 $num_rows = mysqli_num_rows($check_qry); 


if($num_rows == 0){

   $target_dir = "users_image/";
     //$save_query = mysqli_query($my_connection,"INSERT INTO `downloads`( `user_id`, `title`, `details`, `path`) VALUES ('$user_id','$title','$details','$path')") or die (mysqli_error($my_connection)); 
 if(@$_FILES["upload_file"]["name"][0] != null){
         
        // echo 'there is something'; die();
        
     $file_name =  $_FILES['upload_file']['name']; 
     $file_type = $_FILES['upload_file']['type']; 
     $file_size = $_FILES['upload_file']['size']; 
     $tmp_name = $_FILES['upload_file']['tmp_name'];
     $explode_file_name = explode('.',$file_name);
 
   
   $file_extension = strtolower(end($explode_file_name));
   
  $file_new_name = uniqid().'.'.$file_extension;
   
    $path = $target_dir.$file_new_name;
    
    
     if($file_extension == 'jpg' or $file_extension == 'png'){
       
       if(move_uploaded_file($tmp_name, $path)){

      
      
     $insert_qry = "INSERT INTO `users`(`role_id`,`name`,`password`,`email`,`mobile`,`cnic`,`image_path`)
   VALUES ('$role_id','$name','$password','$email','$mobile','$cnic','$path')"; 
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
                                    <strong>Oh snap!</strong> Record Already exist
                                </div>';  
 
}
       
       
    }
    else{

       $insert_qry1 = "INSERT INTO `users`(`role_id`,`name`, `password`, `email`, `mobile`, `cnic`,`image_path`)
                                   VALUES ('$role_id','$name','$password','$email','$mobile','$cnic','Image NOT YET ADDED')"; 
    mysqli_query($my_connection, $insert_qry1) or die(mysqli_error($my_connection));

      //insert here with out image...

    $success = '<div class="alert alert-success alert-block alert-dismissible fade in iconic-alert" role="alert">
                                    <div class="alert-icon">
                                        <span class="gcon gcon-emoji-happy centered-xy"></span>
                                    </div>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><span class="mcon mcon-close"></span></span></button>
                                    <strong>Success!</strong> Record Inserted With Out Image.
                            </div>';
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

                        <h4 class="page-title">Add User</h4>
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

                                        <div class="form-group col-md-4">
                                            <label class=" control-label">Select Role </label>
                                            <div class="">
                                            <select name="role_id" class="form-control"  tabindex="">
                                               <option value="">Select Role</option>
                                           <?php $select_qry = mysqli_query($my_connection,"select * from roles where status = 0") or die (mysqli_error($my_connection)); 
                                           while($row=mysqli_fetch_array($select_qry)){
                                            $id =  $row['id'];
                                            $title = $row['title'];
                                            echo "<option value = '$id'>$title</option>";
                                           }
                                           
                                            ?>
                                           </select>
                                            </div>
                                        </div>

                                      <!--  -->


                                        <div class="form-group col-md-4">
                                            <label class=" control-label">Name</label>
                                            <div class="">
                                                <input type="text" class="form-control" placeholder="" name = "name"/>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label class=" control-label">Password</label>
                                            <div class="">
                                                <input type="text" class="form-control" placeholder="" name = "password"/>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label class=" control-label">Email</label>
                                            <div class="">
                                                <input type="text" class="form-control" placeholder="" name = "email"/>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group col-md-4">
                                            <label class=" control-label">Mobile</label>
                                            <div class="">
                                                <input type="text" class="form-control" placeholder="" name = "mobile"/>
                                            </div>
                                        </div>

                                          <div class="form-group col-md-4">
                                            <label class=" control-label">CNIC</label>
                                            <div class="">
                                                <input type="text" class="form-control" placeholder="" name = "cnic"/>
                                            </div>
                                        </div>

                                    

                                         <div class="form-group col-md-4">
                                          <label class=" control-label">         </label>
                                                
                                                <div class="">                                                                                            
                                                    <input type="file" name = "upload_file" value = "" />
                                        <!--  <img src="student_image/<?php echo $row['upload_file']; ?>" style="width:80px;height:60px"> -->
         
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
                            <h4 class="m-t-0 header-title"><b>User List</b></h4>
                            

                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                   <!--  <th>#</th> -->
                                    <th>Users</th>
                                </tr>
                                </thead>


                                <tbody>
                 <?php  $select_qry = mysqli_query($my_connection, "select u.id,u.name,u.email,u.mobile,u.cnic,r.title as role,u.image_path as image_path from users as u
inner join roles r
on r.id = u.role_id
where u.status = '0'") or die(mysqli_error($my_connection));
                                 
                                 $i=1;
                                  while($row = mysqli_fetch_array($select_qry)){
                                    $id = $row['id'];
                                    
                                    echo ' <tr role="row" class="odd">';
                                    
                                    // echo '<td> '.$i++.'</td>';


                                    echo '<td>';

                                echo '    <div class="search-item">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#"> <img class="media-object img-circle" alt="Image Not yet Added" src="'.$row['image_path'].'" style="width: 64px; height: 64px;"> </a>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="media-heading"><a href ="user_edit.php?id='.$id.'">'.$row['name'].'</a></h4>
                                                
                                                 

                                                    <b>Role:</b>
                                                   
                                                    <span><a href="#" class="text-muted">'.$row['role'].'</a></span></p>
                                                <p>
                                                    <b>Bio:</b>
                                                    <br/>
                      <span class="text-muted">'.$row['mobile'].'</span>  </br> 
                         <span class="text-muted">'.$row['email'].'</span>
                         </br> 
                         <span class="text-muted">'.$row['cnic'].'</span>
                         </br>
                         <a  href ="user_delete.php?id='.$id.'" data-toggle="tooltip" data-placement="bottom" title="Delete User" style=""> 
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