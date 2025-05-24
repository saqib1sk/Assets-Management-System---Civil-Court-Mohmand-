<?php 

ob_start();
session_start();

 
//  echo 'HEllo';
//  die();
 ?>
<?php 

require_once('my_connection.php');
 
 ?>


<?php 
if (isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password']; 
    $select = mysqli_query($my_connection, "select * from users where email = '$username' and password = '$password' and status = 0") or die (mysqli_error($my_connection));
 // echo
   $countrows = mysqli_num_rows($select);
  if ($countrows == 1){
   //echo "record exist"; die();
    
      while($row=mysqli_fetch_array($select)){
          
         $user_id = $row['id'];
        $username= $row['name'];
         $role_id = $row['role_id'];
         // $department_id = $row['department_id'];
         // $sub_department_id = $row['sub_department_id'];
         // $organization_id = $row['organization_id'];
         
    }
   // echo '<br />';
    $_SESSION['user_id'] = $user_id;
    $_SESSION['username']= $username;
     $_SESSION['role_id'] = $role_id; 
     // $_SESSION['department_id'] = $department_id;
     // $_SESSION['sub_department_id'] = $sub_department_id;
     // $_SESSION['organization_id'] = $organization_id;
      if($role_id == 1){

     header("location:index.php");
      } 

    //   elseif($role_id == 2)
    //   {
    // header("location:index_user.php");
    // }
 
     else{
    
 }
    
     var_dump($_SESSION);
    exit();
   
    //echo 'hi'; die();
  }
  else{
 //   echo "record not exist"; die();
    $error  = '<div class="alert alert-danger alert-block alert-dismissible fade in iconic-alert" role="alert">
									<div class="alert-icon">
										<span class="gcon gcon-hand centered-xy"></span>
									</div>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><span class="mcon mcon-close"></span></span></button>
									<strong></strong>Username Or Password Is Incorrect<a href="javascript:void(0);" class="alert-link"></a>.
								</div>';
 
  }
}
?>

<!DOCTYPE html>
<html>
<?php require_once('my_meta.php'); ?>
	<body>

		<!-- style="background: rgba(255,255,255,0.8); background:url('bg/login_bg.PNG'); 
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
background-size: 100% 100%;
background-size: auto auto;"
 -->
		<div class="account-pages" style="background: rgba(255,255,255,0.8); background:url('bg/login_bg.jpg'); 
-webkit-background-size: cover;
-moz-background-size: cover;
-o-background-size: cover;
opacity: 0.6;"></div>
		<div class="clearfix"></div>
		<div style="">
		<div class="wrapper-page" style="opacity: 0.8; padding-top: 50px;">
			<div class="card-box" style="background-color: #797979;">
				<div class="panel-heading">
					<h3 class="text-center" style="color:white;"> Sign In to <br><strong class="text-custom" style="color:white;">Asset Management <span style="color:#2eca6a;">System</span></strong></h3>
				</div>

				<center><img src="assets/images/logo.png" width="100" /> </center>

				<div class="panel-body">
					<form class="form-horizontal m-t-20" action="" method="post">

						<div class="form-group ">
							<div class="col-xs-12">
								  <input class="form-control" type="email" required="" placeholder="Enter Email" name ="username" style="">
							</div>
						</div>

						<div class="form-group">
							<div class="col-xs-12">
							 <input class="form-control" type="password" required="" placeholder="Enter Password" name = "password">
							</div>
						</div>

					<!-- 	<div class="form-group ">
							<div class="col-xs-12">
								<div class="checkbox checkbox-primary">
									<input id="checkbox-signup" type="checkbox">
									<label for="checkbox-signup"> Remember me </label>
								</div>

							</div>
						</div> -->

						<div class="form-group text-center m-t-40">
							<div class="col-xs-12">
							   <button class="btn btn-block text-uppercase waves-effect waves-light" type="submit" name = "login" style="background-color:#2eca6a; color: white;">Log In</button>
							</div>
						</div>

						<!-- <div class="form-group m-t-20 m-b-0">
							<div class="col-sm-12">
								<a href="page-recoverpw.html" class="" style="color:white;"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
							</div>
						</div> -->
						
					<!-- 	<div class="form-group m-t-20 m-b-0">
							<div class="col-sm-12 text-center">
								<h4><b>Sign in with</b></h4>
							</div>
						</div> -->
						
					<!-- 	<div class="form-group m-b-0 text-center">
							<div class="col-sm-12">
								<button type="button" class="btn btn-facebook waves-effect waves-light m-t-20">
		                           <i class="fa fa-facebook m-r-5"></i> Facebook
		                        </button>

		                        <button type="button" class="btn btn-twitter waves-effect waves-light m-t-20">
		                           <i class="fa fa-twitter m-r-5"></i> Twitter
		                        </button>

		                        <button type="button" class="btn btn-googleplus waves-effect waves-light m-t-20">
		                           <i class="fa fa-google-plus m-r-5"></i> Google+
		                        </button>
							</div>
						</div> -->
					</form>

				</div>
			</div>
			<div class="row">
				<!-- <div class="col-sm-12 text-center">
					<p style="color:black;">
						Don't have an account? <a href="page-register.html" class="text-primary m-l-5"><b style="color:red;">Sign Up</b></a>
					</p>
				</div> -->
			</div>

		</div>
		</div>

		<script>
			var resizefunc = [];
		</script>

		<!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>


        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

	</body>


</html>