<?php 
require_once('my_connection.php');
if (isset($_POST['from_date']) && isset($_POST['to_date']) && isset($_POST['category_id'])) {
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $category_id = $_POST['category_id'];
?>
<div class="table-responsive" style="margin-left:10px; margin-right:10px;">
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th width='5%'>S.No</th>
            <th width='10%'>Purchase No</th>
            <th width='10%'>Delivery Date</th>
            <th width='15%'>Vendor</th>
            <th width='40%' >Items Details</th>
            <th width='10%'>Grand Total</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $today = date("Y-m-d");
        $select_qry2 = mysqli_query($my_connection, "SELECT a.*, s.name FROM assets a
                                                    JOIN suppliers s ON a.supplier_id = s.id
                                                    JOIN asset_items ON asset_items.asset_id = a.id
                                                    WHERE a.dated BETWEEN '$from_date' AND '$to_date' AND asset_items.category_id='$category_id'") or die(mysqli_error($my_connection));
        $n = 1;
        while ($row2 = mysqli_fetch_array($select_qry2)) {
            $id = $row2['id'];
            $p_no=$row2['purchase_order_invoice_no'];
            echo '<tr role="row" class="odd">';
            echo '<td>' . $n++ . '</td>';
            echo '<td class=""><b>' . $row2['purchase_order_invoice_no'] . '</b></td>';
            echo '<td style="width:120px;" class="">' . date("j F, Y", strtotime($row2['dated'])) . '</td>';
            echo '<td class=""><b>' . $row2['name'] . '</b></td>';
            echo '<td class="">';
            echo '<table class="table table-striped table-bordered">';
            echo '<tr>
            <th>Category</th>
            <th>Item</th>';
            //<th>ID</th>
           echo' <th>Price</th>
            <th>Qty</th>
            <th>Amount</th>
                </tr>';
            $select_qry = mysqli_query($my_connection, "SELECT ai.*,c.title,i.item_name FROM asset_items ai
                                                        join categories c on ai.category_id = c.id
                                                        join items i on ai.item_id = i.id
                                                        WHERE ai.asset_id = '$id' AND c.id='$category_id'") or die(mysqli_error($my_connection));
            while ($row = mysqli_fetch_assoc($select_qry)) {
                $category_id = $row['category_id'];
                $title = $row['title'];
                $item_id = $row['item_id'];
                $item_name = $row['item_name'];
                $item_no = $row['item_no'];
                $price = $row['price'];
                $quantity = $row['quantity'];
                $total_amount = $row['total_amount'];
                echo '<tr>
                        <td>' . $title . '</td>
                        <td>'.$item_name . '</td>';
                      //  <td>' .$item_no. '</td>
                       echo' <td>' . $price .  '  </td>
                        <td>' . $quantity . '</td>
                        <td>' . $total_amount . '</td>
                    </tr>';
            }
            echo '</table>';
            echo '</td>';
           
            echo '<td class="">' . $row2['grand_total_amount'] . '</td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>

                        </div>
<?php
}
?>