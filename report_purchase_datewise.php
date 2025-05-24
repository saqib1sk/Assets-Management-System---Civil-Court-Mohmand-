<?php
require_once('session_data.php');
require_once('my_connection.php');
$today = date("Y-m-d");
?>
<!DOCTYPE html>
<html lang="en">  
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <?php include('my_meta.php'); ?>
    <link href="assets/plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" type="text/css" />
    <!-- DataTables link files -->
    <?php include('datatable_link_files.php'); ?>
    <!-- DataTables link files end -->
</head>
<body>
    <!-- Navigation Bar-->
    <?php include('my_header.php'); ?>
    <!-- End Navigation Bar-->

    <div class="wrapper">
        <div class="container">
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="page-title">Purchase DateWise Report</h4>
                </div>
            </div>

            <div class="row" style="margin-top:10px !important;">
                <div class="card-box" style="margin-left:10px; margin-right:10px;">
                  <div class="row">
                  <div class="col-md-3 col-sm-6"> 
                  <label>Select Category</label>
                  <select name="category_id" class="form-control category" id="category" tabindex="" onchange="ajaxCall()">
                   <option value="">Select Category</option>
                   <?php 
                       $select_qry = mysqli_query($my_connection, "SELECT * FROM categories ORDER BY title ASC") or die(mysqli_error($my_connection)); 
                       while ($row = mysqli_fetch_array($select_qry)) {
                           $cat_id =  $row['id'];
                           $cat_title = $row['title'];
                           echo "<option value='$cat_id'>$cat_title</option>";
                       }
                   ?>
                  </select>
                  </div>
                  <div class="col-md-3 col-sm-6"> 
                  <label>From Date</label>
                  <div class="input-group">
                      <input type="date" class="form-control from" name="from_date" value="<?php echo $today;?>" onchange="ajaxCall()" />
                      <span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
                  </div>
                  </div>

                  <div class="col-md-3 col-sm-6"> 
                     <label>To Date</label>
                  <div class="input-group">
                                  <input type="date" class="form-control to"  name="to_date" value="<?php echo $today;?>" onchange="ajaxCall()" />
                                  <span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
                              </div>
                            </div>
                  </div>
                </div>
                </div>

            <div class="row">
                <input type='button' id='btn' value='Print' onclick='printDiv()' class="btn btn-success btn-sm" style="margin:10px; float:left; width:80px;" />
            </div>
                
            <div class="card-box" id="print_area">
              <div class="row" style="border-bottom:1px solid gray;">
              <div class="col-sm-2 col-md-2 col-xs-2 text-center">
                <img src="assets/images/logo.png" style=""/>
                </div>
               <div class="col-sm-10 col-md-10 col-xs-10 text-center">
               <h3 style="font-weight: bold;">Office of the</h3>
               <h3 style="font-weight: bold; margin-top:-14px;">Senior Civil Judge, District Mohmand</h3>
               <h3 style="margin-top:-14px;"><span style="font-size:14px;">Email: scjmohmand@gmail.com - Tel: 0924-290145</span></h3>
               <h3 style="margin-top:-10px;"><strong>Purchase DateWise Report</strong></h3>
               </div>
              </div>
                <div class="row" style="margin-top:10px;">
                <div id="ajaxData">
                    </div>
                </div>
            </div>

            <span class="no-print">
                <?php include('my_footer.php'); ?>
            </span>
        </div> <!-- end container -->
    </div> <!-- end wrapper -->
    <script>
        function printDiv() {
            var printContents = document.getElementById('print_area').innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
        function ajaxCall() {
            var category_id = $('.category').val();
            var from_date = $('.from').val();
            var to_date = $('.to').val();
            $.ajax({
                type: 'POST',
                url: 'report_purchase_datewise_ajax.php',
                data: {
                    category_id:category_id,
                    from_date: from_date,
                    to_date:to_date
                },
                success: function(data) {
                    $("#ajaxData").html(data);
                }
            });
        }
    </script>
    <?php include('reports_all_links_files.php'); ?>
</body>
</html>
