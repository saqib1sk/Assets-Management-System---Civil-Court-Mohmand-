<?php
require_once('session_data.php');

?>

<?php
    require_once('my_connection.php');
    require_once('function.php');
    $warning = '';
    $success = '';
   // $message='';
  if (isset($_POST['btnsave'])) 
    {
      $demand_report_no = $_POST['demand_report_no'];
      $demand_date = $_POST['demand_date'];
      $department_id = $_POST['department_id'];
      $employee_id = $_POST['employee_id']; 
      $description = $_POST['description']; 


      $check_qry = mysqli_query($my_connection, "SELECT demand_report_no FROM issue_assets WHERE demand_report_no = '$demand_report_no'") or die (mysqli_error($my_connection));

 $num_rows = mysqli_num_rows($check_qry); 


if($num_rows == 0){
 
 $target_dir = "assets_images/";
  if(@$_FILES["upload_file"]["name"][0] != null){
         
      $file_name =  $_FILES['upload_file']['name']; 
      $file_type = $_FILES['upload_file']['type']; 
      $file_size = $_FILES['upload_file']['size']; 
      $tmp_name = $_FILES['upload_file']['tmp_name'];
      $explode_file_name = explode('.',$file_name); 
    $file_extension = strtolower(end($explode_file_name));
    $file_new_name = uniqid().'.'.$file_extension;
    $path = $target_dir.$file_new_name;





   
      if($file_extension == 'jpg' or $file_extension == 'png'  or $file_extension == 'jpeg'  or $file_extension == 'PNG'  or $file_extension == 'JPG'  or $file_extension == 'JPEG'){
        
        if(move_uploaded_file($tmp_name, $path)){

      ///////////Insertion in issue_assets table
 $query_a = "INSERT INTO `issue_assets`(`demand_report_no`, `demand_date`, `department_id`, `employee_id`, `description`, `file_path`) 
                                VALUES ('$demand_report_no','$demand_date','$department_id','$employee_id','$description','$path')";
     $run1 = mysqli_query($my_connection, $query_a);
     $last_issue_asset_id = mysqli_insert_id($my_connection);

      $success = '<div class="alert alert-success alert-block alert-dismissible fade in iconic-alert" role="alert">
                                    <div class="alert-icon">
                                        <span class="gcon gcon-emoji-happy centered-xy"></span>
                                    </div>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><span class="mcon mcon-close"></span></span></button>
                                    <strong>Success!</strong> Record Inserted With  Image.
                            </div>';


}     //// move file insertion query close
      }   /// check extention close
      else{
$warning = '<div class="alert alert-danger alert-block alert-dismissible fade in iconic-alert" role="alert">
                                <div class="alert-icon">
                                    <span class="gcon gcon-hand centered-xy"></span>
                                </div>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><span class="mcon mcon-close"></span></span></button>
                                <strong>Oh snap!</strong> Image File Not Valid
                            </div>';

      }   /// extention not valid close 
  }    /// file not empty close

  else{
     ///////////Insertion in issue_assets table without image
 $query_b = "INSERT INTO `issue_assets`(`demand_report_no`, `demand_date`, `department_id`, `employee_id`, `description`, `file_path`) 
                                VALUES ('$demand_report_no','$demand_date','$department_id','$employee_id','$description','IMAGE NOT YET ADDED')";
     $run1 = mysqli_query($my_connection, $query_b);
     $last_issue_asset_id = mysqli_insert_id($my_connection);

      $success = '<div class="alert alert-success alert-block alert-dismissible fade in iconic-alert" role="alert">
                                    <div class="alert-icon">
                                        <span class="gcon gcon-emoji-happy centered-xy"></span>
                                    </div>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><span class="mcon mcon-close"></span></span></button>
                                    <strong>Success!</strong> Record Inserted With Out Image.
                            </div>';

  } /// without image insertion close

 $count = COUNT($_POST['item_id']);
      for ($i = 0; $i < $count; $i++) {
        $item_id = $_POST['item_id'][$i];
         // $category_id = $_POST['category_id'][$i];
         $issue_qty = $_POST['issue_qty'][$i];
         $current_qty = $_POST['current_qty'][$i];
         $final_current_quantity = $current_qty - $issue_qty;

         
       

 /////////////Insertion Of issue_asset_details table
        $query_c = "INSERT INTO `issue_asset_details`(`issue_asset_id`, `available_asset_id`, `quantity_issue`)
                                              VALUES ('$last_issue_asset_id','$item_id','$issue_qty')";
        $run = mysqli_query($my_connection, $query_c);


       
       
/////////////Update Of asset_available


           $update_asset_available = "UPDATE `asset_available` SET `quantity`= '$final_current_quantity' WHERE `id` = '$item_id'"; 
           $run_update_asset_available = mysqli_query($my_connection, $update_asset_available) or die(mysqli_error($my_connection));
    if($run_update_asset_available){

        $success = '<div class="alert alert-success alert-block alert-dismissible fade in iconic-alert" role="alert">
        <div class="alert-icon">
            <span class="gcon gcon-emoji-happy centered-xy"></span>
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><span class="mcon mcon-close"></span></span></button>
        <strong>Success!</strong> Record Inserted With Out Image.
</div>';
      
    }else{
        $warning = '<div class="alert alert-danger alert-block alert-dismissible fade in iconic-alert" role="alert">
        <div class="alert-icon">
            <span class="gcon gcon-hand centered-xy"></span>
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><span class="mcon mcon-close"></span></span></button>
        <strong>Oh snap!</strong> Record Already exist
    </div>';
    }




} //loop product close




}  /// check query close

else{


     $warning = '<div class="alert alert-danger alert-block alert-dismissible fade in iconic-alert" role="alert">
                                    <div class="alert-icon">
                                        <span class="gcon gcon-hand centered-xy"></span>
                                    </div>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><span class="mcon mcon-close"></span></span></button>
                                    <strong>Oh snap!</strong> Record Already exist
                                </div>';
} 

} // btn add isset post close

