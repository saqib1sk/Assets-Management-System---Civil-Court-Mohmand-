<?php
require_once('my_connection.php');

if (isset($_POST['item_id'][0])) {
    $item_id = $_POST['item_id'][0];
    
    $query = "SELECT quantity FROM asset_available WHERE item_id = '$item_id'";
    $result = mysqli_query($my_connection, $query);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        $quantity = $row['quantity'];
        $field = '<input type="number" class="form-control current_qty" id="current_qty" value="' . $quantity . '" name="current_qty[]" readonly />';
        $data = array('field' => $field, 'quantity' => $quantity);
        echo json_encode($data);
    } else {
        echo json_encode(array('field' => 'Item not found', 'quantity' => 0));
    }
} else {
    echo json_encode(array('field' => 'No item_id received', 'quantity' => 0));
}
?>
