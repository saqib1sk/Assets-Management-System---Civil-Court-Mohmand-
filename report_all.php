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


<script src="dist/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $(".category").change(function() {
        var ids = $(".category:checked").map(function() {
            return this.value;
        }).get();  // Modified to get an array of selected values

        var dataString = 'category_ids=' + JSON.stringify(ids);  // Modified to send the array as JSON

        $.ajax({
            type: "POST",
            url: "get_item.php",
            data: dataString,
            cache: false,
            success: function(html) {
                $(".item-checkboxes").html(html);  // Modify the appropriate container for item checkboxes
            }
        });
    });

    // Initially populate the item checkboxes when the page loads
    $(".category").trigger("change");
});

</script>

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
                        <h4 class="page-title">DateWise Report</h4>
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

<div class="form-group col-md-2" style="width: 220px;">
    <label class="control-label">Select Category</label>
    <input type="text" id="search" placeholder="Search categories..." onkeyup="filterCategories()">
    <div class="slider-container">
        <div id="categoryList">
            <input type="checkbox" name="category_id[]" value="0" class="form-check-input category" id="category_all" checked onchange="ajaxCall()">
            <label for="category_all">All</label><br>
            <?php
            $select_qry = mysqli_query($my_connection, "SELECT * FROM categories ORDER BY title ASC") or die(mysqli_error($my_connection));
            while ($row = mysqli_fetch_array($select_qry)) {
                $id =  $row['id'];
                $title = $row['title'];
                echo '<input type="checkbox" name="category_id[]" value="' . $id . '" class="form-check-input category" onchange="ajaxCall()" id="category_' . $id . '">';
                echo '<label for="category_' . $id . '">' . $title . '</label><br>';
            }
            ?>
        </div>
    </div>
</div>



<div class="form-group col-md-2" style="width:220px;">
    <label class="control-label">Item Name</label>
    <input type="text" id="search1" placeholder="Search categories..." onkeyup="filterCategories1()">
    <div class="slider-container">
    <div>
        <div class="item-checkboxes itemList" id="itemList">
            <!-- Item checkboxes will be dynamically populated here -->
        </div>
    </div>
    </div>
</div>

                                        <!--////////////-->
                                        <div class="form-group col-md-2" style="width:220px;">
                                            <label class=" control-label">Select Court/Office</label>
                                            <input type="text" id="search2" placeholder="Search categories..." onkeyup="filterCategories2()">
                                            <div class="slider-container">
                                            <div class="deptList">
                                            <input type="checkbox" name="dept_id[]" value="0" class="form-check-input departments" id="dept_all" checked onchange="ajaxCall()">
                                            <label for="category_all">All</label><br>
                                           <?php $select_departments = mysqli_query($my_connection,"select * from departments ORDER BY title ASC") or die (mysqli_error($my_connection)); 
                                           while($row=mysqli_fetch_array($select_departments)){
                                            $id =  $row['id'];
                                            $title = $row['title'];
                                           echo '<input type="checkbox" name="dept_id[]" value="'.$id.'" class="form-check-input departments" id="dept" onchange="ajaxCall()">';
                                            echo '<label for="dept">' . $title . '</label><br>';
                                           }
                                           
                                            ?>
                                            </div> 
                                        </div> 
                                        </div>



                                        <!--////////////-->


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
    var category_ids = $(".category:checked").map(function() {
        return this.value;
    }).get();
    
    // Retrieve selected department IDs
    var department_ids = $(".departments:checked").map(function() {
        return this.value;
    }).get();
    
    // Retrieve selected item IDs
    var item_ids = $(".item:checked").map(function() {
        return this.value;
    }).get();

    console.log("Sending AJAX request with data:", {
    from_date_a: from_date,
    to_date_a: to_date,
    category_a: category_ids,
    departments_a: department_ids,
    item_a: item_ids
});

    $.ajax({
        type: 'POST',
        url: 'report_ajax.php',
        data: {
            from_date_a: from_date,
            to_date_a: to_date,
            category_a: category_ids,  // Send array of category IDs
            departments_a: department_ids,  // Send array of department IDs
            item_a: item_ids  // Send array of item IDs
        },
        success: function(data) {
            $("#ajaxData").html(data);
        }
    }).done(function() {
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
function filterCategories1() {
    var input, filter, itemCheckboxes, labels, i, txtValue;
    input = document.getElementById('search1');
    filter = input.value.toUpperCase();
    itemCheckboxes = document.querySelectorAll('.itemList input[type="checkbox"]');
    labels = document.querySelectorAll('.itemList label');

    for (i = 0; i < labels.length; i++) {
        txtValue = labels[i].textContent || labels[i].innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            itemCheckboxes[i].style.display = ''; // Show the item checkbox
            labels[i].style.display = ''; // Show the label
        } else {
            itemCheckboxes[i].style.display = 'none'; // Hide the item checkbox
            labels[i].style.display = 'none'; // Hide the label
        }
    }
}

function filterCategories2() {
    var input, filter, itemCheckboxes, labels, i, txtValue;
    input = document.getElementById('search2');
    filter = input.value.toUpperCase();
    itemCheckboxes = document.querySelectorAll('.deptList input[type="checkbox"]');
    labels = document.querySelectorAll('.deptList label');

    for (i = 0; i < labels.length; i++) {
        txtValue = labels[i].textContent || labels[i].innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            itemCheckboxes[i].style.display = ''; // Show the item checkbox
            labels[i].style.display = ''; // Show the label
        } else {
            itemCheckboxes[i].style.display = 'none'; // Hide the item checkbox
            labels[i].style.display = 'none'; // Hide the label
        }
    }
}

</script>