?>

  
<!DOCTYPE html>
<html>
<title>Asset Management System</title>
    

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
//get employees from employees table on department_id
$(document).ready(function()
{
$(".department_id").change(function()
{
  //  alert("hello");
var department_id=$(this).val();
//alert(department_id);
var dataString = 'department_id='+ department_id;
$.ajax
({
type:"POST",
url: "get_employees.php",
data: dataString,
cache: false,
success: function(html)
{
$(".employees_id").html(html);
} 
});
});
});
</script>

<script type="text/javascript">
// get quantity from availible_assets table by assets_id
// $(document).ready(function()
// {
// $(".item").change(function()
// {
   
// var id=$(this).val();
// //alert(id);
// var dataString = 'id='+ id;
// $.ajax
// ({
// type:"POST",
// url: "get_asset_quantity.php",
// data: dataString,
// cache: false,
// success: function(html)
// {
// $(".current_qty").html(html);
// } 
// });
// });
// });
// </script>
<script type="text/javascript">
// get quantity from availible_assets table by assets_id
// $(document).ready(function()
// {
// $(".item").change(function()
// {
   
// var id=$(this).val();
// //alert(id);
// var dataString = 'id='+ id;
// $.ajax
// ({
// type:"POST",
// url: "get_category_id.php",
// data: dataString,
// cache: false,
// success: function(html)
// {
// $(".category_id").html(html);
// } 
// });
// });
// });

    function get_category_id(id) {
      var item_id = $("#item_id"+id).val();
     // alert(item_id);
     console.log(item_id);
  $.ajax({
    url: "get_category_id.php",
    type: "POST",
    data: {
      'item_id': item_id
    },
    success: function(data) {
      $("#category_id"+id).html(data);
    }
  });
}

/// for multiple
function get_asset_quantity(id) {
    var item_id = $("#item1").val();

    $.ajax({
        url: "get_asset_quantity.php",
        type: "POST",
        data: {
            'item_id': item_id
        },
        dataType: "json",
        success: function(result) {
            console.log("Response:", result);
            $("#current_qty" + id).html(result.field);  // Set the HTML
            $("#issue_qty" + id).val(result.quantity).attr('max', result.quantity);
        }
    });
}

///////// for single
// $(document).ready(function() {
//     $("input[name^='issue_qty']").on("input", function() {
//         var enteredValue = parseInt($(this).val());
//         var max = parseInt($(this).attr("max"));

//         if (!isNaN(enteredValue) && !isNaN(max)) {
//             if (enteredValue > max) {
//                 $(this).val(max); // Set value to the maximum if it exceeds
//             }
//         }
//     });
// });


//// for multiple
$(document).ready(function() {
    $(document).on("input", "input[name^='issue_qty']", function() {
        var enteredValue = parseInt($(this).val());
        var max = parseInt($(this).attr("max"));

        if (!isNaN(enteredValue) && !isNaN(max)) {
            if (enteredValue > max) {
                $(this).val(max); // Set value to the maximum if it exceeds
            }
        }
    });
});

