<?php
require_once('my_connection.php'); 
//require_once('get_counters.php');
?>
<!DOCTYPE html>
<html>
 <title>Shop Mangament System</title>
<?php require_once('my_meta.php'); ?>
    <body>
<head>
<?php require_once('my_header.php'); ?>
<link href="assets/plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" type="text/css" />
           <!-- DataTables -->
        <link href="assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/datatables/dataTables.colVis.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/plugins/datatables/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css"/>
    </head>
        <!-- End Navigation Bar-->
        <div class="wrapper">
            <div class="container">
                <div class="row">
                   </div>
<div class="row" >
<!-- Stationary start -->
  <h4 style="margin-left: 10px;">Stationary Details</h4>
 <a href = "stationary_total.php">
                    <div class="col-md-6 col-sm-6 col-lg-4" >
                        <div class="card-box widget-box-1 " style="background-color: #54d3f5;">
                               <i class="text-muted pull-right" data-placement="bottom">
                                <p class="text-white">
                             
                             <!-- <i class="label label-success">Piece</i> -->
                              </p> </i>
                            <h4 class="text-white" >Stationary<small class="text-white"></small></h4>
                            <?php 
                            $total_stationary_qry = mysqli_query($my_connection, "SELECT SUM(quantity) as total_stationary FROM assets WHERE category_id = 1;") or die(mysqli_error($my_connection));                          
                            $row = mysqli_fetch_assoc($total_stationary_qry);
                            $total_stationary = $row['total_stationary']; ?>
    <h2 class="text-primary text-center"><small style="font-size:15px; color: white;" class="text-muted">Total : </small><span data-plugin="counterup" class="text-white">  <?php echo $total_stationary; ?></span>
      <small></small></h2>
                        </div>
                    </div>
                    
                    </a>
<a href = "stationary_issue.php">
                    <div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="card-box widget-box-1 " style="background-color:#e3b419;">
                            <i class="text-muted pull-right" data-placement="bottom">
                                <p class="text-white">
                        <!-- <i class="label label-success">Piece</i> -->
                              </p> </i>
                            <h4 class="text-white">Stationary <small class="text-white"></small></h4>
                            <?php 
                            $issue_stationary_qry = mysqli_query($my_connection, "SELECT SUM(quantity) as issue_stationary FROM issue_assets WHERE category_id = 1;") or die(mysqli_error($my_connection));                          
                            $row = mysqli_fetch_assoc($issue_stationary_qry);
                            $issue_stationary = $row['issue_stationary']; ?>
                            <h2 class="text-pink text-center"><small style="font-size:15px;" class="text-white">Issue : </small><span data-plugin="counterup" class="text-white"> <?php echo $issue_stationary; ?></span></h2>
                            
                        </div>
                    </div>
                    
                    </a>

<a href = "stationary_current.php">

                    <div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="card-box widget-box-1 " style="background-color:#f53a59;">
                            <i class=" text-muted pull-right"  data-placement="bottom" title="" >
                            <p class="text-white">
                             <!-- <i class="label label-success">Piece</i> -->
                                   </p>
                            </i>
                            <h4 class="text-white">Stationary  <small class="text-white"></small></h4>
                            <?php 
                            $current_stationary_qry = mysqli_query($my_connection, "SELECT SUM(quantity) as current_stationary FROM asset_available WHERE category_id = 1;") or die(mysqli_error($my_connection));                          
                            $row = mysqli_fetch_assoc($current_stationary_qry);
                            $current_stationary = $row['current_stationary']; ?>

      <h2 class="text-success text-center"><small style="font-size:15px;" class="text-white">Current :  </small><span data-plugin="counterup" class="text-white"> <?php echo $current_stationary;
                  ?></span></h2>
                             <p class="text-muted">
                          
                
                              </p> 
                        </div>
                    </div>
</a>

<!-- Stationary end -->


<!-- Miscellaneous start -->
  <h4 style="margin-left: 10px;">Miscellaneous Details</h4>
 <a href = "miscellaneous_total.php">
                    <div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="card-box widget-box-1 " style="background-color:#4adb8a;">
                               <i class="text-muted pull-right" data-placement="bottom">
<p class="text-white">
<!-- <i class="label label-info">Meter Square</i> -->
</p> 

