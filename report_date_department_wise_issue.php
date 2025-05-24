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
.slider-container {
  display: flex;
  flex-direction: row;
  max-width: 100%;
  padding: 10px 0;
  border: 1px solid #ccc;
  border-radius: 5px;
  overflow-y: auto; /* Enable vertical scrolling */
  max-height: 150px; /* Set a max height for the fixed area */
}

.slider-container div {
  margin-right: 10px; /* Adjust margin between checkboxes */
}

.slider-container div:last-child {
  margin-right: 0; /* Remove margin for the last checkbox */
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
                        <h4 class="page-title">Court/Office wise Report</h4>
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

                     

                     <div class="form-group col-md-2" style="width:220px;">
    <label class="control-label">Select Court/Office</label>
    <input type="text" id="search" placeholder="Search Court/Office" onkeyup="filterCategories()">
    <div class="slider-container">
    <div id="categoryList">
    <input type="checkbox" name="dept[]" value="0" class="form-check-input dept" id="dept_all" checked onchange="ajaxCall()">
        <label for="dept_all">All</label><br>
        <?php
        $select_qry = mysqli_query($my_connection, "select * from departments ORDER BY title ASC") or die(mysqli_error($my_connection));
        while ($row = mysqli_fetch_array($select_qry)) {
            $id =  $row['id'];
            $title = $row['title'];
            echo '<input type="checkbox" name="dept[]" value="' . $id . '" class="form-check-input dept" id="dept" onchange="ajaxCall()">';
            echo '<label for="dept">' . $title . '</label><br>';
        }
        ?>
        
    </div>
      </div>
</div>
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

        // Retrieve selected category IDs
        var dept_ids = $(".dept:checked").map(function() {
        return this.value;}).get();

        console.log(from_date, to_date, dept_ids);

    $.ajax({
      type: 'POST',
      url: 'report_ajax.php',
      data: {
      d_from_date: from_date,
      d_to_date: to_date,
      department_id: dept_ids
      },
      success: function(data) {

        $("#ajaxData").html(data);

      }
    }).done(function() {
      $(".data_table").DataTable();
      autoCall();
    });
  }
  window.onload = function() {
    ajaxCall();
  }
  function filterCategories() {
  var input, filter, ul, li, a, i, txtValue;
  input = document.getElementById('search');
  filter = input.value.toUpperCase();
  ul = document.getElementById('categoryList');
  li = ul.getElementsByTagName('label');

  for (i = 0; i < li.length; i++) {
    a = li[i];
    txtValue = a.textContent || a.innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a.style.display = ''; // Show the label
      a.previousElementSibling.style.display = ''; // Show the checkbox
    } else {
      a.style.display = 'none'; // Hide the label
      a.previousElementSibling.style.display = 'none'; // Hide the checkbox
    }
  }
}   
</script>