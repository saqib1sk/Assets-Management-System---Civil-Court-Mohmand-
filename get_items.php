<?php
// Include your database connection code if required
require_once('my_connection.php');

// Check if category_id is provided via POST
if (isset($_POST['category_id'])) {
    $category_id = $_POST['category_id'];

    // Fetch items based on the selected category
    $select_qry = mysqli_query($my_connection, "SELECT * FROM items WHERE category_id = $category_id") or die(mysqli_error($my_connection));

    // Build the item options based on the fetched data
    $options = '';
    while ($row = mysqli_fetch_array($select_qry)) {
        $item_id = $row['id'];
        $item_name = $row['item_name'];
        $options .= "<option value='$item_id'>$item_name</option>";
    }

    // Return the options to populate the item dropdown
    echo $options;
}
?>
