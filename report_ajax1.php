<?php require_once('my_connection.php');
// Date Wise Report
if (isset($_POST['from_date_a']) && isset($_POST['to_date_a']) && isset($_POST['category_a']) && isset($_POST['item_a'])) {
    $get_from_date = $_POST['from_date_a'];
    $get_to_date   = $_POST['to_date_a'];
    $category_a   = $_POST['category_a'];
    $item_a   = $_POST['item_a'];

   $from_date = date("y-m-d", strtotime($get_from_date));
   $to_date = date("y-m-d", strtotime($get_to_date));
  
?>

<div class="row">
                    <div class="col-sm-12">
                       
                            <!-- <h4 class="m-t-0 header-title"><b>Total Assets (ITEMS) List</b></h4> -->


                            <center>


                                <img src="assets/images/logo.png" width="9%" style="border-bottom:1px solid silver; float:left;" />
            <h4 style="font-weight:bold;">Office of the</h4>
          <h3 style="font-weight:bold;"> Senior Civil Judge, District Mohmand </h3>
          <small style="margin-left: 50px;">Email: scjmohmand@gmail.com-Tel: 0924-290145   </small>     
                      
                       
                          
          
               <h3 class="m-t-0 header-title" style="margin-left: 60px;"><strong>Date Wise Item List</strong></h3>
                            
                 <small style="margin-left: 60px;">  <span><b>From : </b><?php echo $head_from_date = date("y-M-d", strtotime($from_date)); ?></span> ||   <span><b>To : </b><?php echo $head_to_date = date("y-M-d", strtotime($to_date)); ?></span></small>
                                
                         <hr style="color: 3px solid grey;" >

                          
                            
                               
                      
                           
                            </center>
                            

                            <!-- <table id="datatable-buttons" class="table table-striped table-bordered"> -->
                            <!-- <table id="datatable" class="table table-striped table-bordered"> -->

                            <div class="table-responsive my-only-div-shadow py-4">
                            <!-- export_table -->
         <!-- for bootstrape datatable <table class="table table-bordered data_table table-striped"  id="customers" data-page-length="50"> -->
  
         <table id="customers" class="table table-striped table-bordered export" style='width:100%;font-family:Calibri;
  border-collapse: collapse;
  width: 100%;'>
                                <thead>
                                <tr>
                                    <th style="padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #4CAF50;
  color: white;border: 1px solid #ddd;">Serial #</th>
                                    
                                    
                                    <th style="padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #4CAF50;
  color: white;border: 1px solid #ddd;">Item Name</th>
                                    <th style="padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #4CAF50;
  color: white;border: 1px solid #ddd;">Issued to: Court/Office</th>
                                    <th style="padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #4CAF50;
  color: white;border: 1px solid #ddd;">Total Quantity</th>
                                    <th style="padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #4CAF50;
  color: white;border: 1px solid #ddd;">Duration 
(From Date -To Date)
</th>
                                
                                </tr>
                                </thead>


                                <tbody>
                 <?php 

                   $today = date("Y-m-d");

                     // select a.*,s.name,c.title as category_name,i.unit,i.item_name from assets a 
                     //                          join suppliers s on a.supplier_id = s.id
                     //                          join categories c on a.category_id = c.id
                     //                          join items i on a.item_id = i.id 
                     //                          where a.dated BETWEEN '$from_date' AND '$to_date'

                

//                    SELECT ia.*, i.item_name, d.title , a.quantity total_quantity
// FROM issue_assets ia
// JOIN assets a ON ia.assets_id = a.id
// JOIN departments d ON ia.department_id = d.id
// JOIN items i ON a.item_id = i.id
//   where ia.category_id = '$category_a' AND i.id = '$item_a' AND ia.issue_date BETWEEN '$from_date' AND '$to_date'


              
 $select_qry2 = mysqli_query($my_connection, "SELECT ia.*, d.title, iad.quantity_issue,aa.id AS available_asset_id, aa.item_id,i.item_name
FROM issue_assets ia
JOIN departments d ON ia.department_id = d.id
JOIN issue_asset_details iad ON ia.id = iad.issue_asset_id
JOIN asset_available aa ON iad.available_asset_id = aa.id
join items i on aa.item_id = i.id
  where  i.id = '$item_a' AND ia.demand_date BETWEEN '$from_date' AND '$to_date'
") or die(mysqli_error($my_connection));
                                $n = 1;
                                  while($row2 = mysqli_fetch_array($select_qry2)){
                                  $id = $row2['id'];

                           
                             echo ' <tr role="row" class="odd">';
                                    
                                    echo '<td style="border: 1px solid #ddd; text-align: center;"> '.$n++.'</td>';

                                    echo  '<td style="border: 1px solid #ddd; text-align: center;">';
                                    echo '<b>'.$row2['item_name'].'</b>';
                                    echo '</td>';

                                    echo  '<td style="border: 1px solid #ddd; text-align: center;">';
                                    echo '<b>'.$row2['title'].'</b>';
                                    echo '</td>';
                                        
                                    echo  '<td style="border: 1px solid #ddd; text-align: center;">';
                                    echo '<b>'.$row2['quantity_issue'].'</b>';
                                    echo '</td>';
                                           echo  '<td style="border: 1px solid #ddd; text-align: center;">';
        echo '<b>From : '.$head_from_date = date("y-M-d", strtotime($from_date)).' To : '.$head_to_date = date("y-M-d", strtotime($to_date)).'  </b>';
                                          echo '</td>';

                                     echo '</tr>';

                          
                            }
                   ?> 
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <?php }

                // all Assets (Items) Date/Category Wise Report
if (isset($_POST['c_from_date']) && isset($_POST['c_to_date']) && isset($_POST['category_id'])) {
    $get_from_date = $_POST['c_from_date'];
    $get_to_date   = $_POST['c_to_date'];
    $category_id   = $_POST['category_id'];

   $from_date = date("y-m-d", strtotime($get_from_date));
   $to_date = date("y-m-d", strtotime($get_to_date));

   $select_qry = mysqli_query($my_connection, "SELECT * FROM `categories` where id ='$category_id'") or die(mysqli_error($my_connection));
   $row = mysqli_fetch_assoc($select_qry);
   $title = @$row['title'];
?>

<div class="row">
                    <div class="col-sm-12">

                          <center>
                          

                            <img src="assets/images/logo.png" width="9%" style="border-bottom:1px solid silver; float:left;" />
            <h4 style="font-weight:bold;">Office of the</h4>
          <h3 style="font-weight:bold;"> Senior Civil Judge, District Mohmand </h3>
          <small style="margin-left: 50px;">Email: scjmohmand@gmail.com-Tel: 0924-290145   </small>     
                      
                       
                          
            <h3><small><strong>Item Wise List (<?php if($title != ' '){ echo @$title; } else { } ?>  )</strong></small></h3> 
                            
                 <small> <span style="margin-left: 60px;"><b>From : </b><?php echo $head_from_date = date("y-M-d", strtotime($from_date)); ?></span>
                  ||   
                  <span><b>To : </b><?php echo $head_to_date = date("y-M-d", strtotime($to_date)); ?></span></small>
                                
                         <hr style="color: 3px solid grey;" >
                            </center>
                           

                            <!-- <table id="datatable-buttons" class="table table-striped table-bordered"> -->
                            <!-- <table id="datatable" class="table table-striped table-bordered"> -->

                            <div class="table-responsive my-only-div-shadow py-4">
                            <!-- export_table -->
         <!-- for bootstrape datatable <table class="table table-bordered data_table table-striped"  id="customers" data-page-length="50"> -->
  
         <table id="customers" class="table table-striped table-bordered export" style='width:100%;font-family:Calibri;
  border-collapse: collapse;
  width: 100%;'>
                                <thead>
                                <tr>
                                    <th style="padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #4CAF50;
  color: white;border: 1px solid #ddd;">Serial #</th>
                                    
                                    
                                    <th style="padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #4CAF50;
  color: white;border: 1px solid #ddd;">Supply/Invoice No</th>
                                    <th style="padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #4CAF50;
  color: white;border: 1px solid #ddd;">Date</th>
                                    <th style="padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #4CAF50;
  color: white;border: 1px solid #ddd;">Item Name</th>
                                    <th style="padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #4CAF50;
  color: white;border: 1px solid #ddd;">Item ID</th>
                                    <!-- <th style="padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #4CAF50;
  color: white;border: 1px solid #ddd;">Total Issue</th> -->
                                    <th style="padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #4CAF50;
  color: white;border: 1px solid #ddd;">Quantity</th>
                                
                                    
                                     <th style="padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #4CAF50;
  color: white;border: 1px solid #ddd;">Price/Unit</th>
  <th style="padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #4CAF50;
  color: white;border: 1px solid #ddd;">Total Price</th>
   <th style="padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #4CAF50;
  color: white;border: 1px solid #ddd;">Remarks</th>
  <!--                                   <th style="padding-top: 12px;-->
  <!--padding-bottom: 12px;-->
  <!--text-align: center;-->
  <!--background-color: #4CAF50;-->
  <!--color: white;border: 1px solid #ddd;">File</th>-->
                                  <!-- <th>Actions</th> -->
                                </tr>
                                </thead>
                                <tbody>
                 <?php 

                   $today = date("Y-m-d");

                   

// select a.*,c.title as category_name,i.unit,i.item_name from assets a 
//                                               join categories c on a.category_id = c.id
//                                               join items i on a.item_id = i.id 
//                                               where a.category_id = '$category_id' and a.dated BETWEEN '$from_date' AND '$to_date'


//                     SELECT ia.*, i.item_name, d.title , a.quantity total_quantity
// FROM issue_assets ia
// JOIN assets a ON ia.assets_id = a.id
// JOIN departments d ON ia.department_id = d.id
// JOIN items i ON a.item_id = i.id
//   where ia.category_id = '$category_id' and ia.issue_date BETWEEN '$from_date' AND '$to_date'
              
 $select_qry2 = mysqli_query($my_connection, "SELECT a.purchase_order_invoice_no AS 'Supply Order / Invoice No',
 a.dated AS 'Date',
 i.item_name AS 'Item Name',
 ai.item_id AS 'Item ID',
 ai.quantity AS 'Quantity',
 ai.price AS 'Price/Unit',
 ai.quantity * ai.price AS 'Total Price',
 a.description AS 'Remarks'
FROM assets a
JOIN asset_items ai ON a.id = ai.asset_id
JOIN items i ON ai.item_id = i.id
WHERE a.purchase_order_invoice_no = '112233';") or die(mysqli_error($my_connection));
                                $n = 1;
                                  while($row2 = mysqli_fetch_array($select_qry2)){
                                 // $id = $row2['id'];

                           
                             echo ' <tr role="row" class="odd">';
                                    
                                    echo '<td style="border: 1px solid #ddd;"> '.$n++.'</td>';

                                    echo  '<td style="border: 1px solid #ddd;">';
                                          echo '<b>'.$row2['Supply Order / Invoice No'].'</b>';
                                          echo '</td>';


                                    echo  '<td style="border: 1px solid #ddd;">';
                                    echo '<b>'.$row2['Date'].'</b>';
                                    echo '</td>';
                                        
                                    echo  '<td style="border: 1px solid #ddd;">';
                                    echo '<b>'.$row2['Item Name'].'</b>';
                                    echo '</td>';
                                           echo  '<td style="border: 1px solid #ddd;">';
                                          echo '<b>'.$row2['Item ID'].'</b>';
                                          echo '</td>';

                                          // echo  '<td style="border: 1px solid #ddd;">';
                                          // echo $row2['quantity_issue'];
                                          // echo '</td>';

                                           echo  '<td style="border: 1px solid #ddd;">';
                                          echo $row2['Quantity'] ;
                                          echo '</td>';

                                          echo  '<td style="border: 1px solid #ddd;">';
                                          echo $row2['Price/Unit'];
                                          echo '</td>';

                                          echo  '<td style="border: 1px solid #ddd;">';
                                          echo $row2['Total Price'];
                                          echo '</td>';

                                          echo  '<td style="border: 1px solid #ddd;">';
                                          echo $row2['Remarks'];
                                          echo '</td>';


        //                                   echo  '<td style="border: 1px solid #ddd;">';
                                         
        //     echo ' <div class="media-left">
        //     <a href="#"> <img class="media-object img-circle" alt="Image Not yet Added" src="'.$row2['file_path'].'" style="width: 74px; height: 74px;"> </a>
        // </div>';
  
        //                                     echo '</td>'; 

                                     echo '</tr>';

                          
                            }
                   ?> 
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                <?php }

// all Assets (Items) Date/Category Wise Report
if (isset($_POST['department_id'])) {
// $get_from_date = $_POST['d_from_date'];
// $get_to_date   = $_POST['d_to_date'];
$department_id   = $_POST['department_id'];

// $from_date = date("y-m-d", strtotime($get_from_date));
// $to_date = date("y-m-d", strtotime($get_to_date));


$select_qry = mysqli_query($my_connection, "SELECT * FROM `departments` where id ='$department_id'") or die(mysqli_error($my_connection));
$row = mysqli_fetch_assoc($select_qry);
$title = @$row['title'];
?>

<div class="row">
    <div class="col-sm-12">
       
            <center>
                          

                            <img src="assets/images/logo.png" width="9%" style="border-bottom:1px solid silver; float:left;" />
            <h4 style="font-weight:bold;">Office of the</h4>
          <h3 style="font-weight:bold;"> Senior Civil Judge, District Mohmand </h3>
          <small style="margin-left: 50px;">Email: scjmohmand@gmail.com-Tel: 0924-290145   </small>     
                      
                       
                          
            <h3><small><strong>Court/Office wise Report Court/Office/Others (<?php if($title != ' '){ echo @$title; } else { } ?>  )</strong></small></h3> 
                            
                
                                
                         <hr style="color: 3px solid grey;" >
                            </center>

            <div class="row">
                <!-- <span><b>From : </b><?php echo $head_from_date = date("y-M-d", strtotime($from_date)); ?></span> ||   <span><b>To : </b><?php echo $head_to_date = date("y-M-d", strtotime($to_date)); ?></span> -->
                
            </div>
            <br>
            </center>
            

            <!-- <table id="datatable-buttons" class="table table-striped table-bordered"> -->
            <!-- <table id="datatable" class="table table-striped table-bordered"> -->

            <div class="table-responsive my-only-div-shadow py-4">
            <!-- export_table -->
<!-- for bootstrape datatable <table class="table table-bordered data_table table-striped"  id="customers" data-page-length="50"> -->

<table id="customers" class="table table-striped table-bordered export" style='width:100%;font-family:Calibri;
border-collapse: collapse;
width: 100%;'>
                <thead>
                <tr>
                    <th style="padding-top: 12px;
padding-bottom: 12px;
text-align: center;
background-color: #4CAF50;
color: white;border: 1px solid #ddd;">Serial #</th>
                    
                    
                    <th style="padding-top: 12px;
padding-bottom: 12px;
text-align: center;
background-color: #4CAF50;
color: white;border: 1px solid #ddd;">Court/Office</th>
                    <th style="padding-top: 12px;
padding-bottom: 12px;
text-align: center;
background-color: #4CAF50;
color: white;border: 1px solid #ddd;">Item Name </th>
                  
                    <th style="padding-top: 12px;
padding-bottom: 12px;
text-align: center;
background-color: #4CAF50;
color: white;border: 1px solid #ddd;">Quantity</th>
                    <th style="padding-top: 12px;
padding-bottom: 12px;
text-align: center;
background-color: #4CAF50;
color: white;border: 1px solid #ddd;">Date</th>

  <th style="padding-top: 12px;
padding-bottom: 12px;
text-align: center;
background-color: #4CAF50;
color: white;border: 1px solid #ddd;">Receiver Name & Designation</th>
                    
<!--                    <th style="padding-top: 12px;-->
<!--padding-bottom: 12px;-->
<!--text-align: center;-->
<!--background-color: #4CAF50;-->
<!--color: white;border: 1px solid #ddd;">File</th>-->
                </tr>
                </thead>


                <tbody>
 <?php 

   $today = date("Y-m-d");
//    SELECT ia.*, i.item_name, d.title, e.name
// FROM issue_assets ia
// JOIN assets a ON ia.assets_id = a.id
// JOIN departments d ON ia.department_id = d.id
// JOIN employees e ON ia.employee_id = e.id
// JOIN items i ON a.item_id = i.id
//                               where ia.department_id = '$department_id' and ia.issue_date BETWEEN '$from_date' AND '$to_date'


   

//   SELECT ia.*, i.item_name, d.title, e.name,e.designation
// FROM issue_assets ia
// JOIN assets a ON ia.assets_id = a.id
// JOIN departments d ON ia.department_id = d.id
// JOIN employees e ON ia.employee_id = e.id
// JOIN items i ON a.item_id = i.id
//                               where ia.department_id = '$department_id'




$select_qry2 = mysqli_query($my_connection, "SELECT ia.*, d.title, iad.quantity_issue,aa.id AS available_asset_id, aa.item_id,i.item_name,e.name,e.designation
FROM issue_assets ia
JOIN departments d ON ia.department_id = d.id
JOIN issue_asset_details iad ON ia.id = iad.issue_asset_id
JOIN asset_available aa ON iad.available_asset_id = aa.id
join items i on aa.item_id = i.id
join employees e on ia.employee_id = e.id
  where  ia.department_id = '$department_id'") or die(mysqli_error($my_connection));
                $n = 1;
                  while($row2 = mysqli_fetch_array($select_qry2)){
                  $id = $row2['id'];

           
             echo ' <tr role="row" class="odd">';
                    
                    echo '<td style="border: 1px solid #ddd;"> '.$n++.'</td>';

                       echo  '<td style="border: 1px solid #ddd;">';
                    echo '<b>'.$row2['title'].'</b>';
                    echo '</td>';

                    echo  '<td style="border: 1px solid #ddd;">';
                         echo '<b>'.$row2['item_name']. '</b>';
                        // echo '<b>'.$row2['item_name']. '<br><span style="color: #81c868;">ID : </span>'.$row2['item_id'].' </b>';
                    echo '</td>';

                  
                        
                 
                           echo  '<td style="border: 1px solid #ddd;">';
                          echo '<b>'.$row2['quantity_issue'].'</b>';
                          echo '</td>';

                          echo  '<td style="border: 1px solid #ddd;">';
                          $row2['demand_date'];
                          echo $date = date("j F, Y", strtotime($row2['demand_date']));
                          echo '</td>';

                            echo  '<td style="border: 1px solid #ddd;">';
                    echo '<b>'.$row2['name']. '<br><span style="color: #81c868;">Designation : </span> '.$row2['designation'].'</b>';
                    echo '</td>';

                          


//                           echo  '<td style="border: 1px solid #ddd;">';
                         
// echo ' <div class="media-left">
// <a href="#"> <img class="media-object img-circle" alt="Image Not yet Added" src="'.$row2['file_path'].'" style="width: 74px; height: 74px;"> </a>
// </div>';

//                             echo '</td>'; 

                     echo '</tr>';

          
            }
   ?> 
                
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php }

?>