</i>
  <h4 class="text-white">Miscellaneous <small class="text-white"></small></h4>
  <?php  $total_miscellaneous_qry = mysqli_query($my_connection, "SELECT SUM(quantity) as total_miscellaneous FROM assets WHERE category_id = 2;") or die(mysqli_error($my_connection));                          
                            $row = mysqli_fetch_assoc($total_miscellaneous_qry);
                            $total_miscellaneous = $row['total_miscellaneous']; ?>
  <h2 class="text-primary text-center"><small style="font-size:15px;" class="text-white">Total : </small><span data-plugin="counterup" class="text-white">  <?php echo  $total_miscellaneous; ?></span><small> </small></h2>
                        </div>
                    </div>
                    
                    </a>


<a href = "miscellaneous_issue.php">
                    <div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="card-box widget-box-1 " style="background-color:#f26f45;">
                            <i class="text-muted pull-right" data-placement="bottom">
                                <p class="text-white">
                             
                             <?php //echo $total_tile_sale_qty; echo ' '; ?>
                             <!-- <i class="label label-info">Meter Square</i> -->
                              </p> </i>
                            <h4 class="text-white">Miscellaneous <small class="text-white"></small></h4>

                            <?php 
                            $issue_miscellaneous_qry = mysqli_query($my_connection, "SELECT SUM(quantity) as issue_miscellaneous FROM issue_assets WHERE category_id = 2;") or die(mysqli_error($my_connection));                          
                            $row = mysqli_fetch_assoc($issue_miscellaneous_qry);
                            $issue_miscellaneous = $row['issue_miscellaneous']; ?>

                            <h2 class="text-pink text-center"><small style="font-size:15px;" class="text-white">Issue : </small><span data-plugin="counterup" class="text-white"> <?php echo $issue_miscellaneous; ?></span></h2>
                           
                        </div>
                    </div>
                    
                    </a>

<a href = "miscellaneous_current.php">

                    <div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="card-box widget-box-1 " style="background-color:#fca831;">
                        <i class="text-muted pull-right" data-placement="bottom">
                                <p class="text-white">
                             
                           
                             <!-- <i class="label label-info">Meter Square</i> -->
                              </p> </i>
                            <h4 class="text-white">Miscellaneous  <small class="text-white"></small></h4>
                            <?php 
                            $current_miscellaneous_qry = mysqli_query($my_connection, "SELECT SUM(quantity) as current_miscellaneous FROM asset_available WHERE category_id = 2;") or die(mysqli_error($my_connection));                          
                            $row = mysqli_fetch_assoc($current_miscellaneous_qry);
                            $current_miscellaneous = $row['current_miscellaneous']; ?>

                            <h2 class="text-success text-center"> <small style="font-size:15px;" class="text-white">Current: </small> <span data-plugin="counterup" class="text-white"> <?php 
                           echo $current_miscellaneous;

                            ?></span></h2>
                             <p class="text-muted">
                                 
                              </p> 
                        </div>
                    </div>
</a>

<!-- Miscellaneous end -->


<!-- Court Item start -->
<div style="">
<h4 style="margin-left: 10px;" >Court Item Details</h4>
 <a href = "court_item_total.php">
                    <div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="card-box widget-box-1" style="background-color:#92d5db;">
                               <i class="text-muted pull-right" data-placement="bottom">
<p class="text-muted">
<!-- <i class="label label-default">Meter Square</i> -->
</p> 

</i>
  <h4 class="text-white">Court Item<small></small></h4>
  <?php  $total_court_item_qry = mysqli_query($my_connection, "SELECT SUM(quantity) as total_court_item FROM assets WHERE category_id = 3;") or die(mysqli_error($my_connection));                          
                            $row = mysqli_fetch_assoc($total_court_item_qry);
                            $total_court_item = $row['total_court_item']; ?>

  <h2 class="text-white text-center"><small style="font-size:15px;" class="text-white">Total : </small><span data-plugin="counterup">  <?php echo  $total_court_item; ?></span><small> </small></h2>
                        </div>
                    </div>
                    
                    </a>
