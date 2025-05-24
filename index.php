<?php
 require_once('session_data.php');
 $user_id = $_SESSION['user_id'];
?>

<?php
require_once('my_connection.php'); 
?>

<!DOCTYPE html>
<html>
<head>
        <?php require_once('my_meta.php'); ?>
    </head>


    <body>


        <!-- Navigation Bar-->
        

        <?php require_once('my_header.php'); ?>
        <!-- End Navigation Bar-->


        <div class="wrapper">
            <div class="container">

              <br>
              <div class="row">
                <center>
            <b><h1 style="font-size:60px; margin-top:20px; font-weight: 900;">Welcome</h1></b>
             <h4 style="font-size:20px; margin-top:-2px; margin-left:3px;">Assets Management System</h4>
             <h4 style="font-size:20px; margin-top:-5px;"><b>Civil Court Mohmand</b></h4></center>
              </div>

                <div class="row">

                    <!-- Stationary start -->
  <h4 style="margin-left: 10px;">Dashboard</h4>
 <a href = "stationary_total.php">
                    <div class="col-md-6 col-sm-6 col-lg-4" >
                        <div class="card-box widget-box-1 " style="background-color: #54d3f5;">
                               <i class="text-muted pull-right" data-placement="bottom">
                                <p class="text-white">
                             
                             <!-- <i class="label label-success">Piece</i> -->
                              </p> </i>
                          
                          
                          
                            
                          <h2 class="text-center text-white"><img src="icon/sat_icon.png" style="width:50px; height:50px;"/></i>  Stationary</h2>
                        </div>
                    </div>
                    
                    </a>
<a href = "miscellaneous_total.php">
                    <div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="card-box widget-box-1 " style="background-color:#e3b419;">
                            <i class="text-muted pull-right" data-placement="bottom">
                                <p class="text-white">
                        <!-- <i class="label label-success">Piece</i> -->
                              </p> </i>
                          
                            <h2 class="text-center text-white"><img src="icon/mis_icon.png" style="width:50px; height:50px;"/>  Miscellaneous</h2>
                            
                        </div>
                    </div>
                    
                    </a>

<a href = "court_item_total.php">

                    <div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="card-box widget-box-1 " style="background-color:#f53a59;">
                            <i class=" text-muted pull-right"  data-placement="bottom" title="" >
                            <p class="text-white">
                             <!-- <i class="label label-success">Piece</i> -->
                                   </p>
                            </i>
                         

    <h2 class="text-center text-white"><img src="icon/reg_icon.png" style="width:50px; height:50px;"/>  Court Register </h2>
                             <p class="text-muted">
                          
                
                              </p> 
                        </div>
                    </div>
</a>

<!-- Stationary end -->
       

              
              

                </div>


<?php //require_once('bar_chart_code/chart_code.php'); ?> 


            


               


                <!-- Footer -->
               
                   <?php require_once('my_footer.php'); ?>
                <!-- End Footer -->

            </div>
        </div>



        <!-- jQuery  -->
           <?php require_once('jq_files.php'); ?>
       

    </body>
</html>