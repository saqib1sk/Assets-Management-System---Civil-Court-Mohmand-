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

                <div class="row row-centered" style="text-align: center; ">
            <a href="child_list_total.php">
                    <div class="col-md-6 col-lg-3">
                        <div class="widget-bg-color-icon card-box fadeInDown animated">
                            <div class="bg-icon bg-icon-info pull-left">
                                <i class="md md-person text-info"></i>
                            </div>
                            <div class="text-right">
                     <?php 
                          $select_qry = mysqli_query($my_connection, "SELECT COUNT(name) as total_child FROM `child_detail`") or die(mysqli_error($my_connection));
                          $row = mysqli_fetch_assoc($select_qry);
                          $total_child = $row['total_child'];
                     ?>
                                <h3 class="text-dark"><b class="counter"><?php echo $total_child; ?></b></h3>
                                <p class="text-muted">Total Child</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    </a>
                </div>

                <!-- <div class="row">
                <div class="col-lg-12">
                <div class="card-box" id="graphContainer">
                <h4>Child  Graph</h4>
                <canvas id="graphCanvas"></canvas>
                </div>   
                </div>
                </div>
                <?php require_once('bar_chart_code/chart_code.php'); ?> -->


                   


               
                   <?php require_once('my_footer.php'); ?>
                <!-- End Footer -->

            </div>
        </div>



        <!-- jQuery  -->
           <?php require_once('jq_files.php'); ?>
       

    </body>
</html>