<a href = "court_item_issue.php">
                    <div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="card-box widget-box-1" style="background-color:#6ebe63;">
                            <i class="text-muted pull-right" data-placement="bottom">
                                <p class="text-muted">
                             <!-- <i class="label label-default">Piece</i> -->
                              </p> </i>
                            <h4 class="text-white">Court Item<small></small></h4>
                            <?php 
                            $issue_court_item_qry = mysqli_query($my_connection, "SELECT SUM(quantity) as issue_court_item FROM issue_assets WHERE category_id = 3;") or die(mysqli_error($my_connection));                          
                            $row = mysqli_fetch_assoc($issue_court_item_qry);
                            $issue_court_item = $row['issue_court_item']; ?>

                            <h2 class="text-white text-center"><small style="font-size:15px;" class="text-white">Issue : </small><span data-plugin="counterup"> <?php echo $issue_court_item; ?></span></h2>
                           
                        </div>
                    </div>
                    
                    </a>

<a href = "court_item_current.php">

                    <div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="card-box widget-box-1" style="background-color:#c1dcf2;">
                        <i class="text-muted pull-right" data-placement="bottom">
                                <p class="text-muted">
                             
                           
                             <!-- <i class="label label-default">Meter Square</i> -->
                              </p> </i>

                              
                            <h4 class="text-white">Court Item<small></small></h4>

                            <?php 
                            $current_court_item_qry = mysqli_query($my_connection, "SELECT SUM(quantity) as current_court_item FROM asset_available WHERE category_id = 3;") or die(mysqli_error($my_connection));                          
                            $row = mysqli_fetch_assoc($current_court_item_qry);
                            $current_court_item = $row['current_court_item']; ?>
                            <h2 class="text-white text-center"> <small style="font-size:15px;" class="text-white">Current: </small> <span data-plugin="counterup"> <?php 
                          echo $current_court_item;

                            ?></span></h2>
                             <p class="text-muted">
                                 
                              </p> 
                        </div>
                    </div>
</a>





         

</div>

               
               <?php require_once('my_footer.php'); ?>
            </div>
        </div>
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

        <!-- Counterup  -->
        <script src="assets/plugins/waypoints/lib/jquery.waypoints.js"></script>
        <script src="assets/plugins/counterup/jquery.counterup.min.js"></script>

        <!-- Morris chart js -->
        <script src="assets/plugins/morris/morris.min.js"></script>
        <script src="assets/plugins/raphael/raphael-min.js"></script>

        <!-- Dashboard 4 js -->
		<script src="assets/pages/jquery.dashboard_4.js"></script>

        <!-- App core js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.bootstrap.js"></script>

        <script src="assets/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="assets/plugins/datatables/buttons.bootstrap.min.js"></script>
        <script src="assets/plugins/datatables/jszip.min.js"></script>
        <script src="assets/plugins/datatables/pdfmake.min.js"></script>
        <script src="assets/plugins/datatables/vfs_fonts.js"></script>
        <script src="assets/plugins/datatables/buttons.html5.min.js"></script>
        <script src="assets/plugins/datatables/buttons.print.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.fixedHeader.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.keyTable.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="assets/plugins/datatables/responsive.bootstrap.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.scroller.min.js"></script>
        <script src="assets/plugins/datatables/dataTables.colVis.js"></script>
        <script src="assets/plugins/datatables/dataTables.fixedColumns.min.js"></script>

        <script src="assets/pages/datatables.init.js"></script>

        

        <script type="text/javascript">
            $(document).ready(function () {
                $('#datatable').dataTable();
                $('#datatable-keytable').DataTable({keys: true});
                $('#datatable-responsive').DataTable();
                $('#datatable-colvid').DataTable({
                    "dom": 'C<"clear">lfrtip',
                    "colVis": {
                        "buttonText": "Change columns"
                    }
                });
                $('#datatable-scroller').DataTable({
                    ajax: "assets/plugins/datatables/json/scroller-demo.json",
                    deferRender: true,
                    scrollY: 380,
                    scrollCollapse: true,
                    scroller: true
                });
                var table = $('#datatable-fixed-header').DataTable({fixedHeader: true});
                var table = $('#datatable-fixed-col').DataTable({
                    scrollY: "300px",
                    scrollX: true,
                    scrollCollapse: true,
                    paging: false,
                    fixedColumns: {
                        leftColumns: 1,
                        rightColumns: 1
                    }
                });
            });
            TableManageButtons.init();

        </script>

    </body>
</html>