<?php
require_once('session_data.php');

    $warning = '';
    $success = '';
   // $message='';

?>


<?php
    require_once('my_connection.php');
    $warning = '';
    $success = '';
   // $message='';
    if (isset($_POST['btnsave'])) 
    {
      $purchase_order_invoice_no = $_POST['purchase_order_invoice_no'];
      $supplier_id = $_POST['supplier_id'];
      $dated = $_POST['dated'];
      $grand_total_amount = $_POST['grand_total_amount']; 
      $description = $_POST['description']; 


      $check_qry = mysqli_query($my_connection, "select purchase_order_invoice_no from assets where purchase_order_invoice_no = '$purchase_order_invoice_no'") or die (mysqli_error($my_connection));

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

      ///////////Insertion in assets table
 $query_a = "INSERT INTO `assets`(`purchase_order_invoice_no`, `supplier_id`, `grand_total_amount`, `description`, `file_path`, `dated`)
                          VALUES ('$purchase_order_invoice_no','$supplier_id','$grand_total_amount','$description','$path','$dated')";
     $run1 = mysqli_query($my_connection, $query_a);
     $last_asset_id = mysqli_insert_id($my_connection);

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
     ///////////Insertion in assets table without image
 $query_b = "INSERT INTO `assets`(`purchase_order_invoice_no`, `supplier_id`, `grand_total_amount`, `description`, `file_path`, `dated`)
                          VALUES ('$purchase_order_invoice_no','$supplier_id','$grand_total_amount','$description','IMAGE NOT YET ADDED','$dated')";
     $run1 = mysqli_query($my_connection, $query_b);
     $last_asset_id = mysqli_insert_id($my_connection);

      $success = '<div class="alert alert-success alert-block alert-dismissible fade in iconic-alert" role="alert">
                                    <div class="alert-icon">
                                        <span class="gcon gcon-emoji-happy centered-xy"></span>
                                    </div>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><span class="mcon mcon-close"></span></span></button>
                                    <strong>Success!</strong> Record Inserted With Out Image.
                            </div>';

  } /// without image insertion close


 $count = COUNT($_POST['category_id']);
      for ($i = 0; $i < $count; $i++) {
        $category_id = $_POST['category_id'][$i];
        $item_id = $_POST['item_id'][$i];
         $item_no = $_POST['item_no'][$i];
          $price = $_POST['price'][$i];
        $quantity = $_POST['quantity'][$i];
         $total_amount = $_POST['total_amount'][$i];
        
       

 /////////////Insertion Of asset_items table
        $query_c = "INSERT INTO `asset_items`(`asset_id`,`category_id`, `item_id`, `item_no`, `price`, `quantity`, `total_amount`, `dated`)
                                      VALUES ('$last_asset_id','$category_id','$item_id','$item_no','$price','$quantity','$total_amount','$dated')";
                             $last_item_no = $item_no;
          
        $run = mysqli_query($my_connection, $query_c);

         $last_asset_items_id = mysqli_insert_id($my_connection);

       $new_code = $last_item_no+1;
  $update = "UPDATE item_id SET item_id = '$new_code'";
   mysqli_query($my_connection, $update);

       
       
/////////////Insertion Of asset_available

 $select_qry = mysqli_query($my_connection, "SELECT * FROM `asset_available` WHERE item_id = '$item_id'") or die(mysqli_error($my_connection));
  $num_rows = mysqli_num_rows($select_qry); 

      if($num_rows != 0 ){

       // echo "yes matched";
       //  echo '<br>';
        $select_qry = mysqli_query($my_connection, "SELECT * FROM `asset_available` where item_id = $item_id") or die(mysqli_error($my_connection));
    $row = mysqli_fetch_assoc($select_qry);
      $get_quantity = $row['quantity']; 
  

     $new_quantity = $get_quantity + $quantity;
     $update_asset_available = "UPDATE `asset_available` SET `quantity`=$new_quantity WHERE `item_id` = $item_id"; 
    mysqli_query($my_connection, $update_asset_available) or die(mysqli_error($my_connection));


      }   /// if asset_available exist close
      else{

         $insert_new_asset_available = "INSERT INTO `asset_available`(`asset_item_id`, `category_id`, `item_id` , `quantity`) VALUES ('$last_asset_items_id','$category_id','$item_id','$quantity')"; 
    mysqli_query($my_connection, $insert_new_asset_available) or die(mysqli_error($my_connection));
         echo "not matched";
         echo '<br>';
      }  /// new insertion asset_available close



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
<title>Find Child</title>
    

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
      let reorderid = 1;
     
      function orderRow() {
         var item_no1 = $("#item_no1").val();
    //  alert(item_no1);
        reorderid++;
        $.ajax({
          url: 'assets_append_row.php',
          method: 'POST',
          data: {
            'count': reorderid,
            'item_no': item_no1
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
    </script>

           <script type="text/javascript">
// get item_name from items table by category_id
// $(document).ready(function()
// {
// $(".category").change(function()
// {
   
// var id=$(this).val();
// //alert(id);
// var dataString = 'id='+ id;
// $.ajax
// ({
// type:"POST",
// url: "get_item.php",
// data: dataString,
// cache: false,
// success: function(html)
// {
// $(".item").html(html);
// } 
// });
// });
// });


 function get_item(id) {
      var category_id = $("#category"+id).val();
    // alert(category_id);
  $.ajax({
    url: "get_item.php",
    type: "POST",
    data: {
      'category_id': category_id
    },
    success: function(data) {
      $("#item"+id).html(data);
    }
  });
}


function Purchase_Price(id) {
        var price = $('#price' + id).val();
        var quantity = $('#quantity' + id).val();
        $('#total_amount' + id).val((quantity * price).toFixed(2));
        calculate_grand_total();
        // finaly_Discounts();
      }
       function calculate_grand_total()
  {
    var grand_total_amount = 0;
    $("input[name^='row']").each(function () {
    var total_amount_input = "#total_amount" + $(this).val();
    grand_total_amount += Number($(total_amount_input).val());
    });
   // $('#paid').val((grand_total_amount).toFixed(2));
    $('#grand_total_amount').val((grand_total_amount).toFixed(2));
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



</script>


        </head>
        
       
        <!-- End Navigation Bar-->


        <div class="wrapper" >
            <div class="container">
            
            
                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="btn-group pull-right m-t-15">
                          
                        </div>

                        <h4 class="page-title">Add Stock</h4>
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

             <?php
                $query = "SELECT * FROM item_id";
                $result = mysqli_query($my_connection, $query);
                $rowData = mysqli_fetch_array($result);
                $last_item_id = $rowData['item_id'];
              ?>
                                <div class="col-md-12">
   <form class="" role="form" method="post" enctype="multipart/form-data">
                                        
                                        
                                        <div class="row">
                                           

                                            <div class="form-group col-md-2">
                                            <label class=" control-label"> Purchase Order/Invoice No</label>
                                            <div class="">
                                                <input type="text" class="form-control" placeholder="" name = "purchase_order_invoice_no" required />
                                            </div>
                                        </div>

                                          <div class="form-group col-md-2">
                                            <label class=" control-label">Date</label>
                                            <div class="">
                                                <input type="date" class="form-control" placeholder="" name = "dated" required />
                                            </div>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label class=" control-label">Select Vendor </label>
                                            <span><a href="supplier_add.php"><small style="float:right; color:#2e79be;" class="text-muted" >Add Vendor</small></a></span>
                                            <div class="">
                                            <select name="supplier_id" class="form-control"  tabindex="" required>
                                               <option value="">Select Vendor</option>
                                           <?php $select_qry = mysqli_query($my_connection,"select * from suppliers") or die (mysqli_error($my_connection)); 
                                           while($row=mysqli_fetch_array($select_qry)){
                                            $id =  $row['id'];
                                            $name = $row['name'];
                                            echo "<option value = '$id'>$name</option>";
                                           }
                                           
                                            ?>
                                           </select>
                                            </div>
                                        </div>
                                        </div>
                                        <hr>


                                 <div class="" style="" id="edu_new_row">
                                <div class="" id="edu_data_row1">
                        <input type="hidden" name="row[]" value="1">

                                        <div class="form-group col-md-2">
                                            <label class=" control-label">Select Category </label>
                                            <span><a href="category_add.php"><small style="float:right; color:#2e79be;" class="text-muted" >Add Category</small></a></span>
                                            <div class="">
                    <select name="category_id[]" class="form-control category" id="category1"  tabindex="" onchange="get_item(1)" required>
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

                                        <div class="form-group col-md-2">
                                            <label class=" control-label">Item Name</label>
                                            <span><a href="item_add.php"><small style="float:right; color:#2e79be;" class="text-muted" >Add Item</small></a></span>
                                            <div class="">
                                            <select name="item_id[]" class="form-control item" id="item1" tabindex="" required>
                                               <option value="">Select Item</option>
                                           </select>
                                            </div>
                                        </div>

                                      <div class="form-group col-md-1">
                                            <label class=" control-label">Item ID</label>
                                            <div class="">
               <input type="number" class="form-control" placeholder="" name = "item_no[]" id="item_no1"  value="<?php echo $last_item_id ?>" readonly />
                                            </div>
                                        </div>

                                        <div class="form-group col-md-1">
                                            <label class=" control-label">Price/Unit</label>
                                            <div class="">
                                                <input type="text" class="form-control" id="price1" placeholder="" onkeyup="Purchase_Price(1)" name = "price[]"  required/>
                                            </div>
                                        </div>

                                          <div class="form-group col-md-1">
                                            <label class=" control-label">Quantity</label>
                                            <div class="">
                                                <input type="text" class="form-control" id="quantity1"  onkeyup="Purchase_Price(1)" name = "quantity[]" required />
                                            </div>
                                        </div>

                                          <div class="form-group col-md-2">
                                            <label class=" control-label">Total Amount</label>
                                            <div class="">
                                                <input type="text" class="form-control" id="total_amount1" placeholder="" name = "total_amount[]" required readonly />
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




  <div style="clear:both;"></div>
                                           <hr>
                                           <hr>


                                      
   

                                         <div class="row">

                                        <div class="form-group col-md-2">
                                            <label class=" control-label">Grand Total Amount</label>
                                            <div class="">
                                                <input type="text" class="form-control" placeholder="" id="grand_total_amount" name = "grand_total_amount" required readonly />
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label class=" control-label">Remarks</label>
                                            <div class="">
                                                <textarea  type="text" class="form-control" placeholder="" name = "description" required rows="" cols=""></textarea>
                                            </div>
                                        </div>

                                      

                                        <div class="form-group col-md-2">
                                          <label class=" control-label"></label>
                                                <div class="">                                                                                            
                                                    <!-- <input type="file" name = "upload_file" value = "" /> -->
<input id="file" type="file" name="upload_file" onchange="showImage1(event)" t accept="image/*" class="form-control" style="overflow: hidden;" placeholder="Insert Your Image">
<img id="img" class="shadow" style="float:right; border: 1px blue solid; border-radius: 10%; margin-top: 4%" width="130px;" src="assets/images/file.PNG" height="130px" alt="Image">
                                                </div>

                                            </div>

                                                </div>
                                        
                                        
<label class=" control-label col-m-12"></label>
<div class="form-group" style="float: right;">
<button type="submit" class="btn btn-success waves-effect waves-light m-l-8 btn-md" name ="btnsave" >ADD</button>
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
                            <h4 class="m-t-0 header-title"><b>Stock List</b></h4>
                            

                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Serial #</th>
                                    <th>Purchase Order/Invoice No.</th>
                                    <th>Delivery Date</th>
                                    
                                    
                                    <th>Vendor</th>
                                    <th>Item Name & ID</th>
                                   
                                    <!-- <th>Item Name</th>
                                     <th>Item ID</th> -->
                                    <!-- <th>Item No</th> -->
                                    <!-- <th>Unit</th> -->
                                    <th>Price Per Unit</th>
                                    <th>Quantity</th>
                                    <!-- <th>Total Amount</th> -->
                                     <th>Remarks</th>
                                     <th>File</th>
                                  <th>Actions</th>
                                </tr>
                                </thead>


                                <tbody>
                 <?php 

                   $today = date("Y-m-d");

                   // select a.*,s.name,c.title as category_name,i.unit,i.item_name from assets a 
                   //                            join suppliers s on a.supplier_id = s.id
                   //                            join categories c on a.category_id = c.id
                   //                            join items i on a.item_id = i.id
              
 $select_qry2 = mysqli_query($my_connection, "select ai.*,a.purchase_order_invoice_no,a.description,a.file_path,s.name,item_name from asset_items ai
                                              join assets a on ai.asset_id = a.id
                                              join suppliers s on a.supplier_id = s.id
                                              join items i on ai.item_id = i.id") or die(mysqli_error($my_connection));
                                $n = 1;
                                  while($row2 = mysqli_fetch_array($select_qry2)){
                                  $id = $row2['id'];

                           
                             echo ' <tr role="row" class="odd">';
                                    
                                    echo '<td> '.$n++.'</td>';
                                     echo  '<td class="">';
                                    echo '<b>'.$row2['purchase_order_invoice_no'].'</b>';
                                    echo '</td>';

                                    
                                               echo  '<td class="">';
                                 $row2['dated'];
                                           echo $date = date("j F, Y", strtotime($row2['dated']));

                                    echo '</td>';


                                       

                                    echo  '<td class="">';
                                    echo '<b>'.$row2['name'].'</b>';
                                    echo '</td>';

                                      echo  '<td class="">';
                                          echo '<b>'.$row2['item_name']. '<br>ID : '.$row2['item_no'].' </b>';
                                          echo '</td>';

                                           echo  '<td class="">';
                                           echo $row2['price'];
                                          echo '</td>';

                                           echo  '<td class="">';
                                          echo $row2['quantity'];
                                          echo '</td>';
                                          
                             
                                          echo  '<td class="">';
                                          echo $row2['description'];
                                          echo '</td>';


                                          echo  '<td class="">';
                                         
        //     echo ' <div class="media-left">
        //     <a href="#"> <img class="media-object img-circle" alt="Image Not yet Added" src="'.$row2['file_path'].'" style="width: 74px; height: 74px;"> </a>
        // </div>';
        echo '<a href="' .$row2['file_path']. '" download>Download</a>';
  
                                            echo '</td>'; 

                                          
                                       echo '<td style="width:90px;">';
                                
                                      //  <a  href ="assets_edit.php?id='.$id.'" data-toggle="tooltip" data-placement="bottom" title="Edit" style=""> 
                                      //  <i class="ti-pencil" style="font-size:25px; color:success; margin-top:10px; margin-left:0px;"></i>
                                      //   </a> 
                                      //   |
                                   echo ' <a href="#">
                                 <a  href ="assets_delete.php?id='.$id.'&item_no='.$row2['item_no'].'&quantity='.$row2['quantity'].'&purchase_order_invoice_no='.$row2['purchase_order_invoice_no'].'&price='.$row2['price'].'" data-toggle="tooltip" data-placement="bottom" title="Delete" style=""> 
                                <i class="ti-trash" style="font-size:25px; color:red; margin-top:10px; margin-left:0px;"></i>
                                 </a>
                
                                 ';
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
    </body>
</html>
