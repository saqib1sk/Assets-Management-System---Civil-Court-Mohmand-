<?php require_once('my_connection.php');
// Date Wise Report
if (isset($_POST['from_date_a']) && isset($_POST['to_date_a']) && isset($_POST['category_a']) && isset($_POST['departments_a']) && isset($_POST['item_a'])) {
    $get_from_date = $_POST['from_date_a'];
    $get_to_date   = $_POST['to_date_a'];



    $category_ids   = $_POST['category_a'];
    $category_a = implode(',', array_map('intval', $category_ids));


    $departments_ids   = $_POST['departments_a'];
    $departments_a = implode(',', array_map('intval', $departments_ids));


    $item_ids   = $_POST['item_a'];
    $item_a = implode(',', array_map('intval', $item_ids));

   $from_date = date("y-m-d", strtotime($get_from_date));
   $to_date = date("y-m-d", strtotime($get_to_date));

  
?>

<div class="row">
                    <div class="col-sm-12">
                       
                            <!-- <h4 class="m-t-0 header-title"><b>Total Assets (ITEMS) List</b></h4> -->


                            <center>
            <img src="assets/images/logo.png" style="float:left;" />
            <h4 style="font-weight:bold;">Office of the</h4>
            <h3 style="font-weight:bold; margin-top:-14px;"> Senior Civil Judge, District Mohmand </h3>
            <h3 style="margin-top:-14px;"><span style="font-size:14px;">Email: scjmohmand@gmail.com - Tel: 0924-290145</span></h3>   
            <h2 class="" style="margin-top:-10px;"><strong>Date Wise Item List</strong></h2>
            <h3 style="margin-top:-14px;"><span style="font-size:14px;">From: <?php echo $head_from_date = date("y-M-d", strtotime($from_date)); ?> || To:  <?php echo $head_to_date = date("y-M-d", strtotime($to_date)); ?></span></h3>  
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
  color: white;border: 1px solid #ddd;">Category</th>
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


if($category_a=='0' && $departments_a =='0' && $item_a=='0'){
$select_qry2 = mysqli_query($my_connection, "SELECT ia.*, d.title AS department_title, iad.quantity_issue, aa.id AS available_asset_id, aa.item_id, i.item_name, c.title AS category_title
FROM issue_assets ia
JOIN departments d ON ia.department_id = d.id
JOIN issue_asset_details iad ON ia.id = iad.issue_asset_id
JOIN asset_available aa ON iad.available_asset_id = aa.id
JOIN items i ON aa.item_id = i.id
JOIN categories c ON i.category_id = c.id  -- Assuming categories are related to items via category_id
WHERE ia.demand_date BETWEEN '$from_date' AND '$to_date';") or die(mysqli_error($my_connection));

}elseif($departments_a =='0' && $item_a=='0'){

  $select_qry2 = mysqli_query($my_connection, "SELECT 
  ia.*, 
  d.title AS department_title, 
  iad.quantity_issue, 
  aa.id AS available_asset_id, 
  aa.item_id, 
  i.item_name AS item_name,
  c.title AS category_title
FROM 
  issue_assets ia
JOIN 
  departments d ON ia.department_id = d.id
JOIN 
  issue_asset_details iad ON ia.id = iad.issue_asset_id
JOIN 
  asset_available aa ON iad.available_asset_id = aa.id
JOIN 
  items i ON aa.item_id = i.id
JOIN
  categories c ON i.category_id = c.id
WHERE 
  ia.demand_date BETWEEN '$from_date' AND '$to_date'
  AND c.id IN ($category_a);") or die(mysqli_error($my_connection));

}

elseif($departments_a =='0'){
  $select_qry2 = mysqli_query($my_connection, "SELECT 
  ia.*, 
  d.title AS department_title, 
  iad.quantity_issue, 
  aa.id AS available_asset_id, 
  aa.item_id, 
  i.item_name AS item_name,
  c.title AS category_title
FROM 
  issue_assets ia
JOIN 
  departments d ON ia.department_id = d.id
JOIN 
  issue_asset_details iad ON ia.id = iad.issue_asset_id
JOIN 
  asset_available aa ON iad.available_asset_id = aa.id
JOIN 
  items i ON aa.item_id = i.id
JOIN
  categories c ON i.category_id = c.id
WHERE 
  ia.demand_date BETWEEN '$from_date' AND '$to_date'
  AND c.id IN ($category_a)
  AND i.id IN ($item_a);") or die(mysqli_error($my_connection));
} //*************** */

elseif($item_a=='0'){
  $select_qry2 = mysqli_query($my_connection, "SELECT 
  ia.*, 
  d.title AS department_title, 
  iad.quantity_issue, 
  aa.id AS available_asset_id, 
  aa.item_id, 
  i.item_name,
  c.title AS category_title
FROM 
  issue_assets ia
JOIN 
  departments d ON ia.department_id = d.id
JOIN 
  issue_asset_details iad ON ia.id = iad.issue_asset_id
JOIN 
  asset_available aa ON iad.available_asset_id = aa.id
JOIN 
  items i ON aa.item_id = i.id
JOIN
  categories c ON i.category_id = c.id
WHERE 
  ia.demand_date BETWEEN '$from_date' AND '$to_date'
  AND ia.department_id IN ($departments_a)
  AND c.id IN ($category_a);") or die(mysqli_error($my_connection));
}
elseif($category_a=='0' && $departments_a=='0'){

  $itemsArray = explode(',', $item_a);
  $itemsArray = array_map('intval', $itemsArray);
  $itemsInClause = implode(',', $itemsArray );

  $select_qry2 = mysqli_query($my_connection, "SELECT
  ia.*, 
  d.title AS department_title, 
  iad.quantity_issue, 
  aa.id AS available_asset_id, 
  aa.item_id, 
  i.item_name,
  c.title AS category_title
FROM
  issue_assets ia
JOIN 
  departments d ON ia.department_id = d.id
JOIN 
  issue_asset_details iad ON ia.id = iad.issue_asset_id
JOIN 
  asset_available aa ON iad.available_asset_id = aa.id
JOIN
  items i ON aa.item_id = i.id
JOIN
  categories c ON i.category_id = c.id
WHERE
  i.id IN ($itemsInClause)
  AND ia.demand_date BETWEEN '$from_date' AND '$to_date';") or die(mysqli_error($my_connection));
}
elseif($category_a=='0'){
  $departmentsArray = explode(',', $departments_a);
  $departmentsArray = array_map('intval', $departmentsArray);
  $departmentsInClause = implode(',', $departmentsArray);

  
  $itemsArray = explode(',', $item_a);
  $itemsArray = array_map('intval', $itemsArray);
  $itemsInClause = implode(',', $itemsArray );

  $select_qry2 = mysqli_query($my_connection, "SELECT
  ia.*, 
  d.title AS department_title, 
  iad.quantity_issue, 
  aa.id AS available_asset_id, 
  aa.item_id, 
  i.item_name,
  c.title AS category_title
FROM
  issue_assets ia
JOIN 
  departments d ON ia.department_id = d.id
JOIN 
  issue_asset_details iad ON ia.id = iad.issue_asset_id
JOIN 
  asset_available aa ON iad.available_asset_id = aa.id
JOIN
  items i ON aa.item_id = i.id
JOIN
  categories c ON i.category_id = c.id
WHERE
  i.id IN ($itemsInClause)
  AND ia.demand_date BETWEEN '$from_date' AND '$to_date'
  AND ia.department_id IN ($departmentsInClause);") or die(mysqli_error($my_connection));
}
else{
  $departmentsArray = explode(',', $departments_a);
$departmentsArray = array_map('intval', $departmentsArray);
$departmentsInClause = implode(',', $departmentsArray);

$itemsArray = explode(',', $item_a);
  $itemsArray = array_map('intval', $itemsArray);
  $itemsInClause = implode(',', $itemsArray );

 $select_qry2 = mysqli_query($my_connection, "SELECT
 ia.*, 
 d.title AS department_title, 
 iad.quantity_issue, 
 aa.id AS available_asset_id, 
 aa.item_id, 
 i.item_name,
 c.title AS category_title
FROM
 issue_assets ia
JOIN 
 departments d ON ia.department_id = d.id
JOIN 
 issue_asset_details iad ON ia.id = iad.issue_asset_id
JOIN 
 asset_available aa ON iad.available_asset_id = aa.id
JOIN 
 items i ON aa.item_id = i.id
 JOIN
  categories c ON i.category_id = c.id
WHERE
i.id IN ($itemsInClause)
 AND ia.demand_date BETWEEN '$from_date' AND '$to_date'
 AND ia.department_id IN ($departmentsInClause);") or die(mysqli_error($my_connection));
}
                                $n = 1;
                                  while($row2 = mysqli_fetch_array($select_qry2)){
                                  $id = $row2['id'];

                             echo ' <tr role="row" class="odd">';
                                    
                                    echo '<td style="border: 1px solid #ddd; text-align: center;"> '.$n++.'</td>';

                                    echo  '<td style="border: 1px solid #ddd; text-align: center;">';
                                    echo '<b>'.$row2['item_name'].'</b>';
                                    echo '</td>';

                                    echo  '<td style="border: 1px solid #ddd; text-align: center;">';
                                    echo '<b>'.$row2['category_title'].'</b>';
                                    echo '</td>';

                                    echo  '<td style="border: 1px solid #ddd; text-align: center;">';
                                    echo '<b>'.$row2['department_title'].'</b>';  // this is the departments table title
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

 //******************************************** Item Wise Report ******************************************************************* */                       

                // all Assets (Items) Date/Category Wise Report
if (isset($_POST['c_from_date']) && isset($_POST['c_to_date']) && isset($_POST['category_id']) && isset($_POST['items'])) {
    $get_from_date = $_POST['c_from_date'];
    $get_to_date   = $_POST['c_to_date'];


    $category_ids   = $_POST['category_id'];
    $cat_ids_str = implode(',', array_map('intval', $category_ids));


    //$item_cat = $_POST['items'];
    $item_ids = $_POST['items'];
    $item_ids_str = implode(',', array_map('intval', $item_ids));

   $from_date = date("y-m-d", strtotime($get_from_date));
   $to_date = date("y-m-d", strtotime($get_to_date));

   if($cat_ids_str=='0'){
    $title = 'All - Categories';

   }else{
    $select_qry = mysqli_query($my_connection, "SELECT * FROM `categories` where id ='$cat_ids_str'") or die(mysqli_error($my_connection));
    $row = mysqli_fetch_assoc($select_qry);
    $title = @$row['title'];
   }
   
?>

<div class="row">
                    <div class="col-sm-12">

                          <center>
                          

                            <img src="assets/images/logo.png" style="float:left;" />
            <h4 style="font-weight:bold;">Office of the</h4>
          <h3 style="font-weight:bold; margin-top:-14px;"> Senior Civil Judge, District Mohmand</h3>
          <h3 style="margin-top:-14px;"><span style="font-size:14px;">Email: scjmohmand@gmail.com - Tel: 0924-290145</span></h3>          
            <h3 style="margin-top:-10px;"><small><strong>Item Wise Report List (<?php if($title != ' '){ echo @$title;} else { } ?>  )</strong></small></h3> 
            <h3 style="margin-top:-14px;"><span style="font-size:14px;">From: <?php echo $head_from_date = date("y-M-d", strtotime($from_date)); ?> || To:  <?php echo $head_to_date = date("y-M-d", strtotime($to_date)); ?></span></h3>
                                
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

<!--<th style="padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #4CAF50;
  color: white;border: 1px solid #ddd;">Total Stock-In</th> -->
                                    <th style="padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #4CAF50;
  color: white;border: 1px solid #ddd;">Issued Quantity</th>
                                    <th style="padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #4CAF50;
  color: white;border: 1px solid #ddd;">Office/Court</th>
                                    <!-- <th style="padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #4CAF50;
  color: white;border: 1px solid #ddd;">Total Issue</th> -->
                                 <!--   <th style="padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #4CAF50;
  color: white;border: 1px solid #ddd;">Balance/Stock</th> -->
                                
                                    
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

if($item_ids_str == '0' && $cat_ids_str=='0')
{
$select_qry2 = mysqli_query($my_connection, "SELECT ia.*, d.title, iad.quantity_issue,aa.id AS available_asset_id, aa.item_id,aa.quantity as total_quantity,i.item_name
FROM issue_assets ia
JOIN departments d ON ia.department_id = d.id
JOIN issue_asset_details iad ON ia.id = iad.issue_asset_id
JOIN asset_available aa ON iad.available_asset_id = aa.id
join items i on aa.item_id = i.id
where ia.demand_date BETWEEN '$from_date' AND '$to_date'") or die(mysqli_error($my_connection));
}elseif($item_ids_str == '0'){
  $select_qry2 = mysqli_query($my_connection, "SELECT ia.*, d.title, iad.quantity_issue,aa.id AS available_asset_id, aa.item_id,aa.quantity as total_quantity,i.item_name
  FROM issue_assets ia
  JOIN departments d ON ia.department_id = d.id
  JOIN issue_asset_details iad ON ia.id = iad.issue_asset_id
  JOIN asset_available aa ON iad.available_asset_id = aa.id
  join items i on aa.item_id = i.id
  JOIN categories c ON i.category_id = c.id
  where ia.demand_date BETWEEN '$from_date' AND '$to_date' AND c.id IN ($cat_ids_str)") or die(mysqli_error($my_connection));
}
else{

  $select_qry2 = mysqli_query($my_connection, "SELECT ia.*, d.title, iad.quantity_issue, aa.id AS available_asset_id, aa.item_id, aa.quantity as total_quantity, i.item_name
  FROM issue_assets ia
  JOIN departments d ON ia.department_id = d.id
  JOIN issue_asset_details iad ON ia.id = iad.issue_asset_id
  JOIN asset_available aa ON iad.available_asset_id = aa.id
  JOIN items i ON aa.item_id = i.id
  JOIN categories c ON i.category_id = c.id
  WHERE ia.demand_date BETWEEN '$from_date' AND '$to_date'
  AND aa.item_id IN ($item_ids_str);") or die(mysqli_error($my_connection));
}

                                $n = 1;
                                  while($row2 = mysqli_fetch_array($select_qry2)){
                                  $id = $row2['id'];

                           
                             echo ' <tr role="row" class="odd">';
                                    
                                    echo '<td style="border: 1px solid #ddd;" class="text-center"> '.$n++.'</td>';

                                    echo  '<td style="border: 1px solid #ddd;" class="text-center">';
                                          echo '<b>'.$row2['item_name'].'</b>';
                                          echo '</td>';


                                   // echo  '<td style="border: 1px solid #ddd;">';
                                   // echo  '<b>'.$row2['total_quantity'].'</b>';
                                   // echo  '</td>';
                                        
                                    echo  '<td style="border: 1px solid #ddd;" class="text-center">';
                                    echo '<b>'.$row2['quantity_issue'].'</b>';
                                    echo '</td>';
                                           echo  '<td style="border: 1px solid #ddd;" class="text-center">';
                                          echo '<b>'.$row2['title'].'</b>';
                                          echo '</td>';

                                          // echo  '<td style="border: 1px solid #ddd;">';
                                          // echo $row2['quantity_issue'];
                                          // echo '</td>';

                                          // echo  '<td style="border: 1px solid #ddd;">';
                                          //echo $row2['total_quantity'] ;
                                          //echo '</td>';

                                          echo  '<td style="border: 1px solid #ddd;" class="text-center">';
                                          echo $row2['description'];
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

//******************************************** Court Wise Report ***************************************************** */

// all Assets (Items) Date/Category Wise Report
if (isset($_POST['d_from_date']) && isset($_POST['d_to_date']) && isset($_POST['department_id'])) {
$get_from_date = $_POST['d_from_date'];
$get_to_date   = $_POST['d_to_date'];

$department_ids   = $_POST['department_id'];
$dept_ids_str = implode(',', array_map('intval', $department_ids));

$from_date = date("y-m-d", strtotime($get_from_date));
$to_date = date("y-m-d", strtotime($get_to_date));
$title=0;

$select_qry = mysqli_query($my_connection, "SELECT * FROM `departments` where id ='$dept_ids_str';") or die(mysqli_error($my_connection));
$row = mysqli_fetch_assoc($select_qry);

if($dept_ids_str=='0'){
$title = "ALL";
}else{
  $title = $row['title'];
}

?>

<div class="row">
    <div class="col-sm-12">
       
            <center>
                          

            <img src="assets/images/logo.png" style="float:left;" />
            <h4 style="font-weight:bold;">Office of the</h4>
          <h3 style="font-weight:bold; margin-top:-14px;"> Senior Civil Judge, District Mohmand </h3>
          <h3 style="margin-top:-14px;"><span style="font-size:14px;">Email: scjmohmand@gmail.com - Tel: 0924-290145</span></h3>                 
          <h3 style="margin-top:-10px;"><small><strong>Court/Office wise Report Court/Office/Others (<?php if($title != ' '){ echo $title; } else { } ?>  )</strong></small></h3> 
          <h3 style="margin-top:-14px;"><span style="font-size:14px;">From: <?php echo $head_from_date = date("y-M-d", strtotime($from_date)); ?> || To:  <?php echo $head_to_date = date("y-M-d", strtotime($to_date)); ?></span></h3>                 
                                
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


if($dept_ids_str=='0'){
  $select_qry2 = mysqli_query($my_connection, "SELECT ia.*, d.title, iad.quantity_issue, aa.id AS available_asset_id, aa.item_id, i.item_name, e.name, e.designation
  FROM issue_assets ia
  JOIN departments d ON ia.department_id = d.id
  JOIN issue_asset_details iad ON ia.id = iad.issue_asset_id
  JOIN asset_available aa ON iad.available_asset_id = aa.id
  JOIN items i ON aa.item_id = i.id
  JOIN employees e ON ia.employee_id = e.id
  AND ia.demand_date BETWEEN '$from_date' AND '$to_date'") or die(mysqli_error($my_connection));
}
else{
$select_qry2 = mysqli_query($my_connection, "SELECT ia.*, d.title, iad.quantity_issue, aa.id AS available_asset_id, aa.item_id, i.item_name, e.name, e.designation
FROM issue_assets ia
JOIN departments d ON ia.department_id = d.id
JOIN issue_asset_details iad ON ia.id = iad.issue_asset_id
JOIN asset_available aa ON iad.available_asset_id = aa.id
JOIN items i ON aa.item_id = i.id
JOIN employees e ON ia.employee_id = e.id
WHERE ia.department_id IN ($dept_ids_str)
AND ia.demand_date BETWEEN '$from_date' AND '$to_date'") or die(mysqli_error($my_connection));

}
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