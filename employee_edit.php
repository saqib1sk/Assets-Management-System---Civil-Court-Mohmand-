<?php 
require_once('session_data.php');
?>
<?php
require_once('my_connection.php');

    if(isset($_GET['id'])){
         $id = $_GET['id'];
       //echo $id;
    $select_qry = mysqli_query($my_connection, "SELECT * FROM `employees` where id = $id") or die(mysqli_error($my_connection));
    $row = mysqli_fetch_assoc($select_qry);
    $get_department_id = $row['department_id'];
       $name = $row['name'];
        $mobile = $row['mobile'];
         $cnic = $row['cnic'];
          $email = $row['email'];
           $designation = $row['designation'];
    }
?>
 <?php if(isset($_POST['btnupdate'])){
$department_id = $_POST['department_id'];
$name = $_POST['name'];
 $mobile = $_POST['mobile'];
  $cnic = $_POST['cnic'];
   $email = $_POST['email'];
    $designation = $_POST['designation'];
 $file_name =  $_FILES['file_path']['name'];
 if(@$_FILES["file_path"]["name"][0] != null){
    $tmp_name = $_FILES['file_path']['tmp_name'];
  $target_dir = "employee_images/".$file_name;
   move_uploaded_file($tmp_name, $target_dir);
   $update_query = mysqli_query($my_connection,"UPDATE `employees` SET `department_id`='$department_id',`name`='$name',`mobile`='$mobile',`cnic`='$cnic',`email`='$email',`designation`='$designation',`image_path`='$target_dir' WHERE id = '$id'") or die (mysqli_error($my_connection));
echo "<script>
window.location = 'employee_add.php?msg=updated';
</script>"; 
//  header('location:user_registration.php?msg=updated');
 }
 else{
//ubdate record with out file attached...
    $update_query = mysqli_query($my_connection,"UPDATE `employees` SET `department_id`='$department_id',`name`='$name',`mobile`='$mobile',`cnic`='$cnic',`email`='$email',`designation`='$designation' WHERE id = '$id'") or die (mysqli_error($my_connection));
     //echo "here is new file is  not attached";
echo "<script>
window.location = 'employee_add.php?msg=updated';
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
                        <h4 class="page-title">Edit Employee Details</h4>
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
                                            <label class=" control-label">Select Court/Office/Other </label>
                                            <div class="">
                                            <select name="department_id" class="form-control"  tabindex="">
                                               <option value="">Select Court/Office/Other</option>
                                           <?php $select_qry = mysqli_query($my_connection,"select * from departments") or die (mysqli_error($my_connection)); 
                                           while($row=mysqli_fetch_array($select_qry)){
                                            $id =  $row['id'];
                                            $title = $row['title'];
                                            if($get_department_id = $id)
                                            {
                                                echo "<option value = '$id' selected>$title</option>";
                                            }
                                            else{
                                                echo "<option value = '$id'>$title</option>";
                                            }
                                           
                                           }
                                           
                                            ?>
                                           </select>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label class=" control-label">Name</label>
                                            <div class="">
                                                <input type="text" class="form-control" placeholder="" name = "name" value="<?php echo $name; ?>" required />
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label class=" control-label">Mobile</label>
                                            <div class="">
                                                <input type="number" class="form-control" placeholder="" name = "mobile" value="<?php echo $mobile; ?>"  required/>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label class=" control-label">CNIC</label>
                                            <div class="">
                                                <input type="number" class="form-control" placeholder="" name = "cnic" value="<?php echo $cnic; ?>"  required/>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group col-md-3">
                                            <label class=" control-label">Email</label>
                                            <div class="">
                                                <input type="email" class="form-control" placeholder="" name = "email" value="<?php echo $email; ?>"  required/>
                                            </div>
                                        </div>

                                          <div class="form-group col-md-3">
                                            <label class=" control-label">Designation</label>
                                            <div class="">
                                                <input type="text" class="form-control" placeholder="" name = "designation" value="<?php echo $designation; ?>" required />
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                        <label class="control-label">Old Image</label>
                                          <div class=""> 
                                        <?php 
                                      //  echo "select path from product_images where product_id = '$id'";
                                        $id = $_GET['id'];
                                        $select_qry2 = mysqli_query($my_connection, "select id,image_path from employees where id = '$id'") 
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

                                         <div class="form-group col-md-3">
                                          <label class=" control-label"> New Image</label>
                                                <div class="">                                                                                            
                                                    <!-- <input type="file" name = "upload_file" value = "" /> -->
<input id="file" type="file" name="file_path" onchange="showImage1(event)" t accept="image/*" class="form-control" style="overflow: hidden;" placeholder="Insert Your Image">
<img id="img" class="shadow" style="float:right; border: 1px blue solid; border-radius: 10%; margin-top: 4%" width="130px;" src="assets/images/child.jpg" height="130px" alt="Image">
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