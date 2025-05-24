<?php
require_once('session_data.php');
    require_once('my_connection.php');
   $today = date("Y-m-d");
?>
<!DOCTYPE html>
<html>  
<head>
     <link href="assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
        <?php require_once('my_meta.php'); ?>
          <link href="assets/plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" type="text/css" />
            <!-- DataTables link files -->
            <?php require_once('datatable_link_files.php'); ?>
          <!-- DataTables link files end -->
        <style>
        .datepicker{
            z-index: 2000 !important;
        }     
#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}
#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}
#customers tr:nth-child(even){background-color: #f2f2f2;}
#customers tr:hover {background-color: #ddd;}
#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
        </style> 
</head>
    <body>
        <!-- Navigation Bar-->
         <?php require_once('my_header.php'); ?>
        <!-- End Navigation Bar-->
        <div class="wrapper">
            <div class="container">
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Item Wise Report</h4>
                        <ol class="breadcrumb">
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            
                            
                            <div class="row">
                                <div class="col-md-12">
                     <form class="form-inline" role="form" method="post">

                     <div class="form-group col-md-2">
                                            <label class=" control-label">Select Category </label>
                                            <div class="">
                                            <select name="category_id" class="form-control category_id" onchange="ajaxCall()" id="category_id">
                                               <option value="">Select Category</option>
                                           <?php $select_qry = mysqli_query($my_connection,"select * from categories") or die (mysqli_error($my_connection)); 
                                           while($row=mysqli_fetch_array($select_qry)){
                                            $id =  $row['id'];
                                            $title = $row['title'];
                                            echo "<option value = '$id'>$title</option>";
                                           }
                                           
                                            ?>
                                           </select>
                                            </div>
                                        </div>

                                      <!-- ******************************************************************* -->
                                      <div class="form-group col-md-2">
                                            <label class=" control-label">Select Supply/Invoice</label>
                                            <div class="">
                                            <select name="supply_id" class="form-control category_id" id="supply_id">
                                               <option value="">Select Supply/Invoice No</option>

                                           </select>
                                            </div>
                                        </div>
                                      <!-- ******************************************************************* -->

                                        <div class="col-md-2"> 
                                        <label>From Date</label>
                                        <div class="input-group">
                                                        <input type="text" class="form-control from" name = "from_date" placeholder="mm/dd/yyyy"  id="datepicker-autoclose" onchange="ajaxCall()">
                                                        <span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
                                                    </div>
                                                    </div>
                                     
                                        <div class="col-md-2"> 
                                        
                                          <label>To Date</label>
                                        <div class="input-group">
                                                        <input type="text" class="form-control to"  name = "to_date" placeholder="mm/dd/yyyy"  id="datepicker-autoclose2" onchange="ajaxCall()">
                                                        <span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
                                                    </div></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                     <input type='button' id='btn' value='Print' onclick='printDiv();' class="btn btn-success" style ="margin:10px; float:left;" />
                </div>

                        <div class="card-box table-responsive">
                            <h4 class="m-t-0 header-title">
                            <!-- <button type="button" class="btn btn-success shadow mb-4" onclick="export_all()">Export To CSV</button> -->
                           
                           <div id="DivIdToPrint" class="row">
                <div class="col-lg-12">
               
                  <div class="panel ">
                    <div class="panel-body">
                      <div class="table-responsive" id="ajaxData">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
</div>

               <span class="no-print">
                <?php require_once('my_footer.php'); ?>
                </span>

            </div> <!-- end container -->
        </div>
        <script>
function printDiv() 
{
  var divToPrint=document.getElementById('DivIdToPrint');
  var newWin=window.open('','Print-Window');
  newWin.document.open();
  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
  newWin.document.close();
  setTimeout(function(){newWin.close();},10);
}
                            </script>
        <!-- end wrapper -->
  <!-- reports_all_links_files -->
  <?php require_once('reports_all_links_files.php'); ?>
                <!-- End reports_all_links_files --> 
    </body>
</html>

<script>

function export_all() {
    $('.export').DataTable().destroy();
    $("#customers").tableHTMLExport({
      type: 'csv',
      filename: 'Purchase Date Report_' + Math.floor((Math.random() * 10000000) + 1) + '.csv',
    });
    $('#customers').DataTable();
  }


     function ajaxCall() {
    var from_date = $('.from').val();
    var to_date = $('.to').val();
    var category_id = $('.category_id').val();
    var supply_id = $('.supply_id').val();


    $.ajax({
      type: 'POST',
      url: 'report_ajax.php',
      data: {
        c_from_date: from_date,
        c_to_date: to_date,
        category_id: category_id,
        supply_id: supply_id

      },
      success: function(data) {

        $("#ajaxData").html(data);

      }
    }).done(function() {
      $(".data_table").DataTable();
      autoCall();
    });  


    var category_id = document.getElementById("category_id").value;

    // AJAX request to fetch supply/invoice numbers based on the selected category
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById("supply_id").innerHTML = xhr.responseText;
        }
    };

    xhr.open("GET", "report_ajax.php?category_id=" + category_id, true);
    xhr.send();

  }
  window.onload = function() {
    ajaxCall();
  }
</script>