</script>

 <script type="text/javascript">
      let reorderid = 1;
     
      function orderRow() {
        // var item_no1 = $("#item_no1").val();
    //  alert(item_no1);
        reorderid++;
        $.ajax({
          url: 'issue_assets_append_row.php',
          method: 'POST',
          data: {
            'count': reorderid,
           // 'item_no': item_no1
          },
          success(data) {
            $('#edu_new_row').append(data);
            $('.select2').select2({
              theme: 'bootstrap4'
            });
          }
        });
      }


      function remove_edu(id) {
        let div = '#edu_data_row' + id;
        $(div).remove();
        calculate_grand_total();
        // finaly_Discounts();
      }


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

//   function check_quantity(id) {
//   alert();
  
//     var issue_qty = parseInt($('#issue_qty'+id).val());
//     var available_qty = parseInt($('#current_qty'+id).val());
//   alert(issue_qty);
//   alert(available_qty);
//     if (issue_qty > available_qty) {
//       //  alert("Sorry, quantity exceeds the available limit.");
//         $('#issue_qty'+id).css('border-color', 'red');
//         $('#error_limit'+id).css('display', 'block');
//         $('#issue_qty'+id).val('');
//     } else {
//        // alert("Yes, quantity is available.");
//         $('#issue_qty'+id).css('border-color', 'silver');
//         $('#error_limit'+id).css('display', 'none');
//     }
// }
    </script>
