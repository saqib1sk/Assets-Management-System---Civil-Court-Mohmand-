<?php
$all_val=0;
require_once('my_connection.php');

if(isset($_POST['category_ids'])) {
    $category_ids = json_decode($_POST['category_ids']);  // Decoding the JSON array

    if (in_array('All', $category_ids)) {
        echo '<option value="' . $all_val . '" selected>All</option>';
        $sql = mysqli_query($my_connection, "SELECT id, item_name FROM items");
        while ($row = mysqli_fetch_array($sql)) {
            $id = $row['id'];
            $item_name = $row['item_name'];
            echo '<option value="'.$id.'">'.$item_name.'</option>';
        }
    } else {
        // Handle the case when specific categories are selected
        $category_ids_str = implode(',', $category_ids);  // Convert array to comma-separated string
        echo '<option value="' . $all_val . '" selected>All</option>';
        $sql = mysqli_query($my_connection, "SELECT id, item_name FROM items WHERE category_id IN ($category_ids_str)");
        while ($row = mysqli_fetch_array($sql)) {
            $id = $row['id'];
            $item_name = $row['item_name'];
            echo '<option value="'.$id.'">'.$item_name.'</option>';
        }
    }
}
?>
