<?php
require_once('my_connection.php');

if (isset($_GET['category_id']) && !empty($_GET['category_id'])) {
    $category_id = $_GET['category_id'];

    // Fetch relevant supply/invoice numbers based on the selected category ID
    $query = "SELECT DISTINCT a.purchase_order_invoice_no
              FROM assets a
              JOIN asset_items ai ON a.id = ai.asset_id
              WHERE ai.category_id = '$category_id'";

    $result = mysqli_query($my_connection, $query);

    if ($result) {
        // Prepare the HTML options for the supply/invoice numbers
        $options = "";
        while ($row = mysqli_fetch_array($result)) {
            $supply_id = $row['purchase_order_invoice_no'];
            $options .= "<option value='$supply_id'>$supply_id</option>";
        }

        echo $options; // Return the options
    } else {
        echo "<option value=''>No Supply/Invoice available</option>";
    }
} else {
    echo "<option value=''>Select Supply/Invoice No</option>";
}
?>