<style>
  .slider-container {
  display: flex;
  flex-direction: row;
  max-width: 100%;
  padding: 0px 0;
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
        
       
        <!-- End Navigation Bar-->


        <div class="wrapper">
            <div class="container">
            
            
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group pull-right m-t-15">
                          
                        </div>



                        <!-- in wordpress we define in themes----child-theme----function.php file -->
                        <!-- This method for calling shortcode in wordpress php -->
                        <!-- [nveed] -->
 



                         <!-- include function.php file above -->
                        <!-- This method for calling shortcode in custome php -->
                        <?php //core_function(); ?>




                        <h4 class="page-title">DEDUCT STOCK</h4>
                        <ol class="breadcrumb">
                        
                        </ol>
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box" style="background-color:#a3c3e0;">
                            
                            
                            <div class="row">
                            <?php echo $success; ?>
            <?php echo $warning; ?>
                                <div class="col-md-12">
   <form class="" role="form" method="post" enctype="multipart/form-data">
                                        
                                        
                                        <div class="row">

                                                <div class="form-group col-md-1">
                                            <label class=" control-label">Demand #</label>
                                            <div class="demand_report_no">
                                            <input type="text" class="form-control" name="demand_report_no"  />
                                            
                                            </div>
                                        </div> 

                                          <div class="form-group col-md-1">
                                            <label class=" control-label">Date</label>
                                            <div class="">
                                                <input type="date" class="form-control" placeholder="" name = "demand_date" required />
                                            </div>
                                        </div>

                                          <div class="form-group col-md-2">
                                            <label class=" control-label">Court/Office/Other</label>
                                            <div class="">
                                            <select name="department_id" class="form-control department_id" id="department_id"  tabindex="">
                                               <option value="">Court/Office/Other</option>
             <?php $select_qry = mysqli_query($my_connection,"select d.* from departments d ") or die (mysqli_error($my_connection)); 
                                           while($row=mysqli_fetch_array($select_qry)){
                                            $id =  $row['id'];
                                            $title = $row['title'];
                                            echo "<option value = '$id'>$title</option>";
                                           }
                                           
                                            ?>
                                           </select>
                                            </div>
                                        </div>


                                          <div class="form-group col-md-1">
                                            <label class=" control-label">Rec Name</label>
                                            <div class="">
                                            <select name="employee_id" class="form-control employees_id"  id="employees_id" tabindex="">
                                               <option value="">Select Receiver Name & Designation</option>
            
                                           </select>
                                            </div>
                                        </div>
										
										    <div class="" style="" id="edu_new_row">
                                <div class="" id="edu_data_row1">
                        <input type="hidden" name="row[]" value="1">

                        <!--***************************************************************-->
<div class="form-group col-md-2">
    <label class="control-label">Category</label>
    <input class="form-control col-md-3" style="height:30px;" type="text" id="categorySearch" placeholder="Search categories..." onkeyup="filterCategoryDropdown()">
    <div class="slider-container">
        <select multiple name="category_id[]" class="form-control category" id="category1" tabindex="" onchange="get_item(1)" required>
            <option value="">Select Category</option>
            <?php 
                $select_qry = mysqli_query($my_connection, "SELECT * FROM categories ORDER BY title ASC") or die(mysqli_error($my_connection)); 
                while ($row = mysqli_fetch_array($select_qry)) {
                    $id =  $row['id'];
                    $title = $row['title'];
                    echo "<option value='$id'>$title</option>";
                }
            ?>
        </select>
    </div>
</div>
 <div class="form-group col-md-2">
    <label class="control-label">Select Item</label>
    <input class="form-control col-md-2" style="height:30px;" type="text" id="search" placeholder="Search items..." onkeyup="filteritems()">
    <div class="slider-container">
        <div>
            <select style="width:165px;" multiple name="item_id[]" class="form-control item" id="item1" onchange="get_asset_quantity(1)" tabindex="" required>
                <option value="">Select Item</option>
                                           </select>
                                            </div>
                                           </div>
 </div>
                        <!--***************************************************************-->

                                     <!--   <div class="form-group col-md-2">
                                            <label class=" control-label">Select Item</label>
                                            <input class="form-control col-md-2" type="text" id="search" placeholder="Search items..." onkeyup="filteritems()">
                                            <div class="slider-container">
                                            <div class="">
                                            <select style="width:165px;" name="item_id[]" class="form-control item" id="item_id1" multiple onchange="get_asset_quantity(1), get_category_id(1)">
                                               <option value="">Select Item</option>
             <?php $select_qry = mysqli_query($my_connection,"select aa.*,i.item_name from asset_available aa 
                                                              join items i on aa.item_id = i.id") or die (mysqli_error($my_connection)); 
                                           while($row=mysqli_fetch_array($select_qry)){
                                            $id =  $row['id'];
                                            $item_name = $row['item_name'];
                                            echo "<option value = '$id'>$item_name</option>";
                                           }
                                           
                                            ?>
                                           </select>
                                            </div>
                                          </div>
                                        </div>  -->


                                        
                                        <div class="form-group col-md-1">
                                            <label class=" control-label">Curnt Qty</label>
                                            <div class="current_qty" id="current_qty1">
                                            <input type="number" class="form-control" readonly />
                                            </div>
                                        </div>


                                        <div class="form-group col-md-1">
                                        <label class=" control-label">Issu Qty</label>
                                      <span ><small style="float:right; color:red; display:none;" id="error_limit" >Quantity exceeds</small></span>
                                            <div class="">
 <input type="number" class="form-control " placeholder="" id="issue_qty1" name = "issue_qty[]" onchange="check_quantity(1)"  max=""  required/>
                                            </div>
                                        </div>

                                             <div class="col-md-1">
                                          <div class="form-group">
                                           <br/>
                                            <button type="button" class="btn btn-success" onclick="orderRow()"><i class="fa fa-plus"></i></button>
                                         </div>
                                         </div>                                
</div>
</div>

                                        </div>




                                    
  <div style="clear:both; margin-bottom:-15px;"></div>          
                            <hr>          

                                     

                                      <div class="row" style="margin-top:-10px;">
                                        <div class="form-group col-md-3">
                                            <label class=" control-label">Other Detail</label>
                                            <div class="">
                                                <input type="text" class="form-control" placeholder="" name = "description" required rows="" cols=""></input>
                                            </div>
                                        </div>

                                      

                                        <div class="form-group col-md-2">
                                          <label class=" control-label"></label>
                                                <div class="">                                                                                            
                                                    <!-- <input type="file" name = "upload_file" value = "" /> -->
<input style="margin-top:5px;" id="file" type="file" name="upload_file" onchange="showImage1(event)" t accept="image/*" class="form-control" style="overflow: hidden;" placeholder="Insert Your Image">
<!-- <img id="img" class="shadow" style="float:right; border: 1px blue solid; border-radius: 10%; margin-top: 4%" width="130px;" src="assets/images/file.PNG" height="130px" alt="Image"> -->
                                                </div>

                                            </div>

                                            <label class=" control-label col-m-12"></label>
<div class="form-group" style="float: right;">
<button style="margin-top:25px; margin-right:43px;" type="submit" class="btn btn-success waves-effect waves-light m-l-8 btn-md" name ="btnsave" >ADD</button>
</div>


                                            <!-- <div class="form-group col-md-4">
                                            <label class=" control-label">Minimum Quantity</label>
                                            <div class="">
                                                <input type="text" class="form-control" placeholder="" name = "min_quantity" required />
                                            </div>
                                        </div> -->


                                    

                                         <!-- <div class="form-group col-md-4">
                                          <label class=" control-label">         </label>
                                                
                                                <div class="">                                                                                            
                                                    <input type="file" name = "upload_file" value = "" />
                                     
         
                                                </div>

                                            </div> -->
                                                </div>
                                        
                                       


                                    </form>
                                
                                </div>

                                


                            </div>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive" style="background-color:silver;">
                            <h4 class="m-t-0 header-title"><b>Deducted Stock List</b></h4>
                            
                            <table id="datatable" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Serial #</th>
            <th>Demand / Report No.</th>
            <th>Demand Date</th>
            <th>Court/Office/Other</th>
            <th>Issue Items Details</th>
            <th>Receiver Name/Designation</th>
            <th>Other Details</th>
           
            <th>File</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $today = date("Y-m-d");
        $select_qry2 = mysqli_query($my_connection, "SELECT ia.*, d.title,e.name,e.designation FROM issue_assets ia
                                                    JOIN departments d ON ia.department_id = d.id
                                                    join employees e on ia.employee_id = e.id") or die(mysqli_error($my_connection));
        $n = 1;
        while ($row2 = mysqli_fetch_array($select_qry2)) {
            $id = $row2['id'];
            echo '<tr role="row" class="odd">';
            echo '<td>' . $n++ . '</td>';
            echo '<td class=""><b>' . $row2['demand_report_no'] . '</b></td>';
            echo '<td class="">' . date("j F, Y", strtotime($row2['demand_date'])) . '</td>';
            echo '<td class=""><b>' . $row2['title'] . '</b></td>';
            echo '<td class="">';
            echo '<table class="table table-striped table-bordered">';
            echo '<tr>
            <th>Item Name</th>
            <th>Quantity</th>
                </tr>';
            $select_qry = mysqli_query($my_connection, "SELECT iad.*,aa.item_id,i.item_name FROM issue_asset_details iad
                                                        join asset_available aa on iad.available_asset_id = aa.id
                                                        join items i on aa.item_id = i.id
                                                       
                                                        WHERE iad.issue_asset_id = $id;") or die(mysqli_error($my_connection));
            while ($row = mysqli_fetch_assoc($select_qry)) {
            
                $item_name = $row['item_name'];
                $quantity_issue = $row['quantity_issue'];
           
                echo '<tr>
                        <td>' . $item_name . '</td>
                        <td>' . $quantity_issue . '</td>
                    </tr>';
            }
            echo '</table>';
            echo '</td>';
           
            echo '<td>'.$row2['name'] . '<br> Designation : '.$row2['designation'].'</td>';
            echo '<td class="">' . $row2['description'] . '</td>';
            echo '<td class=""><a href="' . $row2['file_path'] . '" download>Download</a></td>';
            echo '<td style="width:90px;">';
            echo 'main edit is here';
            echo '<a href="assets_delete.php?id='.$id.'&item_no='.$row2['item_no'].'&quantity='.$row2['quantity'].
            '&purchase_order_invoice_no='.$row2['purchase_order_invoice_no'].'&price='.$row2['price'].'"
             data-toggle="tooltip" data-placement="bottom" title="Delete" style="">';
            echo '<i class="ti-trash" style="font-size:25px; color:red; margin-top:10px; margin-left:0px;"></i>';
            echo '</a>';
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
                <script>
function filteritems() {
    var input, filter, select, options, option, i, item_name;
    input = document.getElementById('search');
    filter = input.value.toUpperCase();
    select = document.getElementById('item1');
    options = select.getElementsByTagName('option');

    for (i = 0; i < options.length; i++) {
        option = options[i];
        item_name = option.textContent || option.innerText;
        if (item_name.toUpperCase().indexOf(filter) > -1) {
            option.style.display = '';
        } else {
            option.style.display = 'none';
        }
    }
}
function get_item(id) {
    var category_ids = $("#category"+id).val();  // Retrieve an array of selected category IDs
    // Convert the array to a comma-separated string
    var category_id_string = category_ids ? category_ids.join(',') : '';

    $.ajax({
        url: "get_item_simple.php",
        type: "POST",
        data: {
            'category_id': category_id_string  // Send the comma-separated string of IDs
        },
        success: function(data) {
            $("#item"+id).html(data);
        }
    });
}
function filterCategoryDropdown() {
        var input, filter, select, options, i;
        input = document.getElementById('categorySearch');
        filter = input.value.toUpperCase();
        select = document.getElementById('category1');
        options = select.getElementsByTagName('option');

        for (i = 0; i < options.length; i++) {
            if (options[i].textContent.toUpperCase().indexOf(filter) > -1) {
                options[i].style.display = '';
            } else {
                options[i].style.display = 'none';
            }
        }
    }
</script>

    </body>
</html>