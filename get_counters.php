<?php
require_once('my_connection.php'); 

?>
<?php



// Total Purchase Quantity and amount sanitary Start...

$purchase_qry_sanitary = mysqli_query($my_connection, "select SUM(quantity) from assets where category_id = 1") or die(mysqli_error($my_connection));                          
  $p_row = mysqli_fetch_assoc($purchase_qry_sanitary);
  $quantity = $p_row['quantity'];
  

// Total Purchase Quantity and amount sanitary End...



// Total sale Quantity and amount sanitary Start...

$total_sanitary_sale_amount = 0;
$total_sanitary_sale_qty = 0;

$sale_qry_sanitary = mysqli_query($my_connection, "SELECT  sale_quantity,sale_unit_price,(sale_quantity*sale_unit_price) as total_sanitary_sale_amount from sale_invoice_details 
where status = 0 and category_id = '28'") or die(mysqli_error($my_connection));
   
   while($s_row = mysqli_fetch_array($sale_qry_sanitary)){
   $total_sanitary_sale_qty += $s_row['sale_quantity'];
   $total_sanitary_sale_amount += $s_row['total_sanitary_sale_amount'];    
    } 

// Total sale Quantity and amount sanitary End...




// Total purchase quantity and amount of tiles starts

$total_tile_purchase_qty = 0;
$total_tile_purchase_amount = 0;

$purchase_qry_carpet = mysqli_query($my_connection, "SELECT  purchase_quantity,purchase_unit_price,(purchase_quantity*purchase_unit_price) as total_tile_purchase_amount from purchase_invoice_details where category_id = '26'") or die(mysqli_error($my_connection));                          

   while($p_row = mysqli_fetch_array($purchase_qry_carpet)){
   $total_tile_purchase_qty += $p_row['purchase_quantity'];
   $total_tile_purchase_amount += $p_row['total_tile_purchase_amount'];
                                                          }

// total purchase quantity and amount of tiles ends




// total sale quantity  and amount of carpets starts

$total_tile_sale_amount = 0;
$total_tile_sale_qty = 0;

$sale_qry_carpet = mysqli_query($my_connection, "SELECT  sale_quantity,sale_unit_price,(sale_quantity*sale_unit_price) as total_tile_sale_amount from sale_invoice_details
 where status = 0 and category_id = '26'") or die(mysqli_error($my_connection));
   $total_sale_quantity_tile = 0;
   $sale_subtotal_tile = 0;
   while($s_row = mysqli_fetch_array($sale_qry_carpet)){
   $total_tile_sale_qty += $s_row['sale_quantity'];
   $total_tile_sale_amount += $s_row['total_tile_sale_amount'];    
    }


// total sale quantity and amount of tiles end
















$total_mattress_purchase_amount = 0;
$total_mattress_purchase_qty = 0;

// Total Purchase Quantity and amount mattess Start...

$purchase_qry_mattress = mysqli_query($my_connection, "SELECT  purchase_quantity,
purchase_unit_price,(purchase_quantity*purchase_unit_price) as total_mattress_purchase_amount
 from purchase_invoice_details where category_id = '40' 
") or die(mysqli_error($my_connection));                          
   while($p_row = mysqli_fetch_array($purchase_qry_mattress)){
  $total_mattress_purchase_qty += $p_row['purchase_quantity'];
  $total_mattress_purchase_amount += $p_row['total_mattress_purchase_amount'];    
    }

// Total Purchase Quantity and amount mattess End...



// Total sale Quantity and amount mattess Start...

$total_mattress_sale_amount = 0;
$total_mattress_sale_qty = 0;

$sale_qry_mattress = mysqli_query($my_connection, "SELECT  
sale_quantity,sale_unit_price,(sale_quantity*sale_unit_price) as total_mattress_sale_amount 
from sale_invoice_details 
where status = 0 and category_id = '40'") or die(mysqli_error($my_connection));
   
   while($s_row = mysqli_fetch_array($sale_qry_mattress)){
   $total_mattress_sale_qty += $s_row['sale_quantity'];
   $total_mattress_sale_amount += $s_row['total_mattress_sale_amount'];    
    } 

// Total sale Quantity and amount mattess End...

?>